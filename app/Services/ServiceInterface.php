<?php

namespace App\Services;

interface ServiceInterface
{
    /**
     * @return bool
     */
    public function run(): bool;
}
