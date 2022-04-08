<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Status\StoreRequest;
use App\Http\Requests\Admin\Status\UpdateRequest;
use App\Models\SellerStatus;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class SellerStatusesController extends BaseAdminController
{
    public function getModel()
    {
        return SellerStatus::query();
    }

    public function getFields():array
    {
        return SellerStatus::fields();
    }

    protected function resourceName() : string
    {
        return 'seller-statuses';
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
            SellerStatus::create($request->all());
            Session::flash('success',__('admin.successfully_created').' '.__('admin.status'));
            return response()->json(['success' => true, 'url' => route('seller-statuses.index')]);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Session::flash('error',__('admin.something_wrong'));
            return response()->json(['success' => false]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SellerStatus  $status
     * @return \Illuminate\Http\Response
     */
    public function show(SellerStatus $status)
    {
        //
    }

    /**
     * Show the form for editing the specified seller status.
     * @param SellerStatus $status
     * @return Factory|View
     */
    public function edit(SellerStatus $status)
    {
        $status = SellerStatus::find($status->id);
        return view('admin.seller-statuses.edit', compact('status'));
    }

    /**
     * Update the specified seller status in database.
     *
     * @param UpdateRequest $request
     * @param SellerStatus $status
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, SellerStatus $status)
    {
        try {
            $status->update($request->all());
            Session::flash('success',__('admin.status').' '.__('admin.updated_successful'));
            return response()->json(['success' => true, 'url' => route('seller-statuses.index')]);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Session::flash('error',__('admin.something_wrong'));
            return response()->json(['success' => false]);
        }
    }

    /**
     * Remove the specified seller-status from database.
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $status = SellerStatus::find($id);
            if ($status){
                $status->delete();
            }
            return redirect()->route('seller-statuses.index')->with('success', __('admin.status').' '.__('admin.deleted_successful'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', __('admin.something_wrong'));
        }
    }
}
