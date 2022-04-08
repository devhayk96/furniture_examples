<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Pages\StoreRequest;
use App\Http\Requests\Admin\Pages\UpdateRequest;
use App\Models\DealType;
use App\Models\Page;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class PagesController extends BaseAdminController
{
    public function getModel()
    {
        return Page::query();
    }

    public function getFields(): array
    {
        return Page::fields();
    }

    protected function resourceName() : string
    {
        return 'pages';
    }

    protected function tableColumnsCount(): int
    {
        return 5;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return Response
     */
    public function store(StoreRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified page.
     *
     * @param Page $page
     * @return Factory|View
     */
    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    /**
     * Update the specified page in database.
     *
     * @param UpdateRequest $request
     * @param Page $page
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Page $page)
    {
        try {
            $data = $request->all();
            $page->update($request->all());
            if ($image = $request->file('image')){
                File::deleteDirectory(public_path("uploads/about-us"));
                $path = make_directory('about-us');
                $fileName = save_image($request->file('image'),0, $path);
                $data['image'] = "/uploads/about-us/$fileName";
            }
            $page->update($data);
            Session::flash('success',__('admin.page').' '.__('admin.updated_successful'));
            return response()->json(['success' => true,'url' => route('pages.index')]);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Session::flash('error',__('admin.something_wrong'));
            return response()->json(['success' => false]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return Response
     */
    public function destroy(Page $page)
    {
        //
    }
}
