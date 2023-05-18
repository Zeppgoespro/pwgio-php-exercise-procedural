<?php

declare(strict_types=1);

function format_amount(float $amount): string
{
  $is_negative = $amount < 0;

  return ($is_negative ? '-' : '') . '$' . number_format(abs($amount), 2);
}

function format_date(string $date): string
{
  return date('M j, Y', strtotime($date));
}