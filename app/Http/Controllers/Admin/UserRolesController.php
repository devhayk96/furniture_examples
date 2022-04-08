<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Status\StoreRequest;
use App\Http\Requests\Admin\Status\UpdateRequest;
use App\Models\UserRole;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class UserRolesController extends BaseAdminController
{
    public function getModel(): Model
    {
        return new UserRole();
    }

    public function getFields(): array
    {
        return UserRole::fields();
    }

    protected function resourceName() : string
    {
        return 'user-roles';
    }

    protected function tableColumnsCount(): int
    {
        return 6;
    }

    /**
     * Store a newly created seller status in database.
     *
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request)
    {
        try {
            UserRole::create($request->all());
            Session::flash('success',__('admin.successfully_created').' '.__('admin.role'));
            return response()->json(['success' => true, 'url' => route('user-roles.index')]);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Session::flash('error',__('admin.something_wrong'));
            return response()->json(['success' => false]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserRole  $status
     * @return \Illuminate\Http\Response
     */
    public function show(UserRole $status)
    {
        //
    }

    /**
     * Show the form for editing the specified user role.
     * @param UserRole $userRole
     * @return Factory|View
     */
    public function edit(UserRole $userRole)
    {
        $role = UserRole::find($userRole->id);
        return view('admin.user-roles.edit', compact('role'));
    }

    /**
     * Update the specified user role status in database.
     *
     * @param UpdateRequest $request
     * @param UserRole $status
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, UserRole $userRole)
    {
        try {
            $userRole->update($request->all());
            Session::flash('success',__('admin.role').' '.__('admin.updated_successful'));
            return response()->json(['success' => true, 'url' => route('user-roles.index')]);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Session::flash('error',__('admin.something_wrong'));
            return response()->json(['success' => false]);
        }
    }

    /**
     * Remove the specified user role from database.
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $status = UserRole::find($id);
            if ($status){
                $status->delete();
            }
            return redirect()->route('user-roles.index')->with('success', __('admin.role').' '.__('admin.deleted_successful'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', __('admin.something_wrong'));
        }
    }
}
