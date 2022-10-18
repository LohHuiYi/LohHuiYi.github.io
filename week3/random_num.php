<!DOCTYPE html>

<html>

<head>
    <style>
        .line1 {
            color: green;
            font-style: italic;
        }

        .line2 {
            color: blue;
            font-style: italic;
        }

        .line3 {
            color: red;
            font-weight: bold;
        }

        .line4 {
            color: black;
            font-style: italic;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <?php
    $rannum = rand(100, 200);
    $rannum2 = rand(100, 200);

    echo "<span class=\"line1\" >";
    echo ($rannum . "<br>");
    echo "</span> ";

    echo "<span class=\"line2\" >";
    echo ($rannum2 . "<br>");
    echo "</span> ";

    echo "<span class=\"line3\" >";
    echo ($rannum + $rannum2 . "<br>");
    echo "</span> ";

    echo "<span class=\"line4\" >";
    echo ($rannum * $rannum2 . "<br>");
    echo "</span> ";
    ?>

</body>

</html>