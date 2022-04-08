<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RepairingType\StoreRequest;
use App\Http\Requests\Admin\RepairingType\UpdateRequest;
use App\Models\RepairingType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class RepairingTypesController extends BaseAdminController
{
    public function getModel()
    {
        return RepairingType::query();
    }

    public function getFields(): array
    {
        return RepairingType::fields();
    }

    protected function resourceName() : string
    {
        return 'repairing-types';
    }

    protected function tableColumnsCount(): int
    {
        return 5;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\RepairingType\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        try{
            RepairingType::create($request->all());
            Session::flash('success',__('admin.successfully_created').' '.__('admin.repairing_type'));
            return response()->json(['success' => true,'url' => route('repairing-types.index')]);
        }catch (\Exception $exception){
            Log::error($exception->getMessage());
            Session::flash('error',__('admin.something_wrong'));
            return response()->json(['success' => false]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RepairingType  $repairingType
     * @return \Illuminate\Http\Response
     */
    public function show(RepairingType $repairingType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RepairingType  $repairingType
     * @return \Illuminate\Http\Response
     */
    public function edit(RepairingType $repairingType)
    {
        return view('admin.repairing-types.edit',compact('repairingType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\RepairingType\UpdateRequest  $request
     * @param  \App\Models\RepairingType  $repairingType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, RepairingType $repairingType)
    {
        try{
            $repairingType->update($request->all());
            Session::flash('success',__('admin.repairing_type').' '.__('admin.updated_successful'));
            return response()->json(['success' => true,'url' => route('repairing-types.index')]);
        }catch (\Exception $exception){
            Log::error($exception->getMessage());
            Session::flash('error',__('admin.something_wrong'));
            return response()->json(['success' => false]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RepairingType  $repairingType
     * @return \Illuminate\Http\Response
     */
    public function destroy(RepairingType $repairingType)
    {
        try{
            $repairingType->delete();
            return redirect()->route('repairing-types.index')->with('success', __('admin.repairing_type').' '.__('admin.deleted_successful'));
        }catch (\Exception $exception){
            return redirect()->back()->with('error', __('admin.something_wrong'));
        }
    }
}
