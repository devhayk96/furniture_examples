<?php

namespace App\Http\Controllers\Auth;

use App\Enums\StatusesEnum;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return Factory|View
     */
    public function showLoginForm()
    {
        return view('website.home');
    }

    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse|Response
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password) && $user->status == StatusesEnum::ACTIVE_STATUS) {
            if ($this->attemptLogin($request)) {
                if ($request->hasSession()) {
                    $request->session()->put('auth.password_confirmed_at', time());
                }
                return $this->sendLoginResponse($request);
            }
        } elseif ($user && Hash::check($request->password, $user->password) && $user->status == StatusesEnum::STATUSES['not_verified']) {
            return response()->json([
                'email' => $user->email,
                'status' => array_search(StatusesEnum::STATUSES['not_verified'], StatusesEnum::STATUSES)
            ], 302);
        }
        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Get the failed login response instance.
     *
     * @param Request $request
     * @return Response
     *
     * @throws ValidationException
     */
    protected function sendFailedLoginResponse(Request $request): Response
    {
        throw ValidationException::withMessages([
            'credentials' => [trans('validation.custom.invalid_email_password')],
        ]);
    }
}
