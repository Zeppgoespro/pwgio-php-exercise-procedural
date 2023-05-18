<?php

declare(strict_types = 1);

function get_transaction_files(string $dir_path): array
{
  $files = [];

  foreach (scandir($dir_path) as $file):

    if (is_dir($file)):
      continue;
    endif;

    $files[] = $dir_path . $file;

  endforeach;

  return $files;
}

function get_transactions(string $file_name, ?callable $transaction_handler = null): array
{
  if (! file_exists($file_name)):
    trigger_error('File "' . $file_name . '" does not exist', E_USER_ERROR);
  endif;

  $file = fopen($file_name, 'r');

  fgetcsv($file);

  $transactions = [];

  while (($transaction = fgetcsv($file)) !== false):

    if ($transaction_handler !== null):
      $transaction = $transaction_handler($transaction);
    endif;

    $transactions[] = $transaction;

  endwhile;

  return $transactions;
}

function extract_transaction(array $transaction_row): array
{
  [$date, $check, $description, $amount] = $transaction_row;

  $amount = (float) str_replace(['$', ','], '', $amount);

  return [
    'date'        => $date,
    'check'       => $check,
    'description' => $description,
    'amount'      => $amount
  ];
}

function calculate_totals(array $transaction): array
{
  $totals = ['net_total' => 0, 'total_income' => 0, 'total_expense' => 0];

  foreach ($transaction as $transaction):

    $totals['net_total'] += $transaction['amount'];

    if ($transaction['amount'] >= 0):
      $totals['total_income'] += $transaction['amount'];
    else:
      $totals['total_expense'] += $transaction['amount'];
    endif;

  endforeach;

  return $totals;
}