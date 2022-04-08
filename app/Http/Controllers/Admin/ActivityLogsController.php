<?php

namespace App\Http\Controllers\Admin;

 use App\Models\ActivityLog;
 use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityLogsController extends BaseAdminController
{
    public function getModel()
    {
        return ActivityLog::query();
    }

    public function getFields(): array
    {
        return ActivityLog::fields();
    }

    protected function resourceName() : string
    {
        return 'activity-logs';
    }

    protected function tableColumnsCount(): int
    {
        return 6;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  Activity  $activityLog
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activityLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Activity  $activityLog
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activityLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Activity  $activityLog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activityLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Activity  $activityLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activityLog)
    {
        //
    }
}
