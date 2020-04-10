<?php

namespace App\Services\Framework\Contracts;

use Doctrine\ORM\QueryBuilder;

interface IModel
{
    public function save(): IModel;
    public function flush(): IModel;
    public static function get(): array;
    public static function find(int $id): ?IModel;
    public static function builder(): QueryBuilder;
}