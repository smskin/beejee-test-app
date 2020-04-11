<?php

namespace App\Http\Controllers;

use App\DBContext\DBContextTask;
use App\Services\Framework\Services\View\Exceptions\ValidationException;
use App\Services\TaskService\Models\TaskModel;
use App\Services\TaskService\TaskService;
use Exception;

/** @noinspection PhpUnused */
class TaskController extends Controller
{
    public function index(){
        $limit = (int) input('limit');
        $page = (int) input('page');
        $filter = escape(input('filter'));
        $filterDirect = escape(input('filterDirect'));

        if (!$page){
            $page = 1;
        }

        if (!$limit || $limit > 3){
            $limit = 3;
        }

        if (!$filter){
            $filter = 'userName';
        }

        if (!$filterDirect){
            $filterDirect = 'asc';
        }

        try {
            $service = TaskService::getInstance();
            render_json($service->getList($limit, $page, $filter, $filterDirect));
        } catch (Exception $exception){
            render_exception($exception);
        }
    }

    public function store(){
        $userName = escape(input('userName'));
        $email = escape(input('email'));
        $text = input('text');

        try {
            if (!$userName){
                ValidationException::withMessages([
                    'userName'=>[
                        'User name is required'
                    ]
                ]);
            }

            if (!$email){
                ValidationException::withMessages([
                    'email'=>[
                        'E-mail is required'
                    ]
                ]);
            }

            if (!$text){
                ValidationException::withMessages([
                    'text'=>[
                        'Text is required'
                    ]
                ]);
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                ValidationException::withMessages([
                    'email'=>[
                        'E-mail not correct'
                    ]
                ]);
            }

            $service = TaskService::getInstance();
            $task = $service->create(
                $userName,
                $email,
                $text
            );

            render_json((new TaskModel())->fill($task));
        } catch (Exception $exception){
            render_exception($exception);
        }
    }

    /**
     * @param int $taskId
     */
    public function update(int $taskId){
        if (!auth()->check()){
            abort(401);
        }

        $text = input('text');
        $isClosed = boolval(input('isClosed'));

       try {
           if (!$text){
               ValidationException::withMessages([
                   'text'=>[
                       'Text is required'
                   ]
               ]);
           }

           $task = DBContextTask::find($taskId);
           if (!$task){
               abort(404);
           }

           $service = TaskService::getInstance();
           $service->update(
               $task,
               $text,
               $isClosed
           );

           render_json((new TaskModel())->fill($task));
       } catch (Exception $exception){
           render_exception($exception);
       }
    }
}