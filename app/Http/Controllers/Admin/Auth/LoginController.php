<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Enums\StatusesEnum;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::DASHBOARD;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function guard()
    {
        return Auth::guard('admin');
    }

    public function showAdminLoginForm()
    {
        return view('admin.auth.index', ['url' => 'admin']);
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') && $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return back()->withInput($request->all())->withErrors(['credentials' => __('auth.throttle')]);
        }

        $admin = Admin::where($this->username(), $request->get($this->username()))->first();
        if ($admin && Hash::check($request->password, $admin->password)) {
            if ($admin->status == StatusesEnum::STATUSES['active']) {
                if ($this->attemptLogin($request)) {
                    if ($request->hasSession()) {
                        $request->session()->put('auth.password_confirmed_at', time());
                    }
                    return redirect()->intended($this->redirectTo);
                }
            } else {
                Session::flash('auth_error', __('auth.not_active'));
                return back()->withInput($request->all());
            }
        }

        return back()
            ->withInput($request->all())
            ->withErrors(['credentials' => __('passwords.wrong_credentials')]);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/admin/login');
    }
}
