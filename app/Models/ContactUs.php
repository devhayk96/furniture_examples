<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactUs extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'status'
    ];

    /**
     * @return array
     */
    public static function fields() {
        return [
            'id' => ['type' => 'field'],
            'name' => ['type' => 'field'],
            'email' => ['type' => 'field'],
            'subject' => ['type' => 'field'],
            'message' => ['type' => 'field'],
            'status' => ['type' => 'field'],
        ];
    }

    /**
     * @param Builder $query
     * @param $request
     * @return Builder
     */
    public function scopeFilter(Builder $query,$request){
        $search = $request['search'];
        if ($search && $search != ''){
            $query = $query->where(function ($q) use ($search){
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }
        return $query;
    }
}
