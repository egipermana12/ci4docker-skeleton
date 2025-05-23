<?php

namespace App\Controllers;


class Home extends BaseController
{
    public function index(): string
    {
        return view('dashboard/index');
    }

    public function dashboard(): string
    {
        return view('welcome_message');
    }
}
