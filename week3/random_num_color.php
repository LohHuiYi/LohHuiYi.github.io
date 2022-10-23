<!DOCTYPE html>

<html>

<head>
    <style>
        .randColor1 {
            color: red;
            font-weight: bold;
        }

        .randColor2 {
            color: blue;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <?php
    $rannum = rand(100, 200);
    $rannum2 = rand(100, 200);

    if ($rannum > $rannum2) {
        echo "<span class=\"randColor1\">";
        echo ($rannum . "<br>");
        echo "</span> ";
        echo ($rannum2 . "<br>");
    } else {
        echo ($rannum . "<br>");
        echo "<span class=\"randColor2\">";
        echo ($rannum2 . "<br>");
        echo "</span> ";
    }

    ?>

</body>

</html>