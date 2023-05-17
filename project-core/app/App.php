<?php

declare(strict_types = 1);

define('CSV_PATH', __DIR__ . "/../transaction_files/");

$csv_files = scandir(CSV_PATH);
$csv_data = [];

foreach ($csv_files as $file):
  if (pathinfo($file, PATHINFO_EXTENSION) === 'csv'):

    $file_path = CSV_PATH . $file;
    $csv_file = fopen($file_path, 'r');

    fgetcsv($csv_file);

    while (($row = fgetcsv($csv_file)) !== false):
      $csv_data[] = $row;
    endwhile;

    fclose($csv_file);

  endif;
endforeach;