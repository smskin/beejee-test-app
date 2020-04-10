<?php

namespace App\Services\Framework\Contracts;

interface ICommand
{
    public function execute(): void;
}