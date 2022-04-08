<?php

namespace App\Services\Social;

use App\Models\User;
use App\Services\ServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Contracts\User as SocialiteUser;

class SocialAuth implements ServiceInterface
{
    protected $user;

    protected $provider;

    public function __construct(SocialiteUser $user, $provider)
    {
        $this->user = $user;
        $this->provider = $provider;
    }

    /**
     * check if the user exists then sign in, if not, then create and sign in
     *
     * @return bool
     */
    public function login(): bool
    {
        $user = User::where('email', $this->user->getEmail())->first();

        if ($this->user->getEmail() && $user) {
            $user->update([
                'provider_token' => $this->user->token,
                'provider_refresh_token' => $this->user->refreshToken,
            ]);
        } else {
            $user = User::create([
                'name' => $this->user->getName(),
                'email' => $this->user->getEmail(),
                'provider' => $this->provider,
                'provider_id' => $this->user->getId(),
                'provider_token' => $this->user->token,
                'provider_refresh_token' => $this->user->refreshToken,
            ]);

            $user->profile()->create(['avatar' => $this->user->getAvatar()]);
        }

        Auth::login($user, true);
        Session::flash("success", __('auth.login_success'));

        return true;

//        Session::flash('danger', __('auth.social_login_fail', ['driver' => $this->driver]));
    }

    /**
     * @return bool
     * @throws \Throwable
     */
    public function run(): bool
    {
        return $this->login();
    }
}
