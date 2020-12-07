<?php

namespace App\Controllers;

class PagesController {

    public function home() {
        header("Location: clients");
    }

    public function login() {
        if(isset($_COOKIE['token']))
            header("Location: clients");
        return view('login');
    }

    public function register() {
        return view('register');
    }
}