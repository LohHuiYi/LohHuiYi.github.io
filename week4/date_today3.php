<!DOCTYPE html>

<html>

<head>
    <title>Date_today</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
    </style>
</head>

<body>

    <?php
    $date = new DateTime();
    $months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    ?>


    <div class="row justify-content-center p-5">
        <div class="col-2 ">
            <select class="form-select form-select-lg mb-3 bg-info text-light " aria-label=".form-select-lg example">
                <option selected>Day</option>

                <?php
                for ($i = 1; $i <= 31; $i++) {
                ?>
                    <?php $default_day = ($i == $date->format('d')) ? 'selected' : ''; ?>
                    <option <?php echo $default_day; ?> value="<?php echo $i; ?>">
                        <?php echo $i; ?>
                    </option>
                <?php
                }
                ?>

            </select>
        </div>

        <div class="col-2 ">
            <select class="form-select form-select-lg mb-3 bg-warning text-light " aria-label=".form-select-lg example">
                <option selected>Month</option>

                <?php
                foreach ($months as $m) {
                ?>
                    <?php $default_month = ($m == $date->format('F')) ? 'selected' : ''; ?>
                    <option <?php echo $default_month; ?> value="<?php echo $m; ?>">
                        <?php echo $m; ?>
                    </option>
                <?php
                }
                ?>

            </select>
        </div>

        <div class="col-2 ">
            <select class="form-select form-select-lg mb-3 bg-danger text-light " aria-label=".form-select-lg example">
                <option selected>Year</option>

                <?php
                for ($y = 1900; $y <= 2022; $y++) {
                ?>
                    <?php $default_year = ($y == $date->format('Y')) ? 'selected' : ''; ?>
                    <option <?php echo $default_year; ?> value="<?php echo $y; ?>">
                        <?php echo $y; ?>
                    </option>
                <?php
                }
                ?>

            </select>
        </div>
    </div>

</body>

</html>