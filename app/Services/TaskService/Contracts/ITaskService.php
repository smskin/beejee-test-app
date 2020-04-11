<?php


namespace App\Services\TaskService\Contracts;


use App\DBContext\DBContextTask;
use App\Services\TaskService\Models\ListResponse;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

interface ITaskService
{
    /**
     * @param int $limit
     * @param int $page
     * @param string $filter
     * @param string $filterDirect
     * @return ListResponse
     */
    public function getList(int $limit, int $page, string $filter, string $filterDirect): ListResponse;

    /**
     * @param string $userName
     * @param string $email
     * @param string $text
     * @return DBContextTask
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(string $userName, string $email, string $text): DBContextTask;

    /**
     * @param DBContextTask $task
     * @param string $text
     * @param bool $isClosed
     * @return DBContextTask
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function update(DBContextTask $task, string $text, bool $isClosed): DBContextTask;
    public static function getInstance(): ITaskService;
}