<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\User\StoreRequest;
use App\Http\Requests\Admin\User\UpdateRequest;
use App\Models\User;
use App\Notifications\GeneratePassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UsersController extends BaseAdminController
{
    public function getModel()
    {
        return User::query();
    }

    public function getFields(): array
    {
        return User::fields();
    }

    protected function resourceName() : string
    {
        return 'users';
    }

    protected function tableColumnsCount(): int
    {
        return 5;
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        try {
            if (!$request->ajax()){
                $passRandom = Str::random(8); $fileName = null;
                $user = User::create(array_merge($request->user, ['password' => $passRandom]));
                if ($avatar = $request->file('avatar')) {
                    $fileName = time() . '_' . $user->id . '.' . $avatar->getClientOriginalExtension();
                    $avatar->storeAs('user-images', $fileName);
                }
                $user->profile()->create(array_merge($request->profile, ['avatar' => $fileName]));
                $user->phone()->create(['phone_number' => $request->phone]);
                $user->notify(new GeneratePassword([
                    'name' => $user->full_name,
                    'email' => $user->email,
                    'password' => $passRandom
                ]));
                return redirect()->route('users.index')->with('success', __('admin.successfully_created').' '.__('admin.user'));
            }
        } catch (\Exception $exception) {
            if (!$request->ajax()){
                Log::error($exception->getMessage());
                return redirect()->back()->with('error', __('admin.something_wrong'));
            }
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * @param UpdateRequest $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, User $user)
    {
        try {
            if (!$request->ajax()){
                $user = User::find($user->id);
                $user->update($request->user);
                $fileName = null;
                if ($avatar = $request->file('avatar')) {
                    if ($user->profile->avatar != '' && !is_null($user->profile->avatar)) {
                        if (file_exists(storage_path('app/user-images/' . $user->profile->avatar))) {
                            unlink(storage_path('app/user-images/' . $user->profile->avatar));
                        }
                    }
                    $fileName = time() . '_' . $user->id . '.' . $avatar->getClientOriginalExtension();
                    $avatar->storeAs('user-images', $fileName);
                }
                $user->profile()->update(array_merge($request->profile, ['avatar' => $fileName]));
                $user->phone()->update(['phone_number' => $request->phone]);
                return redirect()->route('users.index')->with('success', __('admin.user').' '.__('admin.updated_successful'));
            }
        } catch (\Exception $exception) {
            if (!$request->ajax()){
                Log::error($exception->getMessage());
                return redirect()->back()->with('error', __('admin.something_wrong'));
            }
        }
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        try {
            if ($user->profile->avatar != '' && !is_null($user->profile->avatar)) {
                if (file_exists(storage_path('app/user-images/' . $user->profile->avatar))) {
                    unlink(storage_path('app/user-images/' . $user->profile->avatar));
                }
            }
            $user->delete();
            return redirect()->route('users.index')->with('success', __('admin.user').' '.__('admin.deleted_successful'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', __('admin.something_wrong'));
        }
    }
}
