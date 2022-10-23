<!DOCTYPE html>

<html>

<head>
    <title>Random Num Color</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .randColor {
            color: yellow;
            font-weight: bold;
            font-size: 100px;
        }
    </style>
</head>

<body>

    <?php
    $rand1 = rand(100, 200);
    $rand2 = rand(100, 200);
    ?>

    <div class="container justify-content-center">
        <div class=" row justify-content-center text-center p-5 fs-3">
            <div class="col-6 bg-dark text-light ">
                <?php
                if ($rand1 > $rand2) {
                    echo "<span class=\"randColor\">";
                    echo $rand1;
                    echo "</span> ";
                } else {
                    echo $rand1;
                }
                ?>
            </div>

            <div class="col-6 bg-primary text-light">
                <?php
                if ($rand2 > $rand1) {
                    echo "<span class=\"randColor\">";
                    echo $rand2;
                    echo "</span> ";
                } else {
                    echo $rand2;
                }
                ?>
            </div>
        </div>
    </div>

</body>

</html>