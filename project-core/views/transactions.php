<!DOCTYPE html>
<html>
    <head>
        <title>Transaction table</title>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
                text-align: center;
            }

            table tr th, table tr td {
                padding: 5px;
                border: 1px #eee solid;
            }

            tfoot tr th, tfoot tr td {
                font-size: 20px;
            }

            tfoot tr th {
                text-align: right;
            }
        </style>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Check #</th>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php

                    foreach ($csv_data as $row):

                        $date = $row[0];
                        $check = $row[1];
                        $descr = $row[2];
                        $amount = $row[3];

                        echo '<tr>';

                        echo '<td>' . date('M d, Y', strtotime($date)) . '</td>';

                        echo '<td>' . $check . '</td>';
                        echo '<td>' . $descr . '</td>';

                        $float_amount = (float) preg_replace('/[^0-9-.]/', '', $amount);

                        if ($float_amount < 0):
                            echo '<td style="color: red;">' . $amount . '</td>';
                        elseif ($float_amount === 0):
                            echo '<td>' . $amount . '</td>';
                        else:
                            echo '<td style="color: green;">' . $amount . '</td>';
                        endif;

                        echo '</tr>';

                    endforeach;

                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Total Income:</th>
                    <td>
                        <?php

                            $amount_pos = 0;

                            foreach ($csv_data as $row):

                                $amount = $row[3];
                                $float_amount = (float) preg_replace('/[^0-9-.]/', '', $amount);

                                if ($float_amount > 0):
                                    $amount_pos += $float_amount;
                                endif;

                            endforeach;

                            echo ($amount_pos >= 0) ? '$' . number_format($amount_pos, 2, '.', ',') : '-$' . number_format(abs($amount_pos), 2, '.', ',');

                        ?>
                    </td>
                </tr>
                <tr>
                    <th colspan="3">Total Expense:</th>
                    <td>
                        <?php

                            $amount_neg = 0;

                            foreach ($csv_data as $row):

                                $amount = $row[3];
                                $float_amount = (float) preg_replace('/[^0-9-.]/', '', $amount);

                                if ($float_amount < 0):
                                    $amount_neg += $float_amount;
                                endif;

                            endforeach;

                            echo ($amount_neg >= 0) ? '$' . number_format($amount_neg, 2, '.', ',') : '-$' . number_format(abs($amount_neg), 2, '.', ',');

                        ?>
                    </td>
                </tr>
                <tr>
                    <th colspan="3">Net Total:</th>
                    <td>
                        <?php

                            $amount_total = $amount_pos + $amount_neg;
                            echo ($amount_total >= 0) ? '$' . number_format($amount_total, 2, '.', ',') : '-$' . number_format(abs($amount_total), 2, '.', ',');

                        ?>
                    </td>
                </tr>
            </tfoot>
        </table>
    </body>
</html>