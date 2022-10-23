<!doctype html>
<html lang="en">

<head>
    <title>About Me</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <style>

    </style>
</head>

<body>

    <!-- Example single danger button -->
    <div class="btn-group">
        <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            Action
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="#">Separated link</a></li>
        </ul>
    </div>

    <?php
    function get_date()
    {
        $var = "";
        for ($i = 1; $i < 31; $i++) {
            $num_padded = sprintf("%02d", $i);
            $var .= '<option value="' . $i . '">  ' . $num_padded . ' </option>';
        }
        return $var;
    }
    ?>
    <select>
        <?php echo get_date(); ?>
    </select>

    <?php
    function get_month()
    {
        $var = "";
        for ($m = 1; $m <= 12; $m++) {
            $var .= '<option value="' . $m . '">' . date('F', mktime(0, 0, 0, $m, 1,      date('Y'))) . ' </option>';
        }
        return $var;
    }
    ?>
    <select>
        <?php echo get_month(); ?>
    </select>

    <?php
    function get_year($start, $end)
    {
        $var = "";
        while ($start <= $end) {
            $var .= "<option value=" . $start . ">" . $start . "</option>";
            $start++;
        }
        return $var;
    }
    ?>
    <select>
        <?php echo get_year(1900, 2022); ?>
    </select>



</body>

</html>