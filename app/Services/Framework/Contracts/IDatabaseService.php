<?php

namespace App\Services\Framework\Contracts;

use Doctrine\ORM\EntityManager;

interface IDatabaseService
{
    public function getEntityManager(): EntityManager;
}