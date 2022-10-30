<!DOCTYPE html>

<html>

<head>
    <title>IC Info Generator</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
    </style>
</head>

<body>
    <?php
    $IC = "991112-14-1273";
    $day = substr($IC, 4, 2);
    $month = substr($IC, 2, 2);
    $gender = substr($IC, 13);
    $DOB = substr($IC, 0, 6);
    ?>

    <div class="container-fluid">
        <div class="bg-dark text-warning justify-content-center text-center">
            <?php
            if ($gender % 2) {
                echo "<b>Mr</b> <br>";
            } else {
                echo "<b>Ms</b> <br>";
            }
            ?>
        </div>
    </div>

    <div class="container-fluid">
        <div class="bg-dark text-warning justify-content-center text-center">
            <?php
            $icDOB = date_create_from_format("ymd", $DOB);
            echo date_format($icDOB, "<b> M d, Y </b>");
            echo "<br>";
            ?>
        </div>
    </div>

    <div class="container-fluid">
        <div class="bg-warning text-dark justify-content-center text-center">
            <?php
            function getsign($day, $month)
            {
                if (($month == 1 && $day > 19) || ($month == 2 && $day < 19)) {
                    $mysign = "<b>Aquarius</b>";
                    echo "<img src='images/Aquarius.png' /><br>";
                } else if (($month == 2 && $day > 18) || ($month == 3 && $day < 21)) {
                    $mysign = "<b>Pisces</b>";
                    echo "<img src='images/Pisces.png' /><br>";
                } else if (($month == 3 && $day > 20) || ($month == 4 && $day < 21)) {
                    $mysign = "<b>Aries</b>";
                    echo "<img src='images/Aries.png' /><br>";
                } else if (($month == 4 && $day > 20) || ($month == 5 && $day < 22)) {
                    $mysign = "<b>Taurus</b>";
                    echo "<img src='images/Taurus.png' /><br>";
                } else if (($month == 5 && $day > 21) || ($month == 6 && $day < 22)) {
                    $mysign = "<b>Gemini</b>";
                    echo "<img src='images/Gemini.png' /><br>";
                } else if (($month == 6 && $day > 21) || ($month == 7 && $day < 24)) {
                    $mysign = "<b>Cancer</b>";
                    echo "<img src='images/Cancer.png' /><br>";
                } else if (($month == 7 && $day > 23) || ($month == 8 && $day < 24)) {
                    $mysign = "<b>Leo</b>";
                    echo "<img src='images/Leo.png' /><br>";
                } else if (($month == 8 && $day > 23) || ($month == 9 && $day < 24)) {
                    $mysign = "<b>Virgo</b>";
                    echo "<img src='images/Virgo.png' /><br>";
                } else if (($month == 9 && $day > 23) || ($month == 10 && $day < 24)) {
                    $mysign = "<b>Libra</b>";
                    echo "<img src='images/Libra.png' /><br>";
                } else if (($month == 10 && $day > 23) || ($month == 11 && $day < 23)) {
                    $mysign = "<b>Scorpio</b>";
                    echo "<img src='images/Scorpio.png' /><br>";
                } else if (($month == 11 && $day > 22) || ($month == 12 && $day < 23)) {
                    $mysign = "<b>Sagittarius</b>";
                    echo "<img src='images/Sagittarius.png' /><br>";
                } else if (($month == 12 && $day > 22) || ($month == 1 && $day < 21)) {
                    $mysign = "<b>Capricorn</b>";
                    echo "<img src='images/Capricorn.png' /><br>";
                }
                return $mysign;
            }
            echo (getsign($day, $month));
            ?>
        </div>
    </div>

</body>

</html>