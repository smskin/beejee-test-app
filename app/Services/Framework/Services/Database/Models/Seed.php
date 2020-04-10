<?php


namespace App\Services\Framework\Services\Database\Models;

use App\Services\Framework\Contracts\ISeed;

abstract class Seed implements ISeed
{
    public function seed(): void
    {

    }

    public function run(): void
    {
        echo 'Run seed: '.static::class.PHP_EOL;
        $this->seed();
    }
}