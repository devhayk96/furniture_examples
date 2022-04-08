<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $table = 'districts';

    protected $fillable = [
        'title_am',
        'title_en',
        'title_ru',
        'region_id',
        'city_id',
    ];

    public function streets()
    {
        return $this->hasMany(Street::class);
    }

}
