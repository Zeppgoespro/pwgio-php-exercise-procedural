<?php

declare(strict_types = 1);

$root = __DIR__ . DIRECTORY_SEPARATOR;

define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
include_once APP_PATH . 'App.php';

define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR);
include_once VIEWS_PATH . 'transactions.php';