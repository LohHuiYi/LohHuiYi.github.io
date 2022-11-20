<?php 

session_start(); 

include "db_conn.php";

if (isset($_POST['username']) && isset($_POST['password'])) {

    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);

       return $data;

    }

    $uname = validate($_POST['uname']);

    $pass = validate($_POST['password']);

    if (empty($uname)) {

        header("Location: index.php?error=User Name is required");

        exit();

    }else if(empty($pass)){

        header("Location: index.php?error=Password is required");

        exit();

    }else{

        $sql = "SELECT * FROM users WHERE user_name='$uname' AND password='$pass'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);

            if ($row['user_name'] === $uname && $row['password'] === $pass) {

                echo "Logged in!";

                $_SESSION['user_name'] = $row['user_name'];

                $_SESSION['name'] = $row['name'];

                $_SESSION['id'] = $row['id'];

                header("Location: home.php");

                exit();

            }else{

                header("Location: index.php?error=Incorect User name or password");

                exit();

            }

        }else{

            header("Location: index.php?error=Incorect User name or password");

            exit();

        }

    }

}else{

    header("Location: index.php");

    exit();

}


<?php

    $flag = false;

    if ($_POST) {

        session_start();
        // include database connection
        include 'config/database.php';

        // select all data
        $query = "SELECT * FROM customers WHERE username=:username, password=:password";
        $stmt = $con->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        // this is how to get number of rows returned
        $num = $stmt->rowCount();

        //check if more than 0 record found
        if ($num != 0) {
            while ($row=$stmt($query)) {
                $dbusername = $row['username'];
                $dbpassword = $row['password'];
            }

            if ($username == $dbusername && $password == $dbpassword) {
                session_start();
                $_SESSION['sess_user'] = $username;

                /* Redirect browser */
                header("Location: index.html");
            }
        } else {
            echo "Invalid username or password!";
        }
    }
    ?>

    <body>

    <?php
    $useErr =  $pasErr = "";

    if ($_POST) {

        include 'config/database.php';

        $username = htmlspecialchars(strip_tags($_POST['username']));

        $query = "SELECT * FROM customers WHERE username=:username";
        $stmt = $con->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $num = $stmt->rowCount();

        if ($num > 0) {

            $password = htmlspecialchars(strip_tags($_POST['password']));

            $query = "SELECT * FROM customers WHERE password=:password";
            $stmt = $con->prepare($query);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            $num = $stmt->rowCount();

            if ($num > 0) {
                header("Location: http://localhost/webdev/onlineshop/home.php");
            } else {
                $pasErr = "Incorrect Password*";
            }
        } else {
            $useErr = "User not found *";
        }
    }
    ?>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="row justify-content-center mt-5">
        <main class="form-signin col-4 mt-4">

            <h1 class="h3 mb-3 fw-normal text-center">SIGN IN</h1>
            <span class="error"><?php echo $useErr; ?></span>
            <span class="error"><?php echo $pasErr; ?></span>

            <div class="form-floating ">
                <input type="text" class="form-control" name="username" value='<?php if (isset($_POST['username'])) {
                                                                                    echo $_POST['username'];
                                                                                } ?>'>
                <label for="username">
                    Username
                    </span>
                </label>
            </div>


            <div class="form-floating">
                <input type="password" class="form-control" name="password" value='<?php if (isset($_POST['password'])) {
                                                                                        echo $_POST['password'];
                                                                                    } ?>'>
                <label for="password ">
                    Password
                </label>
            </div>

            <button class="w-100 btn btn-lg btn-success mt-5 mb-5" type="sign in">Sign in</button>
        </main>
    </div>
</form>

</body>

//
if ($_POST) {

    include 'config/database.php';

    $username = htmlspecialchars(strip_tags($_POST['username']));

    $query = "SELECT * FROM customers WHERE username=:username";
    $stmt = $con->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $num = $stmt->rowCount();

    if ($num > 0) {

        $password = htmlspecialchars(strip_tags($_POST['password']));

        $query = "SELECT * FROM customers WHERE password=:password";
        $stmt = $con->prepare($query);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $num = $stmt->rowCount();

        if ($num > 0) {
            header("Location: http://localhost/webdev/onlineshop/home.php");
        } else {
            $passErr = "Incorrect Password*";
        }
    } else {
        $userErr = "User not found *";
    }

    $account_status = htmlspecialchars(strip_tags($_POST['account_status']));

    $query = "SELECT * FROM customers WHERE account_status=:account_status";
    $stmt = $con->prepare($query);
    $stmt->bindParam(':account_status', $account_status);
    $stmt->execute();
    $num = $stmt->rowCount();

    if ($account_status = "Inactive") {
        $staErr = "Account Suspended*";
    }
}


<?php
$useErr =  $pasErr = $accErr = "";

if ($_POST) {

    include 'config/database.php';

    $username = htmlspecialchars(strip_tags($_POST['username']));

    $query = "SELECT * FROM customers WHERE username=:username";
    $stmt = $con->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $num = $stmt->rowCount();

    if ($num > 0) {

        $password = md5($_POST['password']);

        $query = "SELECT * FROM customers WHERE password=:password";
        $stmt = $con->prepare($query);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $num = $stmt->rowCount();

        if ($num > 0) {

            $query = "SELECT * FROM customers WHERE account_status=:account_status";
            if ($data = $query){ 
                if ($data['account_status'] == 'Inactive') {
                    $accErr = "Incorrect Password*";
                } else {
                    header("Location: http://localhost/webdev/onlineshop/index.html");
                }
            } 
        } else {
            $pasErr = "Incorrect Password*";
        }
    } else {
        $useErr = "User not found *";
    }
}
?>

if ($_POST) {

    include 'config/database.php';

    $username = htmlspecialchars(strip_tags($_POST['username']));
    $password = md5($_POST['password']);

    $query = "SELECT * FROM customers WHERE username=:username and password=:password";
    $stmt = $con->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    $num = $stmt->rowCount();

    if ($num > 0) {

        if ($_POST["username"] != $query["username"]){
            $useErr = "User not found*";
        } else if ($_POST["password"] != $query["password"]){
            $pasErr = "Incorrect Password*";
        }else {
            header("Location: http://localhost/webdev/onlineshop/index.html");
        }
    }
}