<!DOCTYPE html>

<html>

<head>
    <style>
    </style>
</head>

<body>

    <?php
    $numbers = range(1, 100);
    echo implode('+', $numbers) . '=' . array_sum($numbers);
    ?>

    <?php

    $start = 1;
    $end = 10;

    $sum = 0;
    for ($i = $start; $i <= $end; $i++) {
        $sum += $i;
    }

    echo implode('+', range($start, $end)) . '=' . $sum;

    ?>

</body>

</html>