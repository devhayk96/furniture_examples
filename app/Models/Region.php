<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $table = 'regions';

    const Aragatsotn_ID = 1;
    const Ararat_ID = 2;
    const Armavir_ID = 3;
    const Gegharkunik_ID = 4;
    const Lori_ID = 5;
    const Kotayk_ID = 6;
    const Shirak_ID = 7;
    const Syunik_ID = 8;
    const Vayots_Dzor_ID = 9;
    const Tavush_ID = 10;
    const Yerevan_ID = 11;

    public function villages()
    {
        return $this->hasMany(Village::class);
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function districts()
    {
        return $this->hasMany(District::class);
    }
}

