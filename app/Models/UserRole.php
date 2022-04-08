<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    /**
     * @var array
     */

    protected $table = "user_roles";

    protected $fillable = [
        'title_am',
        'title_en',
        'title_ru',
        'desc_am',
        'desc_en',
        'desc_ru',
    ];

    const OWNER_ID = 1;
    const AGENCY_ID = 2;
    const BUILDER_ID = 3;

    /**
     * @return array
     */
    public static function fields()
    {
        return [
            'id' => ['type' => 'field'],
            'title_am' => ['type' => 'field'],
            'title_en' => ['type' => 'field'],
            'title_ru' => ['type' => 'field'],
            'desc_'.app()->getLocale() => ['type' => 'field','class' => 'desc-content'],
        ];
    }

    /**
     * @param Builder $query
     * @param $request
     * @return Builder
     */
    public function scopeFilter(Builder $query, $request)
    {
        $search = $request['search'];
        if ($search && $search != '') {
            $query = $query->where(function ($q) use ($search) {
                $q->where('title_am', 'like', '%' . $search . '%')
                    ->orWhere('title_en', 'like', '%' . $search . '%')
                    ->orWhere('title_ru', 'like', '%' . $search . '%');
            });
        }
        return $query;
    }
}
