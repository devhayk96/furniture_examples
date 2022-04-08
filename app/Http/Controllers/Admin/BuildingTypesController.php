<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\BuildingType\StoreRequest;
use App\Http\Requests\Admin\BuildingType\UpdateRequest;
use App\Models\BuildingType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class BuildingTypesController extends BaseAdminController
{
    public function getModel()
    {
        return BuildingType::query();
    }

    public function getFields(): array
    {
        return BuildingType::fields();
    }

    protected function resourceName() : string
    {
        return 'building-types';
    }

    protected function tableColumnsCount(): int
    {
        return 5;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\BuildingType\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        try{
            BuildingType::create($request->all());
            Session::flash('success',__('admin.successfully_created').' '.__('admin.building_type'));
            return response()->json(['success' => true,'url' => route('building-types.index')]);
        }catch (\Exception $exception){
            Log::error($exception->getMessage());
            Session::flash('error',__('admin.something_wrong'));
            return response()->json(['success' => false]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BuildingType  $buildingType
     * @return \Illuminate\Http\Response
     */
    public function show(BuildingType $buildingType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BuildingType  $buildingType
     * @return \Illuminate\Http\Response
     */
    public function edit(BuildingType $buildingType)
    {
        return view('admin.building-types.edit',compact('buildingType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\BuildingType\UpdateRequest  $request
     * @param  \App\Models\BuildingType  $buildingType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, BuildingType $buildingType)
    {
        try{
            $buildingType->update($request->all());
            Session::flash('success',__('admin.building_type').' '.__('admin.updated_successful'));
            return response()->json(['success' => true,'url' => route('building-types.index')]);

        }catch (\Exception $exception){
            Log::error($exception->getMessage());
            Session::flash('error',__('admin.something_wrong'));
            return response()->json(['success' => false]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BuildingType  $buildingType
     * @return \Illuminate\Http\Response
     */
    public function destroy(BuildingType $buildingType)
    {
        if ($buildingType == null) {
            return back()->with('error', __('admin.not_found', ['model_name' => __('admin.building_type')]));
        }
        $buildingType->delete();
        return redirect()->route('building-types.index')->with('success', __('admin.building_type').' '.__('admin.deleted_successful'));
    }
}
