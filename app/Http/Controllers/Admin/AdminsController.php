<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Admin\StoreRequest;
use App\Http\Requests\Admin\Admin\UpdateRequest;
use App\Models\Admin;
use App\Notifications\GeneratePassword;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Illuminate\Contracts\View\View as ContractsView;
use Illuminate\Contracts\View\Factory as ViewFactory;

class AdminsController extends BaseAdminController
{
    public function getModel()
    {
        return  Admin::with([
            'profile',
            'role' => function($q) {
                $lang = app()->getLocale() == 'am' ? '' : '_'. app()->getLocale();
                $q->select("name{$lang} as role_name");
            }
        ]);
    }

    public function getFields(): array
    {
        return Admin::fields();
    }

    protected function resourceName() : string
    {
        return 'admins';
    }

    protected function tableColumnsCount(): int
    {
        return 8;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return ViewFactory|ContractsView
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.admins.create', compact('roles'));
    }

    /**
     * @param StoreRequest $request
     * @return JsonResponse|RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        try {
            DB::beginTransaction();

            $passRandom = Str::random(8);
            $admin = Admin::create(array_merge($request->admin, ['password' => Hash::make($passRandom)]));
            $admin->assignRole($request->role);

            $profile_data = $request->profile;
            if ($request->file('avatar')) {
                $file = $request->file('avatar');
                $path = make_directory(['profile', $admin->id]);
                $fileName = save_image($file,0,$path);
                $profile_data['avatar'] = "uploads/profile/$admin->id/$fileName";
            }
            $admin->profile()->create($profile_data);
            $admin->notify(new GeneratePassword([
                'name' => $admin->name,
                'email' => $admin->email,
                'password' => $passRandom
            ]));

            DB::commit();
            Session::flash('success',__('admin.successfully_created') . ' ' . __('admin.admin'));
            return response()->json(['success' => true,'url' => route('admins.index')]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            Session::flash('error', __('admin.something_wrong'));
            return response()->json(['success' => false]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param $id
     * @return ViewFactory|ContractsView
     */
    public function edit(Admin $admin)
    {
        $roles = Role::all();
        return view('admin.admins.edit', compact('admin', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param $id
     * @return JsonResponse|RedirectResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $admin = Admin::find($id);
            $admin->update($request->admin);
            $admin->syncRoles([$request->role]);
            $fileName = null;
            $profile_data = $request->profile;

            if (($request->hasFile('avatar')) || (!$request->hasFile('avatar') && $request->is_avatar)){
                $avatar = $admin->profile->avatar;
                if ($avatar && file_exists(public_path("/$avatar"))){
                    $dirPath = substr($avatar, 0, strrpos($avatar, '/'));
                    File::deleteDirectory(public_path("/$dirPath"));
                    $profile_data['avatar'] = null;
                }
                if ($request->hasFile('avatar')){
                    $file = $request->file('avatar');
                    $path = make_directory(['profile',$admin->id]);
                    $fileName = save_image($file,0,$path);
                    $profile_data['avatar'] = "uploads/profile/$admin->id/$fileName";
                }
            }

            $admin->profile()->update($profile_data);
            DB::commit();
            Session::flash('success',__('admin.admin') . ' ' . __('admin.updated_successful'));
            return response()->json(['success' => true, 'url' => route('admins.index')]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            Session::flash('error',__('admin.something_wrong'));
            return response()->json(['success' => false]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Admin $admin
     * @return RedirectResponse
     */
    public function destroy(Admin $admin)
    {
        try {
            if ($avatar = $admin->profile->avatar) {
                if (file_exists(public_path("/$avatar"))){
                    $dirPath = substr($avatar, 0, strrpos($avatar, '/'));
                    File::deleteDirectory(public_path("/$dirPath"));
                }
            }
            $admin->delete();
            return redirect()->route('admins.index')->with('success', __('admin.admin').' '.__('admin.deleted_successful'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', __('admin.something_wrong'));
        }
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function filter(Request $request)
    {
        if ($request->ajax()) {
            $page = $request->page > 1 ? $request->page : 1;
            $role = $request['role'];
            $search = $request['search'];
            $email = $request['email'];
            $admins = Admin::query();

            if (!empty($search)) {
                $admins->where('full_name', 'like', '%' . $search . '%');
            }
            if (!empty($email)) {
                $admins->where('email', 'like', '%' . $email . '%');
            }
            if (!empty($role)){
                $admins->role($role);
            }

            $admins = $admins->paginate(10,'*', 'page', $page);
            $roles = Role::all();
            $returnHTML = count($admins) ? view('admin.admins.list')->with(compact(
                    'admins',
                    'roles'
                )
            )->render() : '';

            return response()->json(array('success' => true, 'html' => $returnHTML));
        }
    }
}
