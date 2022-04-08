<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $services = Service::all();
        return view('website.home', compact('services'));
    }

    public function lang($locale)
    {
        app()->setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }
}
