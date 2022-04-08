<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WebsiteInfo\StoreRequest;
use App\Http\Requests\Admin\WebsiteInfo\UpdateRequest;
use App\Models\WebsiteInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class WebsiteInfoController extends BaseAdminController
{
    public function getModel()
    {
        return WebsiteInfo::query();
    }

    public function getFields(): array
    {
        return WebsiteInfo::fields();
    }

    protected function resourceName() : string
    {
        return 'website-info';
    }

    protected function tableColumnsCount(): int
    {
        return 5;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WebsiteInfo  $websiteInfo
     * @return \Illuminate\Http\Response
     */
    public function show(WebsiteInfo $websiteInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WebsiteInfo  $websiteInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(WebsiteInfo $websiteInfo)
    {
        return view('admin.website-info.edit',compact('websiteInfo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WebsiteInfo  $websiteInfo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, WebsiteInfo $websiteInfo)
    {
        try{
            $fileName = '';
            if (($request->hasFile('image')) || (!$request->hasFile('image') && $request->is_image)){
                $image = $websiteInfo->photo_service->image_url;
                if ($image && file_exists(public_path("/$image"))){
                    $dirPath = substr($image, 0, strrpos($image, '/'));
                    File::deleteDirectory(public_path("/$dirPath"));
                }
                if ($request->hasFile('image')){
                    $file = $request->file('image');
                    $path = make_directory(['photo-service']);
                    $fileName = save_image($file,0,$path);
                    $fileName = "uploads/photo-service/$fileName";
                }
            }
            $event = $request->request->get('photo_service');
            $event['image_url'] = $fileName;
            $request->request->add(['photo_service' => $event]);
            $websiteInfo->update($request->post());
            Session::flash('success',__('admin.repairing_type').' '.__('admin.updated_successful'));
            return response()->json(['success' => true,'url' => route('website-info.index')]);
        }catch (\Exception $exception){
            Log::error($exception->getMessage());
            Session::flash('error',__('admin.something_wrong'));
            return response()->json(['success' => false]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WebsiteInfo  $websiteInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(WebsiteInfo $websiteInfo)
    {
        try{
            $websiteInfo->delete();
            return redirect()->route('website-info.index')->with('success', __('admin.website_info').' '.__('admin.deleted_successful'));
        }catch (\Exception $exception){
            return redirect()->back()->with('error', __('admin.something_wrong'));
        }
    }
}
