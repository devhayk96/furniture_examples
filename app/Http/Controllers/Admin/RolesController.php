<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Role\StoreRequest;
use App\Models\Admin;
use App\Models\AdminPermission;
use App\Models\AdminRole;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class RolesController extends BaseAdminController
{
    /**
     * @return Builder
     */
    public function getModel()
    {
        return AdminRole::query();
    }

    public function getFields(): array
    {
        return AdminRole::fields();
    }

    protected function resourceName(): string
    {
        return 'roles';
    }

    protected function tableColumnsCount(): int
    {
        return 3;
    }

    /**
     * Show the form for creating a new role.
     *
     * @return Factory|View
     */
    public function create()
    {
        $grouped_permissions = AdminPermission::allByGroupName();
        return view('admin.roles.create', compact('grouped_permissions'));
    }

    /**
     * Store a newly created role in database.
     *
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request)
    {
        try {
            DB::beginTransaction();

            $new_role = AdminRole::create([
                'name'    => $request->get('name'),
                'name_en' => $request->get('name_en'),
                'name_ru' => $request->get('name_ru'),
                'guard_name' => 'admin'
            ]);

            $new_role->permissions()->attach($request->permissions);

            DB::commit();
            Session::flash('success',__('admin.successfully_created') . ' ' . __('admin.role'));
            return response()->json(['success' => true, 'url' => route('roles.index')]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            Session::flash('error', __('admin.something_wrong'));
            return response()->json(['success' => false]);
        }
    }

    /**
     * Display the specified role.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified role.
     *
     * @param AdminRole $role
     * @return Factory|View|RedirectResponse
     */
    public function edit(AdminRole $role)
    {
        if ($role->id != Admin::ROLE_SUPER_ADMIN) {
            $role->load('permissions');
            $grouped_permissions = AdminPermission::allByGroupName();
            return view('admin.roles.edit', compact('role', 'grouped_permissions'));
        }

        return redirect()->route('roles.index');
    }

    /**
     * Update the specified role in database.
     *
     * @param Request $request
     * @param AdminRole $role
     * @return JsonResponse
     */
    public function update(Request $request, AdminRole $role)
    {
        try {
            DB::beginTransaction();

            $role->update([
                'name' => $request->get('name'),
                'name_en' => $request->get('name_en'),
                'name_ru' => $request->get('name_ru'),
            ]);
            $role->permissions()->sync($request->permissions);

            DB::commit();
            Session::flash('success', __('admin.role') . ' ' . __('admin.updated_successful'));
            return response()->json(['success' => true, 'url' => route('roles.index')]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            Session::flash('error', __('admin.something_wrong'));
            return response()->json(['success' => false]);
        }
    }

    /**
     * Remove the specified role from database.
     *
     * @param AdminRole $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(AdminRole $role)
    {
        try {
            $role->delete();
            return redirect()->route('roles.index')->with('success', __('admin.role').' '.__('admin.deleted_successful'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', __('admin.something_wrong'));
        }
    }
}
