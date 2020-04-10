<?php


namespace App\Services\TaskService\Contracts;


use App\DBContext\DBContextTask;
use App\Services\Framework\Services\View\Exceptions\ValidationException;
use App\Services\TaskService\Models\ListResponse;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

interface ITaskService
{
    /**
     * @param int $limit
     * @param int $page
     * @param string $filter
     * @return ListResponse
     * @throws NoResultException
     * @throws NonUniqueResultException
     * @throws ValidationException
     */
    public function getList(int $limit, int $page, string $filter): ListResponse;
    public function create(string $userName, string $email, string $text): DBContextTask;
    public static function getInstance(): ITaskService;
}