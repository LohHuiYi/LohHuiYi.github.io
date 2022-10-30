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
    $months = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec');
    ?>

    <select name="month">
        <?php foreach ($months as $key => $month) { ?>
            <?php $default_month = ($key == $date->format('m')) ? 'selected' : ''; ?>
            <option <?php echo $default_month; ?> value="<?php echo $key; ?>">
                <?php echo $month; ?>
            </option>
        <?php } ?>
    </select>


    <select name="day">
        <?php for ($day = 1; $day <= 31; $day++) { ?>
            <?php $default_day = ($day == $date->format('d')) ? 'selected' : ''; ?>
            <option <?php echo $default_day; ?> value="<?php echo $day; ?>">
                <?php echo $day; ?>
            </option>
        <?php } ?>
    </select>


    <select name="year">
        <?php for ($year = 1900; $year <= 2022; $year++) { ?>
            <?php $default_year = ($year == $date->format('Y')) ? 'selected' : ''; ?>
            <option <?php echo $default_year; ?> value="<?php echo $year; ?>">
                <?php echo $year; ?>
            </option>
        <?php } ?>
    </select>

</body>

</html>