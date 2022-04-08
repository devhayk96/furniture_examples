<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DealType\StoreRequest;
use App\Http\Requests\Admin\DealType\UpdateRequest;
use App\Models\DealType;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class DealTypesController extends BaseAdminController
{
    public function getModel()
    {
        return DealType::query();
    }

    public function getFields(): array
    {
        return DealType::fields();
    }

    protected function resourceName() : string
    {
        return 'deal-types';
    }

    protected function tableColumnsCount(): int
    {
        return 5;
    }

    /**
     * Show the form for creating a new deal type.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.deal-types.create');
    }

    /**
     * Store a newly created deal type in database.
     *
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request)
    {
        try {
            DealType::create($request->all());
            Session::flash('success', __('admin.successfully_created') . ' ' . __('admin.deal_type'));
            return response()->json(['success' => true, 'url' => route('deal-types.index')]);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Session::flash('error', __('admin.something_wrong'));
            return response()->json(['success' => false]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param DealType $dealType
     * @return Response
     */
    public function show(DealType $dealType)
    {
        //
    }

    /**
     * Show the form for editing the specified deal type.
     *
     * @param DealType $dealType
     * @return Factory|View
     */
    public function edit(DealType $dealType)
    {
        return view('admin.deal-types.edit', compact('dealType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param DealType $dealType
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, DealType $dealType)
    {
        try {
            $dealType->update($request->all());
            Session::flash('success', __('admin.successfully_updated') . ' ' . __('admin.deal_type'));
            return response()->json(['success' => true, 'url' => route('deal-types.index')]);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Session::flash('error', __('admin.something_wrong'));
            return response()->json(['success' => false]);
        }
    }

    /**
     * Remove the specified deal type from database.
     *
     * @param DealType $dealType
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(DealType $dealType)
    {
        try {
            $dealType->delete();
            return redirect()->route('deal-types.index')->with('success', 'Successfully deleted Deal type!');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }
}
