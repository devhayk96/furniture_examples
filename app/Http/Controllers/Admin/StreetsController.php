<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Street\StoreRequest;
use App\Http\Requests\Admin\Street\UpdateRequest;
use App\Models\Street;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class StreetsController extends BaseAdminController
{
    public function getModel()
    {
        return Street::query();
    }

    public function getFields(): array
    {
        return Street::fields();
    }

    protected function resourceName() : string
    {
        return 'streets';
    }

    protected function tableColumnsCount(): int
    {
        return 5;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.streets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        try{
            Street::create($request->all());
            Session::flash('success',__('admin.successfully_created').' '.__('admin.street'));
            return response()->json(['success' => true,'url' => route('streets.index')]);
        }catch (\Exception $exception){
            Log::error($exception->getMessage());
            Session::flash('error',__('admin.something_wrong'));
            return response()->json(['success' => false]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Street  $street
     * @return \Illuminate\Http\Response
     */
    public function show(Street $street)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Street  $street
     * @return \Illuminate\Http\Response
     */
    public function edit(Street $street)
    {
        return view('admin.streets.edit',compact('street'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Street  $street
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Street $street)
    {
        try{
            $street->update($request->all());
            Session::flash('success',__('admin.street').' '.__('admin.updated_successful'));
            return response()->json(['success' => true,'url' => route('streets.index')]);
        }catch (\Exception $exception){
            Log::error($exception->getMessage());
            Session::flash('error',__('admin.something_wrong'));
            return response()->json(['success' => false]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Street  $street
     * @return \Illuminate\Http\Response
     */
    public function destroy(Street $street)
    {
        if ($street == null) {
            return back()->with('error', __('admin.not_found', ['model_name' => __('admin.street')]));
        }
        $street->delete();
        return redirect()->route('streets.index')->with('success', __('admin.street').' '.__('admin.deleted_successful'));
    }
}
