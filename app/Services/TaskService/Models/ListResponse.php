<?php


namespace App\Services\TaskService\Models;

class ListResponse
{
    /**
     * @var TaskModel[]
     */
    public $tasks = [];

    /**
     * @var int
     */
    public $total;

    /**
     * @var int
     */
    public $limit;

    /**
     * @var int
     */
    public $offset;

    /**
     * @var int
     */
    public $count;
}