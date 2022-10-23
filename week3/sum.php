<!DOCTYPE html>

<html>

<head>
    <title>Random Num Color</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
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

    <div class="container-fluid">
        <div class="alert alert-danger" role="alert">
            <?php
            $sum = 0;

            for ($x = 1; $x <= 100; $x++) {
                $sum += $x;

                if ($x % 2 == 0) {
                    echo "<strong>" . $x . "</strong>";
                    if ($x < 100) {
                        echo "+";
                    }
                } else {
                    echo $x, "+";
                }
            }

            echo "=" . $sum;
            ?>
        </div>
    </div>
</body>

</html>