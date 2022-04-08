<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdditionalInfo\StoreRequest;
use App\Http\Requests\Admin\AdditionalInfo\UpdateRequest;
use App\Models\AdditionalInfo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View as ContractsView;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class AdditionalInfoController extends BaseAdminController
{
    public function getModel()
    {
        return AdditionalInfo::query();
    }

    public function getFields(): array
    {
        return AdditionalInfo::fields();
    }

    protected function resourceName() : string
    {
        return 'additional-infos';
    }

    protected function tableColumnsCount(): int
    {
        return 5;
    }

    /**
     * Show the form for creating a new additional info.
     *
     * @return ViewFactory|ContractsView
     */
    public function create()
    {
        return view('admin.additional-infos.create');
    }

    /**
     * Store a newly created additional info in the database.
     *
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request)
    {
        try {
            AdditionalInfo::create($request->all());
            Session::flash('success',__('admin.successfully_created').' '.__('admin.additional-info'));
            return response()->json(['success' => true,'url' => route('additional-infos.index')]);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Session::flash('error',__('admin.something_wrong'));
            return response()->json(['success' => false]);
        }
    }

    /**
     * Display the specified additional info.
     *
     * @param AdditionalInfo $additional_info
     */
    public function show(AdditionalInfo $additional_info)
    {
        //
    }

    /**
     * Show the form for editing the specified additional info.
     *
     * @param  AdditionalInfo $additional_info
     * @return ViewFactory|ContractsView
     */
    public function edit(AdditionalInfo $additional_info)
    {
        return view('admin.additional-infos.edit', compact('additional_info'));
    }

    /**
     * Update the specified additional info in database.
     *
     * @param UpdateRequest $request
     * @param AdditionalInfo $additional_info
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, AdditionalInfo $additional_info)
    {
        try {
            $additional_info->update($request->all());
            Session::flash('success',__('admin.additional-info').' '.__('admin.updated_successful'));
            return response()->json(['success' => true,'url' => route('additional-infos.index')]);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Session::flash('error',__('admin.something_wrong'));
            return response()->json(['success' => false]);
        }
    }

    /**
     * Remove the specified additional info from database.
     *
     * @param AdditionalInfo $additional_info
     * @return RedirectResponse
     */
    public function destroy(AdditionalInfo $additional_info)
    {
        try {
            $additional_info->delete();
            return redirect()->route('additional-infos.index')->with('success', __('admin.additional-info').' '.__('admin.deleted_successful'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', __('admin.something_wrong'));
        }
    }


}
