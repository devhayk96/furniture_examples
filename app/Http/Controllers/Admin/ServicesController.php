<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Service\StoreRequest;
use App\Http\Requests\Admin\Service\UpdateRequest;

use App\Models\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View as ContractsView;
use Illuminate\Contracts\View\Factory as ViewFactory;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class ServicesController extends BaseAdminController
{
    public function getModel()
    {
        return Service::query();
    }

    public function getFields(): array
    {
        return Service::fields();
    }

    protected function resourceName() : string
    {
        return 'services';
    }

    protected function tableColumnsCount(): int
    {
        return 9;
    }

    /**
     * Store a newly created service in the database.
     *
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request)
    {
        try {
            DB::beginTransaction();

            if ($icon = $request->file('icon')) {
                $fileNameToStore = time(). '.' . $icon->getClientOriginalExtension();
                $icon_path = $icon->storeAs('public/services/icons', $fileNameToStore);
                $request->merge(['icon' => $icon_path]);
            }

            Service::create($request->all());
            DB::commit();

            Session::flash('success',__('admin.successfully_created').' '.__('main.service'));
            return response()->json(['success' => true,'url' => route('services.index')]);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
            Session::flash('error',__('admin.something_wrong'));
            return response()->json(['success' => false]);
        }
    }

    /**
     * Display the specified service.
     *
     * @param Service $service
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified service.
     *
     * @param  Service $service
     * @return ViewFactory|ContractsView
     */
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified service in database.
     *
     * @param UpdateRequest $request
     * @param Service $service
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Service $service)
    {
        try {
            DB::beginTransaction();

            $request->merge(['icon' => $service->icon]);
            if ($icon = $request->file('icon')) {
                $fileNameToStore = time(). '.' . $icon->getClientOriginalExtension();
                $icon_path = $icon->storeAs('public/services/icons', $fileNameToStore);
                $request->merge(['icon' => $icon_path]);
            }
            $service->update($request->all());
            DB::commit();
            Session::flash('success',__('main.service').' '.__('admin.updated_successful'));
            return response()->json(['success' => true,'url' => route('services.index')]);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
            Session::flash('error',__('admin.something_wrong'));
            return response()->json(['success' => false]);
        }
    }

    /**
     * Remove the specified service from database.
     *
     * @param Service $service
     * @return RedirectResponse
     */
    public function destroy(Service $service)
    {
        try {
            $service->delete();
            return redirect()->route('services.index')->with('success', __('main.service').' '.__('admin.deleted_successful'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', __('admin.something_wrong'));
        }
    }


}
