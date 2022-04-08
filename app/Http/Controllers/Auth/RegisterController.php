<?php

namespace App\Http\Controllers\Auth;

use App\Enums\StatusesEnum;
use App\Http\Controllers\Controller;
use App\Notifications\StatusCode;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Rules\EmailRule;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Validation\Validator as ContractsValidator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return Factory|View
     */
    public function showRegistrationForm()
    {
        return view('website.home');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return ContractsValidator
     */
    protected function validator(array $data): ContractsValidator
    {
        return Validator::make($data, [
            'full_name' => ['required', 'alpha', 'max:40'],
            'email' => ['required', new EmailRule(), 'unique:users', 'max:60'],
            'role' => ['required', 'exists:user_roles,id'],
            'password' => ['required', 'string', 'min:8'],
        ], $this->validateMessages());
    }

    protected function validateMessages(): array
    {
        return [
            'email.unique' => __('auth.email_already_exists')
        ];
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param Request $request
     * @return JsonResponse|RedirectResponse|Redirector|mixed
     * @throws ValidationException
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        try {
            event(new Registered($user = $this->create($request->all())));

            if ($response = $this->registered($request, $user)) {
                return $response;
            }

            return new JsonResponse(['success' => true, 'id' => $user->id, 'email' => $user->email], 201);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json(['success' => false, 'message' => __('validation.custom.failed')], 400);
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data): User
    {
        $user = (new User())->forceFill([
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'role_id' => $data['role'],
            'password' => $data['password'],
        ]);

        $user->save();

        return $user;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function sendStatusCode(Request $request): JsonResponse
    {
        $this->validate($request,  ['email' => ['required', 'exists:users']]);

        try {
            $status_code = random_int(1000, 9999);
            $user = User::where('email', $request->email)->first();
            if ($user && $user->status == StatusesEnum::NOT_VERIFIED) {
                $user->update(['status_code' => $status_code]);
                $user->notify(new StatusCode([
                    'full_name' => $user->full_name,
                    'status_code' => $user->status_code
                ]));
                return response()->json(['success' => true, 'message' => __('auth.email_code_sent')]);
            }
            return response()->json(['success' => false, 'message' => __('auth.already_verified')], 409);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json(['success' => false], 500);
        }
    }

    /**
     * @param Request $request
     * @return Application|JsonResponse|RedirectResponse|Redirector
     */
    public function checkStatusCode(Request $request)
    {
        $request->validate([
            'email' => ['required', new EmailRule()],
            'code' => ['required'],
        ]);

        try {
            $user = User::where('email', $request->get('email'))->first();
            if ($user && $user->status_code == $request->get('code')) {
                Auth::guard('web')->loginUsingId($user->id);

                if ($user->hasVerifiedEmail()) {
                    return new JsonResponse(['message' => __('auth.already_verified')], 204);
                }

                if ($user->markEmailAsVerified()) {
                    event(new Verified($user));
                }

                return new JsonResponse(['message' => __('auth.verify_success')], 200);
            }
            return new JsonResponse(['errors' => ['code' => __('validation.custom.failed_code')]], 422);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return new JsonResponse(['message' => __('validation.custom.failed')], 500);
        }
    }
}
