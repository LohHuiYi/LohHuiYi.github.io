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

        $query = "SELECT product_id, quantity, price_each, id, name, price, promotion_price, total_amount
        FROM order_details o
        INNER JOIN products p
        ON o.product_id = p.id
        INNER JOIN order_summary s
        ON o.order_id = s.order_id
        WHERE o.order_id = ?";

        $stmt = $con->prepare($query);
        $stmt->bindParam(1, $order_id);
        $stmt->execute();
        $num = $stmt->rowCount();
        ?>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Product</th>
                    <th scope="col">Product ID</th>
                    <th scope="col">Price (RM)</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total Price (RM)</th>
                </tr>
            </thead>
            <tbody>

                <?php
                if ($num > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        extract($row); ?>
                        <tr>
                            <th scope="row"><?php echo htmlspecialchars($name, ENT_QUOTES);  ?></th>
                            <td><?php echo htmlspecialchars($id, ENT_QUOTES);  ?></td>
                            <td><?php if ($promotion_price == 0) {
                                    echo number_format((float)htmlspecialchars($price, ENT_QUOTES), 2, '.', '');
                                } else {
                                    echo number_format((float)htmlspecialchars($promotion_price, ENT_QUOTES), 2, '.', '');
                                }
                                ?></td>
                            <td><?php echo htmlspecialchars($quantity, ENT_QUOTES);  ?></td>
                            <td><?php echo number_format((float)htmlspecialchars($price_each, ENT_QUOTES), 2, '.', '');  ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <th colspan="4">Total Amount (RM)</th>
                        <td><?php echo "<b>" . number_format((float)htmlspecialchars($total_amount, ENT_QUOTES), 2, '.', '') . "</b>";  ?></td>
                    </tr>
                <?php } ?>

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