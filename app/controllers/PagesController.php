<?php

namespace App\Controllers;

class PagesController {

    public function home() {
        $users = [
            'name' => 'Victor'
        ];
        return view('index', compact('users'));
    }

    public function about() {
       return view('about');
    }
}