<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Display the form to request a password reset link.
     *
     * @return Factory|View
     */
    public function showLinkRequestForm()
    {
        return view('website.home');
    }

    /**
     * Validate the email for the given request.
     *
     * @param Request $request
     * @return void
     */
    protected function validateEmail(Request $request)
    {
        $request->validate(['email' => 'required|exists:users']);
    }
}
