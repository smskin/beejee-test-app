<?php


namespace App\Services\TaskService;


use App\DBContext\DBContextTask;
use App\Services\Framework\Services\View\Exceptions\ValidationException;
use App\Services\TaskService\Contracts\ITaskService;
use App\Services\TaskService\Models\ListResponse;
use App\Services\TaskService\Models\TaskModel;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

class TaskService implements ITaskService
{
    public const FILTER_USER_NAME = 'userName';
    public const FILTER_EMAIL = 'email';
    public const FILTER_STATUS = 'status';

    public const FILTER_DIRECT_ASC = 'asc';
    public const FILTER_DIRECT_DESC = 'desc';

    /**
     * @param int $limit
     * @param int $page
     * @param string $filter
     * @param string $filterDirect
     * @return ListResponse
     * @throws NoResultException
     * @throws NonUniqueResultException
     * @throws ValidationException
     */
    public function getList(int $limit, int $page, string $filter, string $filterDirect): ListResponse
    {
        if (!in_array($filter,[
            self::FILTER_EMAIL,
            self::FILTER_STATUS,
            self::FILTER_USER_NAME
        ])){
            ValidationException::withMessages([
                'filter'=>[
                    'Filter not exists'
                ]
            ]);
        }

        if (!in_array($filterDirect,[
            self::FILTER_DIRECT_ASC,
            self::FILTER_DIRECT_DESC
        ])){
            ValidationException::withMessages([
                'filterDirect'=>[
                    'Filter direct not exists'
                ]
            ]);
        }

        $offset = $page*$limit-$limit;
        $tasks = DBContextTask::builder()
            ->setFirstResult($offset)
            ->setMaxResults($limit);
        switch ($filter){
            case self::FILTER_EMAIL:
                $tasks->orderBy('t.email', $filterDirect);
                break;
            case self::FILTER_STATUS:
                $tasks->orderBy('t.is_closed', $filterDirect);
                break;
            case self::FILTER_USER_NAME:
                $tasks->orderBy('t.username', $filterDirect);
                break;
        }

        $data = [];
        foreach ($tasks->getQuery()->execute() as $task){
            $data[] = (new TaskModel())->fill($task);
        }

        $total =  $this->getTasksCount();
        $pages = (int) ceil( $total / $limit);

        $response = new ListResponse;
        $response->tasks = $data;
        $response->total = $this->getTasksCount();
        $response->limit = $limit;
        $response->offset = $offset;
        $response->count = count($data);
        $response->page = $page;
        $response->pages = $pages;
        return $response;
    }

    /**
     * @param string $userName
     * @param string $email
     * @param string $text
     * @return DBContextTask
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(string $userName, string $email, string $text): DBContextTask
    {
        $context = new DBContextTask();
        $context->setUserName($userName);
        $context->setEmail($email);
        $context->setText($text);
        $context->setClosedStatus(false);
        $context->setEditedByAdminStatus(false);
        $context->save();
        return $context;
    }

    /**
     * @param DBContextTask $task
     * @param string $text
     * @param bool $isClosed
     * @return DBContextTask
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function update(DBContextTask $task, string $text, bool $isClosed): DBContextTask
    {
        $task->setText($text);
        $task->setClosedStatus($isClosed);
        $task->setEditedByAdminStatus(true);
        $task->save();
        return $task;
    }

    /**
     * @return int
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    private function getTasksCount(): int
    {
        $query = DBContextTask::builder()
            ->select('COUNT(t.id) as count')
            ->getQuery()
            ->getSingleResult();
        return (int) $query['count'];
    }

    private static $instance;

    final private function __construct()
    {
    }

    final private function __clone()
    {
    }

    /** @noinspection PhpUnusedPrivateMethodInspection */
    final private function __wakeup()
    {
    }

    public static function getInstance(): ITaskService
    {
        if (is_null(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }
}