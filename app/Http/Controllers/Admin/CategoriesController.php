<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Models\Category;
use Illuminate\Contracts\View\View as ContractsView;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CategoriesController extends BaseAdminController
{
    public function getModel()
    {
        return Category::with([
            'parent' => function($q) {
                $q->select(['id', 'title_'.app()->getLocale().' as parent_title']);
            }
        ]);
    }

    public function getFields(): array
    {
        return Category::fields();
    }

    protected function resourceName() : string
    {
        return 'categories';
    }

    protected function tableColumnsCount(): int
    {
        return 6;
    }

    /**
     * Show the form for creating a new category.
     *
     * @return ViewFactory|ContractsView
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.categories.create', compact('categories'));
    }

    /**
     * Store a newly created category in the database.
     *
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request)
    {
        try {
            Category::create($request->all());
            Session::flash('success',__('admin.successfully_created').' '.__('admin.category'));
            return response()->json(['success' => true,'url' => route('categories.index')]);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Session::flash('error',__('admin.something_wrong'));
            return response()->json(['success' => false]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Category $category
     * @return ViewFactory|ContractsView
     */
    public function edit(Category $category)
    {
        $categories = Category::where('id', '!=' , $category->id)->get();
        return view('admin.categories.edit', compact('category','categories'));
    }

    /**
     * Update the specified category in database.
     *
     * @param UpdateRequest $request
     * @param Category $category
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Category $category)
    {
        try {
            $category->update($request->all());
            Session::flash('success',__('admin.category').' '.__('admin.updated_successful'));
            return response()->json(['success' => true,'url' => route('categories.index')]);

        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Session::flash('error',__('admin.something_wrong'));
            return response()->json(['success' => false]);
        }
    }

    /**
     * Remove the specified category from database.
     *
     * @param Category $category
     * @return RedirectResponse
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return redirect()->route('categories.index')->with('success', __('admin.category').' '.__('admin.deleted_successful'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', __('admin.something_wrong'));
        }
    }


}
