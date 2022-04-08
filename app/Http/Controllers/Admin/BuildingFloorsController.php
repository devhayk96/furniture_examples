<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\BuildingFloor\StoreRequest;
use App\Http\Requests\Admin\BuildingFloor\UpdateRequest;
use App\Models\BuildingFloor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class BuildingFloorsController extends BaseAdminController
{
    public function getModel()
    {
        return  BuildingFloor::query();
    }

    public function getFields(): array
    {
        return BuildingFloor::fields();
    }

    protected function resourceName() : string
    {
        return 'building-floors';
    }

    protected function tableColumnsCount(): int
    {
        return 5;
    }

    /**
     * Store a newly created building floor in storage.
     *
     * @param StoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
    {
        try {
            BuildingFloor::create($request->all());
            Session::flash('success', __('admin.successfully_created') . ' ' . __('admin.building_floor'));
            return response()->json(['success' => true, 'url' => route('building-floors.index')]);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Session::flash('error', __('admin.something_wrong'));
            return response()->json(['success' => false]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BuildingFloor  $buildingFloor
     * @return \Illuminate\Http\Response
     */
    public function show(BuildingFloor $buildingFloor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BuildingFloor  $buildingFloor
     * @return \Illuminate\Http\Response
     */
    public function edit(BuildingFloor $buildingFloor)
    {
        return view('admin.building-floors.edit',compact('buildingFloor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\BuildingFloor\UpdateRequest  $request
     * @param  \App\Models\BuildingFloor  $buildingFloor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, BuildingFloor $buildingFloor)
    {
        try{
            $buildingFloor->update($request->all());
            Session::flash('success',__('admin.building_floor').' '.__('admin.updated_successful'));
            return response()->json(['success' => true,'url' => route('building-floors.index')]);
        }catch (\Exception $exception){
            Log::error($exception->getMessage());
            Session::flash('error',__('admin.something_wrong'));
            return response()->json(['success' => false]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BuildingFloor  $buildingFloor
     * @return \Illuminate\Http\Response
     */
    public function destroy(BuildingFloor $buildingFloor)
    {
        try{
            $buildingFloor->delete();
            return redirect()->route('building-floors.index')->with('success', __('admin.building_floor').' '.__('admin.deleted_successful'));
        }catch (\Exception $exception){
            return redirect()->back()->with('error', __('admin.something_wrong'));
        }

    }
}
