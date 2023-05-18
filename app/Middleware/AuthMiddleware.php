<?php

namespace App\Middleware;

use App\Core\Session;

class AuthMiddleware
{
    public function handle()
    {
        //
    }
    //Check if admin is logged in, redirect to admin home page.
    public function adminTrue()
    {
        if (Session::is_Admin() === true) {
            // header('location: /admin');
            redirect('/admin');
            // exit();
        }
    }
    //Check if admin is NOT logged in, redirect to admin login page.
    public function adminFalse()
    {
        if (Session::is_Admin() === false) {
            // header('location: /admin/login');
            redirect('/admin/login');
            // exit();
        }
    }
}
