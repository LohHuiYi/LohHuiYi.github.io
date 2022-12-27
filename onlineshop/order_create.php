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
        date_default_timezone_set("Asia/Kuala_Lumpur");

        $useErr = $proErr = "";
        // $flag = false;

        if ($_POST) {

            $product_id = $_POST['product_id'];
            $quantity = $_POST['quantity'];
            //count product_id, how many time it got choose
            $value = array_count_values($product_id);

            //Check Username
            if (empty($_POST["customer_id"])) {
                $useErr = "Username is required *";
                // $flag = true;
            } else {
                $customer_id = htmlspecialchars(strip_tags($_POST["customer_id"]));
            }

            // Checking Process
            // record products, got 3 products and will run 3 times
            // count (product_id), no matter how much new product you add it will auto count for you
            // product id got how many then it will loop how many times
            for ($x = 0; $x < count($product_id); $x++) {

                if (empty($product_id[0])) {
                    $proErr = "Choose product with quantity *";
                }

                if ($product_id[$x] != "") {
                    if ($quantity[$x] == "") {
                        $proErr = "Choose product with quantity *";
                    }

                    //check if got any duplicate products
                    if ($value[$product_id[$x]] > 1) {
                        $proErr = "Same product detected *";
                    }
                }
            }

            if (empty($useErr) && empty($proErr)) {

                $total_amount = 0;

                //set rule/conditions
                //run loop 3 times
                for ($x = 0; $x < count($product_id); $x++) {

                    $query = "SELECT price, promotion_price FROM products WHERE id = :id";
                    $stmt = $con->prepare($query);
                    $stmt->bindParam(':id', $product_id[$x]);
                    $stmt->execute();
                    $num = $stmt->rowCount();
                    //if database pro price is 0/no promo, price = row price

                    //detect product_id have filled or not
                    if ($num > 0) {
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);

                        if ($row['promotion_price'] == 0) {
                            $price = $row['price'];
                        } else {
                            $price = $row['promotion_price'];
                        }
                    }

                    //combine prvious total_amount with new ones, loop (3 times)
                    $total_amount = $total_amount + ((float)$price * (int)$quantity[$x]);
                }
                // echo $total_amount;

                //send data to order_summary
                $order_date = date('Y-m-d H:i:s');
                $query = "INSERT INTO order_summary SET customer_id=:customer_id, order_date=:order_date, total_amount=:total_amount";
                $stmt = $con->prepare($query);
                $stmt->bindParam(':customer_id', $customer_id);
                $stmt->bindParam(':order_date', $order_date);
                $stmt->bindParam(':total_amount', $total_amount);

                if ($stmt->execute()) {

                    $order_id = $con->lastInsertId();
                    for ($x = 0; $x < count($product_id); $x++) {

                        if ($product_id[$x] !== "") {

                            $query = "SELECT price, promotion_price FROM products WHERE id = :id";
                            $stmt = $con->prepare($query);
                            //bind user choose product(id) with order details product id
                            $stmt->bindParam(':id', $product_id[$x]);
                            $stmt->execute();
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                            $num = $stmt->rowCount();

                            if ($num > 0) {
                                if ($row['promotion_price'] == 0) {
                                    $price = $row['price'];
                                } else {
                                    $price = $row['promotion_price'];
                                }
                            }

                            $price_each = ((float)$price * (int)$quantity[$x]);

                            //send data to order_detail
                            $query = "INSERT INTO order_details SET product_id=:product_id, quantity=:quantity, order_id=:order_id, price_each=:price_each ";
                            $stmt = $con->prepare($query);
                            $stmt->bindParam(':product_id', $product_id[$x]);
                            $stmt->bindParam(':quantity', $quantity[$x]);
                            $stmt->bindParam(':order_id', $order_id);
                            $stmt->bindParam(':price_each', $price_each);
                            $stmt->execute();
                        }
                    }
                    header("Location: http://localhost/webdev/onlineshop/order_read.php?action=successful");
                } else {
                    echo "<div class='alert alert-danger'>Unable to create order.</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Failed to create order.</div>";
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
            // select product
            $query = "SELECT id, name, price, promotion_price FROM products ORDER BY id DESC";
            $stmt = $con->prepare($query);
            $stmt->execute();
            // this is how to get number of rows returned
            $num = $stmt->rowCount();
            ?>

            <div class="pRow">
                <div class="row">
                    <div class="col-8 mb-2 ">
                        <label class="order-form-label">Product</label>
                    </div>

                    <div class="col-4 mb-2"><label class="order-form-label">Quantity</label>
                    </div>
                    <div class="col-8 mb-2">
                        <select class="form-select  mb-3" id="" name="product_id[]" aria-label="form-select-lg example">
                            <option value='' selected>Choose your product </option>

                            <?php if ($num > 0) {
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    extract($row); ?>
                                    <option value="<?php echo $id; ?>">
                                        <?php echo htmlspecialchars($name, ENT_QUOTES);
                                        if ($promotion_price == 0) {
                                            echo " (RM$price)";
                                        } else {
                                            echo " (RM$promotion_price)";
                                        } ?>

                                    </option>
                            <?php }
                            }
                            ?>

                        </select>

                    </div>

                    <div class="col-4 mb-3">
                        <input type='number' id='quantity[]' name='quantity[]' class='form-control' min=1 />
                    </div>
                </div>
            </div>
            <div class="col-12 mb-2">
                <input type="button" value="Add More" class="add_one btn btn-primary" />
                <input type="button" value="Delete" class="delete_one btn btn-danger" />
                <input type='submit' value='Order' class='btn btn-warning' />
            </div>


        </form>


        <!-- end .container -->


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
        </script>
        <script>
            document.addEventListener('click', function(event) {
                if (event.target.matches('.add_one')) {
                    var element = document.querySelector('.pRow');
                    var clone = element.cloneNode(true);
                    element.after(clone);
                }
                if (event.target.matches('.delete_one')) {
                    var total = document.querySelectorAll('.pRow').length;
                    if (total > 1) {
                        var element = document.querySelector('.pRow');
                        element.remove(element);
                    }
                }
            }, false);
        </script>
</body>

</html>