<?php


namespace App\Services\Framework\Contracts;

interface ISeed
{
    public function run(): void;
}