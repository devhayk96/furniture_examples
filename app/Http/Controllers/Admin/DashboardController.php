<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function lang($locale)
    {
        app()->setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }



    public function upload_tmp(Request $request, $name)
    {
        $path = '/tmp/'. current_admin()->id ."/{$name}/";
        foreach ( $request->file($name) as $file){
            Storage::disk('public')->put($path, $file);
        }
        $images = Storage::disk('public')->files($path);
        return view('admin.announcements.partials.images', compact('images'))->render();
    }

    public function delete_tmp(Request $request)
    {
        $path = $request->delete_all ? '/tmp/'. current_admin()->id .'/' : $request->img_url;
        $request->delete_all
            ? Storage::disk('public')->deleteDirectory($path)
            : Storage::disk('public')->delete($path);

        return response()->json(['success' => true]);
    }
}
