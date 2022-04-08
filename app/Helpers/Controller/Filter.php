<?php

namespace App\Helpers\Controller;

use Illuminate\Http\Request;

class Filter
{
    const DEFAULT_OPERATOR = '=';

    const ALLOWED_OPERATORS = [
        '=',
        'LIKE',
        '>=',
        '<=',
        '<>',
        '>',
        '<'
    ];

    /**
     * @return array
     * @throws \Exception
     */
    public static function getFilterByRequest(): array
    {
        $filter = [];
        $filterRequest = [];

        $request = \request();

        if ($request->get('filter')) {
            $filterRequest = $request->get('filter');
        }

        foreach ($filterRequest as $filterName => $filterValue) {
            $filterOperator = static::DEFAULT_OPERATOR;

            $filterNameData = explode('|', $filterName);

            if (count($filterNameData) > 1) {
                $filterOperator = $filterNameData[0];
                $filterName     = $filterNameData[1];
            }

            if(!in_array($filterOperator, static::ALLOWED_OPERATORS)) {
                throw new \Exception("Invalid operator {$filterOperator}");
            }

            $filter[] = [$filterName, $filterOperator, $filterValue];
        }

        return $filter;
    }
}
