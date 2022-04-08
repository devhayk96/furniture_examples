<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Models\Admin;
use App\Models\AdminProfile;
use App\Models\Profile;
use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use function PHPSTORM_META\type;

class ProfileController extends Controller
{
    /**
     * Display a page of the profile.
     *
     * @return Factory|View
     */
    public function index()
    {
        $admin = Admin::find(auth()->guard('admin')->id());
        if (!$admin->profile()->count()){
            $admin->profile()->create();
        }
        return view('admin.profile.index',compact('admin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProfileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProfileRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @return string
     */
    public function show()
    {
        $admin = Admin::with('profile')->where('id', auth()->guard('admin')->id())->first();
        return view('admin.profile.show', compact('admin'))->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return string
     */
    public function edit()
    {
        $admin = Admin::find(auth()->guard('admin')->id());
        return view('admin.profile.edit', compact('admin'))->render();
    }

    /**
     * @return string
     */
    public function password()
    {
        return view('admin.profile.password')->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProfileRequest $request
     * @return JsonResponse
     */
    public function update(UpdateProfileRequest $request)
    {
        try {
            DB::beginTransaction();
            $admin = Admin::find(auth()->guard('admin')->id());
            $admin->update($request->admin);
            $profile_data = $request->profile;
            $i = 0;

            if (($request->hasFile('avatar')) || (!$request->hasFile('avatar') && $request->is_avatar)) {
                if ($avatar = $admin->profile->avatar) {
                    if (file_exists(public_path("/$avatar"))) {
                        $dirPath = substr($avatar, 0, strrpos($avatar, '/'));
                        File::deleteDirectory(public_path("/$dirPath"));
                        $profile_data['avatar'] = null;
                        $i++;
                    }
                }
                if ($request->hasFile('avatar')) {
                    $file = $request->file('avatar');
                    $path = make_directory(['profile', $admin->id]);
                    $fileName = save_image($file, 0, $path);
                    $profile_data['avatar'] = "uploads/profile/$admin->id/$fileName";
                    $i++;
                }
            }

            $admin->profile()->update($profile_data);
            DB::commit();

            $avatarPath = $i ? $profile_data['avatar'] : $admin->profile->avatar;
            $success = __('admin.profile') . ' ' . __('admin.updated_successful');
            $alert = view('admin.partials.flash_messages', compact('success'))->render();
            return response()->json(['success' => true, 'type' => 'success', 'message' => $alert, 'full_name' => $admin->full_name, 'avatar' => $avatarPath]);
        } catch (\Exception $exception) {
            DB::rollBack();
            $error = __('admin.something_wrong');
            $alert = view('admin.partials.flash_messages', compact('error'))->render();
            Log::info($exception->getMessage());
            return response()->json(['success' => false, 'type' => 'danger', 'message' => $alert]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }


    /**
     * Change profile password
     * @param ChangePasswordRequest $request
     * @return JsonResponse
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        try {
            $admin = Admin::find(auth()->guard('admin')->id());
            $newpassword = Hash::make($request['newpassword']);
            if (Hash::check($request['password'], $admin->password)) {
                $admin->password = $newpassword;
                $admin->save();
                $success =  __('passwords.success');
                $alert = view('admin.partials.flash_messages',compact('success'))->render();
                return response()->json(['success' => true, 'message' => $alert]);
            }
            return response()->json(['success' => false, 'errors' => ['password' => __('passwords.wrong')]], 422);
        } catch (\Exception $exception) {
            Log::info($exception->getMessage());
            $error = __('admin.something_wrong');
            $alert = view('admin.partials.flash_messages',compact('error'))->render();
            return response()->json(['success' => false,'type' => 'danger', 'message' => $alert]);
        }
    }
}
