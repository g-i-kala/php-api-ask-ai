<?php

namespace App\Http\Controllers;

class HomeController
{
    public function index()
    {
        view('index.view.php', [
            'title' => 'Welcome',
            'message' => 'Hello!']);

    }

}
