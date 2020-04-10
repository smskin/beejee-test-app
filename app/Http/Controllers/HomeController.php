<?php

namespace App\Http\Controllers;

/** @noinspection PhpUnused */
class HomeController extends Controller
{
    /** @noinspection PhpUnused */
    public function index(){
        render_view('home.tpl', [
            'a1'=>'dsasdsandsand'
        ]);
    }
}