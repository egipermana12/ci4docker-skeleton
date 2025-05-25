<?php

namespace App\Controllers;

use App\Libraries\BladeRenderer;


class Home extends BaseController
{
    public function index(): string
    {
        return view('dashboard/index');
    }

    public function dashboard(): string
    {
        $blade = new BladeRenderer();
        return $blade->render('welcome_page');
    }
}
