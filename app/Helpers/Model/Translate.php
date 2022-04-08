<?php

namespace App\Helpers\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Translate
{
    /**
     * @param  Model  $model
     * @return array
     */
    public static function getTableColumns(Model $model): array
    {
        return Schema::getColumnListing($model->getTable());
    }

    /**
     * @param  string  $translateNamespace
     * @param  array  $data
     * @return array
     */
    public static function getDataWithTranslate(string $translateNamespace, array $data): array
    {
        $translateItems = [];

        foreach ($data as $item) {
            $translateItems[$item] = __($translateNamespace.'.'.$item);
        }

        return $translateItems;
    }
}
