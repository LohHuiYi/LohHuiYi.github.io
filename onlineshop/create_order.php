<?php
include 'session.php';
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

    .error {
        color: red;
    }
</style>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Order</title>
    <!-- Latest compiled and minified Bootstrap CSS (Apply your Bootstrap here -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <!-- container -->


    <div class="container mt-5 pt-5 mb-5">
        <div class="page-header">
            <h1>Create Order</h1>
        </div>

        <!-- html form to create product will be here -->
        <!-- PHP insert code will be here -->

        <!-- PHP read one record will be here -->
        <?php

        include 'nav.php';
        include 'config/database.php';

        $useErr = $proErr = "";
        $flag = false;

        if ($_POST) {

            if (empty($_POST["customer_id"])) {
                $useErr = "Username is required *";
                $flag = true;
            } else {
                $customer_id = htmlspecialchars(strip_tags($_POST["customer_id"]));
            }

            $product_id = $_POST['product_id'];
            //count value, if dup add value 
            //count which product and how many product bought
            //count product_id, how many time it got choose
            $value = array_count_values($product_id);
            $quantity = $_POST['quantity'];

            // must choose one product

            // echo array details

            // var_dump($product_id);
            // echo "<br>";
            // var_dump($quantity);
            // echo "<br>";
            // echo print_r($value);

            //if  three product column is empty
            if ($product_id[0] == "" && $product_id[1] == "" && $product_id[2] == "") {
                $proErr = "Please at least choose a product *";
                echo "<div class='alert alert-danger'>Unable to create order.</div>";
            } else {
                // if product chosen but didnt insert quantity
                if ((!empty($product_id[0]) && empty($quantity[0])) or (!empty($product_id[1]) && empty($quantity[1])) or (!empty($product_id[2]) && empty($quantity[2]))) {
                    $proErr = "Please type the quantity of your product *";
                    echo "<div class='alert alert-danger'>Unable to create order.</div>";
                } else {

                    //record the counts when submit to table
                    // record products, got 3 products and will run 3 times
                    // count (product_id), no matter how much new product you add it will auto count for you
                    // product id got how many then it will loop how many times
                    for ($x = 0; $x < count($product_id); $x++) {

                        //if product empty and quantity empty wont proceed next step
                        if (!empty($product_id[$x]) && !empty($quantity[$x])) {

                            //only proceed record when theres non dup product
                            if ($value[$product_id[$x]] == 1) {

                                if ($flag == false) {
                                    //send data to order_summary
                                    $query = "INSERT INTO order_summary SET customer_id=:customer_id, order_date=:order_date ";
                                    $stmt = $con->prepare($query);
                                    $stmt->bindParam(':customer_id', $customer_id);
                                    $order_date = date('Y-m-d');
                                    $stmt->bindParam(':order_date', $order_date);

                                    if ($stmt->execute()) {

                                        echo "<div class='alert alert-success'>Able to create order.</div>";
                                        // put order id that created to order_detail table
                                        $order_id = $con->lastInsertId();

                                        //send data to order_detail
                                        $query = "INSERT INTO order_details SET product_id=:product_id, quantity=:quantity, order_id=:order_id ";
                                        $stmt = $con->prepare($query);
                                        $stmt->bindParam(':product_id', $product_id[$x]);
                                        $stmt->bindParam(':quantity', $quantity[$x]);
                                        $stmt->bindParam(':order_id', $order_id);

                                        $stmt->execute();
                                    } else {
                                        echo "<div class='alert alert-danger'>Unable to create order.</div>";
                                    }
                                } else {
                                    echo "<div class='alert alert-danger'>Failed to create order.</div>";
                                }
                            } else {
                                $proErr = "Please do not choose the same product *";
                            }
                        }
                    }
                }
            }
        }
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
            <?php
            // select customer
            $query = "SELECT customer_id, username FROM customers ORDER BY customer_id DESC";
            $stmt = $con->prepare($query);
            $stmt->execute();
            // this is how to get number of rows returned
            $num = $stmt->rowCount();
            ?>


            <table class='table table-hover table-responsive table-bordered mb-5'>
                <div class="row">
                    <label class="order-form-label">Username</label>
                </div>

                <div class="col-6 mb-3 mt-2">
                    <span class="error"><?php echo $useErr; ?></span>
                    <select class="form-select bg-warning" name="customer_id" aria-label="form-select-lg example">
                        <option value="" selected>Choose Username</option>
                        <?php
                        //if more then 0, value="01">"username"</option>
                        if ($num > 0) {
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                extract($row); ?>
                                <option value="<?php echo $customer_id; ?>"><?php echo htmlspecialchars($username, ENT_QUOTES); ?></option>
                        <?php }
                        }
                        ?>

                    </select>

                </div>
                <span class="error"><?php echo $proErr; ?></span>
                <?php
                //forloop, for 3 product
                //no need repeat to paste 3 things
                for ($x = 0; $x < 3; $x++) {
                    // select product
                    $query = "SELECT id, name, price, promotion_price FROM products ORDER BY id DESC";
                    $stmt = $con->prepare($query);
                    $stmt->execute();
                    // this is how to get number of rows returned
                    $num = $stmt->rowCount();
                ?>

                    <div class="row">

                        <div class="col-12">
                            <label class="order-form-label col-3">Product</label>
                            <label class="order-form-label">Quantity</label>

                        </div>
                        <div class="col-3 mb-2 mt-2">
                            <select class="form-select bg-warning" name="product_id[]" aria-label="form-select-lg example">
                                <option value="" selected>Choose Product</option>
                                <?php
                                if ($num > 0) {
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        extract($row); ?>
                                        <option value="<?php echo $id; ?>"><?php echo htmlspecialchars($name, ENT_QUOTES); ?><?php if ($promotion_price == 0) {
                                                                                                                                    echo " (RM$price)";
                                                                                                                                } else {
                                                                                                                                    echo " (RM$promotion_price)";
                                                                                                                                } ?></option>
                                <?php }
                                }
                                ?>

                            </select>
                        </div>

                        <input class="col-1 mb-2 mt-2" type="number" id="quantity[]" name="quantity[]" min=1>
                    </div>
                <?php } ?>


            </table>
            <input type="submit" class="btn btn-warning" />
        </form>


        <!-- end .container -->


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
        </script>
</body>

</html>