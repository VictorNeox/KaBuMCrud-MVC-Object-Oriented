<?php

require 'vendor/autoload.php';

require 'core/bootstrap.php';

use App\Core\{Router, Request};


$uri = trim($_SERVER['REQUEST_URI'], '/');

Router::load('app/routes.php')
    ->direct(Request::uri(), Request::method());