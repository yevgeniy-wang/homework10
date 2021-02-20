<?php


namespace Hillel\Homework10\Controller;

use Illuminate\Http\RedirectResponse;

class HomeController
{
    public function index()
    {
        return view('pages/index');
    }
}
