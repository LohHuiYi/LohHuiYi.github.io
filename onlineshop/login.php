<?php
session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Signin</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">



    <!-- Bootstrap core CSS -->
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: auto;
        }

        .form-signin .checkbox {
            font-weight: 400;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        .error {
            color: red;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>

</head>

<body>

    <!-- PHP code to read records will be here -->
    <?php
    $useErr =  $pasErr = $staErr = "";

    if ($_POST) {

        include 'config/database.php';

        //find username
        $username = htmlspecialchars(strip_tags($_POST['username']));
        //insert query 
        $query = "SELECT password, account_status FROM customers WHERE username=:username";
        //prepare query for execution
        $stmt = $con->prepare($query);
        //bind the parameters
        $stmt->bindParam(':username', $username);
        //execute the query
        $stmt->execute();
        $num = $stmt->rowCount();

        //if num > 0 means it found related info in database
        if ($num > 0) {

            // store retrieved row to a variable
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // values to fill up our form
            //username and password from database
            $password = $row['password'];
            $account_status = $row['account_status'];

            if ($password == md5($_POST['password'])) {
                if ($account_status == 'Active') {
                    //set session variable
                    //Open a box(session) to store username that user submit/fill in
                    $_SESSION['user'] = $_POST['username'];
                    header("Location: http://localhost/webdev/onlineshop/index.php");
                } else {
                    $staErr = "Your Account is suspended *";
                }
            } else {
                $pasErr = "Incorrect Password*";
            }
        } else {
            $useErr = "User not found *";
        }
        if (empty($_POST['username'])) {
            $useErr = "Username & password is required* ";
        }
    }
    ?>


    <main class="form-signin text-center">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <?php
            if (isset($_GET["action"])) {
                if ($_GET["action"] == "denied") {
                    echo "<div class='alert alert-danger'>Please login before access the page.</div>";
                }
            }
            ?>
            <img class="" src="images/mslogo.png" alt="" width="150" height="150">
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

            <span class="error"><?php echo $useErr; ?></span>
            <span class="error"><?php echo $pasErr; ?></span>
            <span class="error"><?php echo $staErr; ?></span>

            <div class="form-floating">
                <input type="username" class="form-control" name="username" placeholder="Username">
                <label for="username">Username</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" name="password" placeholder="Password">
                <label for="password">Password</label>
            </div>

            <button class="w-100 btn btn-lg btn-warning text-dark" type="submit"><b>Sign in</b></button>
            <p class="mt-5 mb-3 text-muted">&copy; Copyright Metaverse System 2022</p>
        </form>
    </main>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>

</body>

</html>