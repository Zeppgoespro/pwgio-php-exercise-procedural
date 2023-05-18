<?php

declare(strict_types = 1);

$root = __DIR__ . DIRECTORY_SEPARATOR;

define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('FILES_PATH', $root . 'transaction_files' . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR);

require APP_PATH . 'App.php';
require APP_PATH . 'View.php';

$files = get_transaction_files(FILES_PATH);

$transactions = [];

foreach ($files as $file):
  $transactions = array_merge($transactions, get_transactions($file, 'extract_transaction'));
endforeach;

$totals = calculate_totals($transactions);

require VIEWS_PATH . 'transactions.php';