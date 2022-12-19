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
    <title>Order Details</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>

    <!-- container -->

    <?php
    include "nav.php";
    ?>

    <div class="container mt-5 pt-5">
        <div class="page-header">
            <h1>Read Order Details</h1>
        </div>

        <!-- PHP read one record will be here -->
        <?php
        // get passed parameter value, in this case, the record ID
        // isset() is a PHP function used to verify if a value is there or not
        $order_id = isset($_GET['order_id']) ? $_GET['order_id'] : die('ERROR: Order ID not found.');

        //include database connection
        include 'config/database.php';

        // read current record's data
        try {
            // prepare select query

            //select from order summary
            $query = "SELECT order_id, total_amount FROM order_summary WHERE order_id = ? LIMIT 0,1";
            $stmt = $con->prepare($query);
            $stmt->bindParam(1, $order_id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $order_id = $row['order_id'];
            $total_amount = $row['total_amount'];

            //select from order details
            $query = "SELECT order_details_id, order_id, product_id, quantity, price_each FROM order_details WHERE order_id = ? LIMIT 0,1";
            $stmt = $con->prepare($query);
            $stmt->bindParam(1, $order_id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $order_details_id = $row['order_details_id'];
            $product_id = $row['product_id'];
            $quantity = $row['quantity'];
            $price_each = $row['price_each'];

            //select from products
            $query = "SELECT name, price, promotion_price FROM products WHERE id=:id";
            $stmt = $con->prepare($query);
            $stmt->bindParam(':id', $product_id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $name = $row['name'];
            if ($row['promotion_price'] == 0) {
                $price = $row['price'];
            } else {
                $price = $row['promotion_price'];
            }
        }

        // show error
        catch (PDOException $exception) {
            die('ERROR: ' . $exception->getMessage());
        }
        ?>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Product</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total Price</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($x = 0; $x < 3; $x++) { ?>
                    <tr>
                        <th scope="row"><?php echo htmlspecialchars($name, ENT_QUOTES);  ?></th>
                        <td><?php echo htmlspecialchars($price, ENT_QUOTES);  ?></td>
                        <td><?php echo htmlspecialchars($quantity, ENT_QUOTES);  ?></td>
                        <td><?php echo htmlspecialchars($price_each, ENT_QUOTES);  ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="3"></td>
                    <td><?php echo htmlspecialchars($total_amount, ENT_QUOTES);  ?></td>
                </tr>
            </tbody>
        </table>
        <tr>
            <td></td>
            <td>
                <a href='order_read.php' class='btn btn-danger mb-5'>Back to read orders</a>
            </td>
        </tr>




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