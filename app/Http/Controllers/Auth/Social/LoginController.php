<?php

namespace App\Http\Controllers\Auth\Social;

use App\Services\Social\SocialAuth;
use \Exception;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * social login providers
     *
     * @var string[]
     */
    protected $providers = [
        'facebook', 'google',
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * @param $driver
     * @return bool
     */
    private function isProviderAllowed($driver) : bool
    {
        return in_array($driver, $this->providers) && config()->has("services.{$driver}");
    }

    /**
     * @param $driver
     * @return RedirectResponse
     */
    public function redirectToProvider($driver) : RedirectResponse
    {
        if (!$this->isProviderAllowed($driver)) {
            return $this->sendFailedResponse(__('auth.provider_not_supported', ['driver' => $driver]));
        }

        try {
            return Socialite::driver($driver)->redirect();
        } catch (Exception $e) {
            return $this->sendFailedResponse($e->getMessage());
        }
    }

    /**
     * @param $provider
     * @return RedirectResponse
     * @throws \Throwable
     */
    public function handleProviderCallback($provider)
    {
        try {
            $user = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            return $this->sendFailedResponse($e->getMessage());
        }

        (new SocialAuth($user, $provider))->run();

        return redirect()->route('home');
    }

    /**
     * @param null $msg
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendFailedResponse($msg = null) : RedirectResponse
    {
        Log::warning($msg);

        return redirect()->route('home')
            ->with('warning', __('auth.social_login_error'));
    }
}
