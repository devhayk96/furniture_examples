<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Announcement\StoreRequest;
use App\Models\Admin;
use App\Models\Announcement;
use App\Models\Category;
use App\Models\DealType;
use App\Models\District;
use App\Models\Region;
use App\Models\Street;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\View\View as ContractsView;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Support\Facades\Storage;

class AnnouncementsController extends BaseAdminController
{
    public function getModel()
    {
        return Announcement::with([
            'admin',
            'category' => function($q) {
                $q->select('id','title_'.app()->getLocale().' as category_title');
            }
        ]);
    }

    public function getFields(): array
    {
        return Announcement::fields();
    }

    protected function resourceName() : string
    {
        return 'announcements';
    }

    protected function tableColumnsCount(): int
    {
        return 6;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return ContractsView|ViewFactory|string
     */
    public function create()
    {
        $categories = Category::whereNull('parent_id')->get();
        $deal_types = DealType::all();
        if (request()->ajax()) {
            $category = Category::findOrFail(request()->get('category_id'));
            $form_items = $category->formItems();
            return view('admin.announcements.partials.form_items', compact('form_items','deal_types', 'categories'))->render();
        }
        return view('admin.announcements.create', compact('categories','deal_types'));
    }

    /**
     * Store a newly created announcement in database.
     *
     * @param StoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $admin = Admin::find(auth()->guard('admin')->id());
            $announcementData = $request->announcement;
            $announcement = $admin->announcements()->create($announcementData);
            $announcement->details()->create($request->details);
            $announcement->additional_infos()->sync($request->additional);
            $announcement->deal_types()->sync($request->deal_types);

            $tmp_dir = '/tmp/'.$admin->id.'/announcement_images/';
            $files = Storage::disk('public')->files($tmp_dir);
            if (count($files)){
                foreach ($files as $key => $file){
                    $path = '/uploads/announcement_images/'.$announcement->id.'/'.basename($file);
                    Storage::disk('public')->move($file,$path);
                    $announcement->announcement_files()->create(['path' => $path]);
                }
            }
            Storage::disk('public')->deleteDirectory($tmp_dir);
            DB::commit();
            Session::flash('success',__('admin.successfully_created').' '.__('admin.announcement'));
            return response()->json(['success' => true,'url' => route('announcements.index')]);

        } catch (\Exception $exception){
            dd($exception->getMessage());
            Log::error($exception->getMessage());
            Session::flash('error',__('admin.something_wrong'));
            return response()->json(['success' => false]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function show(Announcement $announcement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function edit(Announcement $announcement)
    {
        $categories = Category::whereNull('parent_id')->get();
        $deal_types = DealType::all();
        if (\request()->ajax()){
            $category = Category::findOrFail(\request()->get('category_id'));
            $form_items = $category->formItems();
            return view('admin.announcements.partials.form_items',compact('form_items','deal_types','categories','announcement'))->render();
        }
        return view('admin.announcements.edit',compact('announcement','categories','deal_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Announcement $announcement)
    {
        try{
            DB::beginTransaction();
            $announcementData = $request->announcement;
            $announcement->update($announcementData);
            $announcement->details()->create($request->details);
            $announcement->additional_infos()->sync($request->additional);
            $announcement->deal_types()->sync($request->deal_types);

            $files = Storage::disk('public')->files('/tmp/announcement_images/');
            if (count($files)){
                foreach ($files as $key => $file){
                    $path = '/uploads/announcement_images/'.basename($file);
                    Storage::disk('public')->move($file,'/uploads/announcement_images/'.basename($file));
                    $announcement->announcement_files()->create(['path' => $path]);
                }
            }
            Storage::disk('public')->delete('tmp');
            DB::commit();
            Session::flash('success',__('admin.successfully_created').' '.__('admin.announcement'));
            return response()->json(['success' => true,'url' => route('announcements.index')]);

        }catch (\Exception $exception){
            DB::rollBack();
            dd($exception->getMessage());

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Announcement $announcement)
    {
        //
    }

    public function cities_villages(){
        $region_id = \request()->get('region');
        $announcement_id = \request()->get('announcement');
        $region = Region::find($region_id);

        $announcement = $announcement_id ? Announcement::find($announcement_id) : null;

        $cities = $region ? $region->cities : [];
        $villages = $region ? $region->villages : [];
        $districts = District::all();
        $districts_view = '';
        $cities_view = '';
        $villages_view = '';

        if ($region_id == 11){
            $districts_view = view('admin.announcements.partials.districts', compact('districts','announcement'))->render();
        }else{
            $cities_view = view('admin.announcements.partials.cities', compact('cities','announcement'))->render();
            $villages_view = view('admin.announcements.partials.villages', compact('villages','announcement'))->render();
        }
        return response()->json([
            'districts' => $districts_view,
            'cities' => $cities_view,
            'villages' => $villages_view,
        ]);
    }

    public function district_streets(){
        $district_id = \request()->get('district');
        $announcement_id = \request()->get('announcement');
        $announcement = $announcement_id ? Announcement::find($announcement_id) : null;
        $district = District::find($district_id);
        $streets = $district->streets;

        $streets_view = view('admin.announcements.partials.streets', compact('streets','announcement'))->render();
        return response()->json([
            'streets' => $streets_view,
        ]);
    }
}
