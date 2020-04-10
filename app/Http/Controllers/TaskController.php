<?php

namespace App\Http\Controllers;

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

        if (!$page){
            $page = 1;
        }

        if (!$limit || $limit > 3){
            $limit = 3;
        }

        if (!$filter){
            $filter = 'userName';
        }

        try {
            $service = TaskService::getInstance();
            render_json($service->getList($limit, $page, $filter));
        } catch (Exception $exception){
            render_exception($exception);
        }
    }

    public function store(){
        $userName = escape(input('userName'));
        $email = escape(input('email'));
        $text = escape(input('text'));

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
        } catch (ValidationException $exception){
            render_exception($exception);
        }
    }
}