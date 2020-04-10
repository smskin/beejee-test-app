<?php


namespace App\Services\TaskService\Models;

use App\DBContext\DBContextTask;

class TaskModel
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $userName;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $text;

    /**
     * @var bool
     */
    public $isClosed;

    public function fill(DBContextTask $task): TaskModel
    {
        $this->id = $task->getId();
        $this->userName = $task->getUserName();
        $this->email = $task->getEmail();
        $this->text = $task->getText();
        $this->isClosed = $task->isClosed();
        return $this;
    }
}