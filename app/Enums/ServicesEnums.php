<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 23.01.2022
 * Time: 17:56
 */

namespace App\Enums;


use App\Models\Service;

class ServicesEnums
{
    public static function all()
    {
        $services = Service::all();
        return $services;
    }
}