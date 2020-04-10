<?php

namespace App\Http\Controllers;

/** @noinspection PhpUnused */
class HomeController extends Controller
{
    /** @noinspection PhpUnused */
    public function index(){
        render('home.tpl', [
            'a1'=>'dsasdsandsand'
        ]);
    }
}