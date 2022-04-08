<?php

namespace App\Http\Controllers\Admin;

use App\Models\ContactUs;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContactUsController extends BaseAdminController
{
    public function getModel()
    {
        return ContactUs::query();
    }

    public function getFields(): array
    {
        return ContactUs::fields();
    }

    protected function resourceName() : string
    {
        return 'contact-us';
    }

    protected function tableColumnsCount(): int
    {
        return 6;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $contact = ContactUs::find($id);
            if ($contact){
                $contact->delete();
            }
            return redirect()->route('contact-us.index')->with('success', __('admin.contact-us').' '.__('admin.deleted_successful'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', __('admin.something_wrong'));
        }
    }
}
