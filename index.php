<?php

require 'core/bootstrap.php';

$db = Db::connect();

$uri = trim($_SERVER['REQUEST_URI'], '/');

require Router::load('routes.php')->direct(REQUEST::uri());

