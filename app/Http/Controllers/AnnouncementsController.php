<?php

namespace App\Http\Controllers;

use App\Enums\AnnouncementsEnum;
use App\Http\Requests\Admin\Announcement\StoreRequest;
use App\Http\Requests\Admin\Announcement\UpdateRequest;
use App\Models\Announcement;
use App\Models\Category;
use App\Models\DealType;
use App\Models\District;
use App\Models\Region;
use App\Models\Street;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AnnouncementsController extends Controller
{

    public function list(){
        $announcements = Announcement::where([
            'user_id' => auth()->id()
        ])->get();
        return view('website.announcements.list',compact('announcements'));
    }

    public function create()
    {
        $categories = Category::whereNull('parent_id')->get();
        $deal_types = DealType::all();
        if (\request()->ajax()){
            $category = Category::findOrFail(\request()->get('category_id'));
            $form_items = $category->formItems();
            return view('website.announcements.partials.form_items',compact('form_items','deal_types','categories'))->render();
        }
        return view('website.announcements.create',compact('categories','deal_types'));
    }

    public function edit($slug){
        $announcement = Announcement::where(['slug' => $slug])->first();
        $categories = Category::whereNull('parent_id')->get();
        $deal_types = DealType::all();
        if (\request()->ajax()){
            $category = Category::findOrFail(\request()->get('category_id'));
            $form_items = $category->formItems();
            return view('website.announcements.partials.form_items',compact('announcement','form_items','deal_types','categories'))->render();
        }
        return view('website.announcements.edit',compact('announcement','categories','deal_types'));
    }

    public function details($slug){
        $announcement = Announcement::where(['slug' => $slug])->first();
        return view('website.announcements.details',compact('announcement'));
    }

    public function store(StoreRequest $request){
        try {
            DB::beginTransaction();
            $user = User::find(auth()->id());
            $announcementData = $request->announcement;
            $announcement = $user->announcements()->create($announcementData);
            $announcement->details()->create($request->details);
            $announcement->additional_infos()->sync($request->additional);
            $announcement->deal_types()->sync($request->deal_types);

            $tmp_dir = '/tmp/'.$user->id.'/announcement_images/';
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
            return response()->json(['success' => true,'url' => route('profile.announcements')]);

        } catch (\Exception $exception){
//            dd($exception->getMessage());
            Log::error($exception->getMessage());
            Session::flash('error',__('admin.something_wrong'));
            return response()->json(['success' => false],422);
        }
    }

    public function update(UpdateRequest $request, $id){
        try {
            DB::beginTransaction();
            $announcement = Announcement::find($id);
            $user = User::find(auth()->id());
            $announcementData = $request->announcement;
            $announcement->update($announcementData);
            $announcement->details()->update($request->details);
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
            Session::flash('success',__('admin.updated_successful'));
            return response()->json(['success' => true,'url' => route('profile.announcements')]);

        } catch (\Exception $exception){
            dd($exception->getMessage());
            Log::error($exception->getMessage());
            Session::flash('error',__('admin.something_wrong'));
            return response()->json(['success' => false],422);
        }
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
            $districts_view = view('admin.announcements.partials.districts', compact('districts', 'announcement'))->render();
        }else{
            $cities_view = view('admin.announcements.partials.cities', compact('cities', 'announcement'))->render();
            $villages_view = view('admin.announcements.partials.villages', compact('villages', 'announcement'))->render();
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

    public function delete($id){
        try{
            $announcement = Announcement::find($id);
            $announcement->update(['status' => AnnouncementsEnum::ARCHIVE]);
            return response()->json(['success' => true]);
        }catch (\Exception $exception){
            return response()->json(['success' => false]);
        }
    }
}
