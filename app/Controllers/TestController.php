<?php

namespace App\Controllers;

use App\Core\BaseController;
use App\Core\Session;

class TestController extends BaseController
{
    public function test()
    {
        // Session::set("is_admin", 1);
        // Session::destroySession();
        // Session::regenerate();
        // dd(Session::is_Admin());
        // dd($_SESSION);
        // echo "<br>";
        $xss = '<script>alert("XSS")</script>';
        // echo "Test";
        return view('test', [
            'title' => 'Test - Page',
            'xss' => $xss,
        ]);
    }
}
