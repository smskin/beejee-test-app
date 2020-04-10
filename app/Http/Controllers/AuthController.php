<?php

namespace App\Http\Controllers;

use App\Services\Framework\Services\View\Exceptions\ValidationException;

/** @noinspection PhpUnused */
class AuthController extends Controller
{
    /** @noinspection PhpUnused */
    public function index(){
        render_view('auth/login.tpl', [
            'bodyClass'=>'text-center'
        ]);
    }

    /** @noinspection PhpUnused */
    public function login(){
        $userName = escape(input('userName'));
        $password = input('password');

        try {
            app()->getAuthorizationService()->attempt(
                $userName,
                $password
            );

            render_json((object)[
                'result'=>true
            ]);
        } catch (ValidationException $exception){
            render_exception($exception);
        }
    }
}