<!DOCTYPE html>

<html>

<head>
</head>

<body>
    <?php
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $t = date("H");
    echo $t;

    if ($t > "06" and $t < "12") {
        echo "Good morning!" . "<br>";
    } else if ($t >= "12" and $t < "18") {
        echo "Good afternoon" . "<br>";
        if ($t == "12") {
            echo "LUNCHTIME NOW";
        }
    } else {
        echo "Good night" . "<br>";
    }

    ?>
</body>

</html>