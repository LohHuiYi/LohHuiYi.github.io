<?php
include "session.php";
?>

<!DOCTYPE HTML>
<html>

<style>
    * {
        font-family: montserrat;
    }

    .bg-darkblue {
        background-color: #0c151b;
    }
</style>


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Customer</title>
    <!-- Latest compiled and minified Bootstrap CSS (Apply your Bootstrap here -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <!-- container -->

    <?php
    include "nav.php";
    ?>

    <div class="container">
        <div class="page-header mt-5 pt-5">
            <h1>Create Customer</h1>
        </div>
        <!-- html form to create product will be here -->
        <!-- PHP insert code will be here -->

        <?php
        $flag = false;

        if ($_POST) {
            // include database connection
            include 'config/database.php';
            try {
                // posted values
                $username = ($_POST['username']);
                $password = ($_POST['password']);
                $first_name = ($_POST['first_name']);
                $last_name = ($_POST['last_name']);
                $gender = ($_POST['gender']);
                $date_of_birth = ($_POST['date_of_birth']);
                $confirm_password = ($_POST['confirm_password']);

                // checking query
                if (empty($username)) {
                    $usernameErr = "<div class='alert alert-danger'>Please enter the Username.</div>";
                    echo $usernameErr;
                    $flag = true;
                } else {
                    $username = $_POST["username"];
                }

                if (strlen($username) < 6) {
                    $usernameErr = "<div class='alert alert-danger'>Username must be at least 6 characters.</div>";
                    echo $usernameErr;
                    $flag = true;
                } else {
                    $username = $_POST["username"];
                }

                if (empty($password)) {
                    $passErr = "<div class='alert alert-danger'>Please enter the Password</div>";
                    echo $passErr;
                    $flag = true;
                } else {
                    $password = md5($_POST["password"]);
                }

                if ($_POST["confirm_password"] != $_POST["password"]) {
                    $expErr = "<div class='alert alert-danger'>Please make sure your password is correct</div>";
                    echo $expErr;
                    $flag = true;
                }

                if (empty($first_name)) {
                    $fnErr = "<div class='alert alert-danger'>Please enter the First Name</div>";
                    echo $fnErr;
                    $flag = true;
                } else {
                    $first_name = $_POST["first_name"];
                }

                if (empty($last_name)) {
                    $lnErr = "<div class='alert alert-danger'>Please enter the Last Name</div>";
                    echo $lnErr;
                    $flag = true;
                } else {
                    $last_name = $_POST["last_name"];
                }

                if (empty($gender)) {
                    $genErr = "<div class='alert alert-danger'>Please select the Gender</div>";
                    echo $genErr;
                    $flag = true;
                } else {
                    $gender = $_POST["gender"];
                }

                if (empty($date_of_birth)) {
                    $dobErr = "<div class='alert alert-danger'>Please select the Date of Birth</div>";
                    echo $dobErr;
                    $flag = true;
                } else {
                    $date_of_birth = $_POST["date_of_birth"];

                    //current date
                    $date2 = date("Y-m-d");

                    //find difference between two dates
                    //strtotime = change ur string into date format
                    //abs = doesnt matter positive or negative, turn num into zheng shu
                    //$diff = the seconds between two dates
                    $diff = (strtotime($date2) - strtotime($date_of_birth));

                    //floor = round fraction down, change any num form into zheng shu
                    //year, day, min, hour
                    // from seconds change into year format
                    $years = floor($diff / (365 * 60 * 60 * 24));

                    //use echo to check whether the info format is right or not

                    if ($years < 18) {
                        $dobErr = "<div class='alert alert-danger'>Underage. Must be 18 year old to create.</div>";
                        echo $dobErr;
                        $flag = true;
                    }
                }



                //insert query 
                //need to find the username that user type have the same username in database
                $query = "SELECT username FROM customers WHERE username=:username";
                //prepare query for execution
                $stmt = $con->prepare($query);
                //bind the parameters
                $stmt->bindParam(':username', $username);
                //execute the query
                $stmt->execute();
                $num = $stmt->rowCount();

                //if num > 0 means it found related info in database
                if ($num > 0) {
                    $dobErr = "<div class='alert alert-danger'>Username taken</div>";
                    echo $dobErr;
                    $flag = true;
                }

                //if flag = true wont be able to process through here
                if ($flag == false) {

                    // insert query
                    $query = "INSERT INTO customers SET username=:username, password=:password, first_name=:first_name, last_name=:last_name, gender=:gender, date_of_birth=:date_of_birth, registration=:registration";
                    // prepare query for execution
                    $stmt = $con->prepare($query);
                    // bind the parameters
                    $stmt->bindParam(':username', $username);
                    $stmt->bindParam(':password', $password);
                    $stmt->bindParam(':first_name', $first_name);
                    $stmt->bindParam(':last_name', $last_name);
                    $stmt->bindParam(':gender', $gender);
                    $stmt->bindParam(':date_of_birth', $date_of_birth);
                    // specify when this record was inserted to the database
                    $created = date('Y-m-d H:i:s');
                    $stmt->bindParam(':registration', $registration);
                    // Execute the query
                    if ($stmt->execute()) {
                        header("Location: http://localhost/webdev/onlineshop/customers_read.php?action=successful");
                    } else {
                        echo "<div class='alert alert-danger'>Unable to save record.</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'>Unable to save record.</div>";
                }
            }


            // show error
            catch (PDOException $exception) {
                die('ERROR: ' . $exception->getMessage());
            }
        }
        ?>


        <!-- html form here where the product information will be entered -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <table class='table table-hover table-responsive table-bordered'>
                <tr>
                    <td>Username</td>
                    <td>
                        <input type='text' name='username' class='form-control' value='<?php if (isset($_POST['username'])) {
                                                                                            echo $_POST['username'];
                                                                                        } ?>' />
                    </td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type='password' name='password' class='form-control'></textarea></td>
                </tr>
                <tr>
                    <td>Confirm Password</td>
                    <td><input type='password' name='confirm_password' class='form-control'></textarea></td>
                </tr>
                <tr>
                    <td>First Name</td>
                    <td><input type='text' name='first_name' class='form-control' value='<?php if (isset($_POST['first_name'])) {
                                                                                                echo $_POST['first_name'];
                                                                                            } ?>' /></td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td><input type='text' name='last_name' class='form-control' value='<?php if (isset($_POST['last_name'])) {
                                                                                            echo $_POST['last_name'];
                                                                                        } ?>' /></td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td>
                        <input type='radio' name='gender' value='Female' class='form-check-label' <?php if (isset($_POST["gender"])) {
                                                                                                        if ($_POST['gender'] == "Female") {
                                                                                                            echo "checked";
                                                                                                        }
                                                                                                    } ?> />
                        <label>
                            Female
                        </label>
                        <input type='radio' name='gender' value='Male' class='form-check-label' <?php if (isset($_POST["gender"])) {
                                                                                                    if ($_POST['gender'] == "Male") {
                                                                                                        echo "checked";
                                                                                                    }
                                                                                                } ?> />
                        <label>
                            Male
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>Date of Birth</td>
                    <td><input type='date' name='date_of_birth' class='form-date' value='<?php if (isset($_POST['date_of_birth'])) {
                                                                                                echo $_POST['date_of_birth'];
                                                                                            } ?>' /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Save' class='btn btn-primary' />
                        <a href='index.php' class='btn btn-danger'>Back to read products</a>
                    </td>
                </tr>
            </table>
        </form>

    </div>

    <div class=" p-4 bg-dark text-white text-center">
        <div class="container">
            <div class="copyright">
                © Copyright <strong><span class="text-warning">Mellow Shoppe</span></strong>. All Rights Reserved
            </div>
        </div>
    </div>

    <!-- end .container -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
</body>

</html>