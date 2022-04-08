<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\ContactUs;
use App\Models\Page;
use App\Models\Service;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class WebsiteController extends Controller
{
    /**
     * @return Factory|View
     */
    public function aboutUs()
    {
        $page_data = Page::firstWhere(['slug' => 'about-us']);
        return view('website.about-us', compact('page_data'));
    }

    /**
     * @param $service
     * @return Factory|View
     */
    public function service($service)
    {
        $page_data = Service::where(['menu_title_en' => $service])->first();
        return view('website.service', compact('page_data'));
    }

    /**
     * @return Factory|View
     */
    public function contactUsPage()
    {
        return view('website.contact-us');
    }

    /**
     * @param ContactRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function contact(ContactRequest $request)
    {
        try {
            if ($request->has('isLogged')){
                $request->request->add(['name' => auth()->user()->full_name, 'email' => auth()->user()->email]);
            }
            ContactUs::create($request->all());
            return response()->json(['success' => true], 200);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json(['message' => $exception->getMessage()], 417);
        }
    }

    /**
     * @return Factory|View
     */
    public function termsOfUse()
    {
        $page_data = Page::firstWhere(['slug' => 'terms-of-use']);
        return view('website.terms-of-use', compact('page_data'));
    }

    public function upload_tmp(Request $request, $name)
    {
        $path = '/tmp/'. auth()->id() ."/{$name}/";
        foreach ( $request->file($name) as $file){
            Storage::disk('public')->put($path, $file);
        }
        $images = Storage::disk('public')->files($path);
        return view('website.announcements.partials.images', compact('images'))->render();
    }

    public function delete_tmp(Request $request)
    {
        $path = $request->delete_all ? '/tmp/'. auth()->id() .'/' : $request->img_url;
        $request->delete_all
            ? Storage::disk('public')->deleteDirectory($path)
            : Storage::disk('public')->delete($path);

        return response()->json(['success' => true]);
    }

    public function showMessageModal(Request $request): string
    {
        $key = $request->get('key') ?? 'successfully_done';
        $message = __("main.{$key}");

        return view('website.message', compact('message'))->render();
    }

}
