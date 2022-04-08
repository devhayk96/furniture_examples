<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Spatie\Permission\Models\Role as SpatieRole;

class AdminRole extends SpatieRole
{
    public $guard_name = 'admin';

    public static function fields()
    {
        return [
            'id' => ['type' => 'field'],
            'name' => ['type' => 'field'],
            'name_en' => ['type' => 'field'],
            'name_ru' => ['type' => 'field'],
        ];
    }

    public function scopeFilter(Builder $query, $request)
    {
        if ($search = $request['search']){
            $query = $query->where(function ($q) use ($search){
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('name_en', 'like', '%' . $search . '%')
                    ->orWhere('name_ru', 'like', '%' . $search . '%');
            });
        }
        return $query;
    }

    public function getPermissionIdsAttribute()
    {
        return $this->permissions()->pluck('id')->toArray();
    }

    public function filters()
    {
        return ['role' => Admin::all()];
    }
}
