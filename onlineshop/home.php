<?php
include "session.php";
?>

<!doctype html>
<html lang="en">

<style>
    * {
        font-family: montserrat;
    }

    .carousel-caption {
        z-index: 2;
    }

    .carousel-caption h5 {
        font-size: 45px;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-top: 25px;
    }

    .carousel-caption p {
        width: 70%;
        margin: auto;
        font-size: 18px;
        line-height: 1.9;
    }

    .carousel-inner::before {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: 1;
    }
</style>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Metaverse System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>

    <?php
    include "nav.php";
    include 'config/database.php';

    $query = "SELECT * FROM customers";
    $stmt = $con->prepare($query);
    $stmt->execute();
    // this is how to get number of rows returned
    $total_customer = $stmt->rowCount();

    $query = "SELECT * FROM products";
    $stmt = $con->prepare($query);
    $stmt->execute();
    // this is how to get number of rows returned
    $total_products = $stmt->rowCount();

    $query = "SELECT * FROM order_summary";
    $stmt = $con->prepare($query);
    $stmt->execute();
    // this is how to get number of rows returned
    $total_orders = $stmt->rowCount();

    //Latest
    $query = "SELECT c.first_name, c.last_name, c.username, o.order_date, o.total_amount 
    FROM order_summary o 
    INNER JOIN customers c 
    ON c.customer_id = o.customer_id 
    ORDER BY order_id DESC";
    $stmt = $con->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // values to fill up our form
    $username = $row['username'];
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $order_date = $row['order_date'];
    $total_amount = $row['total_amount'];


    if ($num > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            echo $productname . "<br>";
            echo $totalquantity . "<br>";
        }
    }
    ?>

    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/wallpaper4.jpg" class="d-block w-100" alt="banner1">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Welcome to Metaverse System</h5>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/wallpaper5.jpg" class="d-block w-100" alt="banner2">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Metaverse System.</h5>
                    <p>A system that able to create, edit and read the information of products, customers and orders.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/wallpaper6.jpg" class="d-block w-100" alt="banner3">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Can't find what you need?</h5>
                    <p>You can contact us through email or social media platform for more info.</p>
                    <p><a href="contact.html" class="btn btn-warning mt3">Contact Us!</a></p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container mb-5">

        <div class="card mt-5">
            <div class="card-header bg-danger text-light">
                Announcement
            </div>
            <div class="card-body">
                <h5 class="card-title text-danger">Service Status Update</h5>
                <p class="card-text">There will be service status update in 27th May 2023, 9am. We sincerely apologise for the inconvenience caused. Your patience and understanding is much appreciated.</p>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title text-center">
                    <h2 class="fw-bold mt-3 mb-3 py-4">DASHBOARD</h2>
                </div>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-sm-4">
                <div class="card">
                    <img src="images/1.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Customer</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Total number of Customer</h6>
                        <p class="card-text"><?php echo $total_customer ?> user has been resgister</p>
                        <a href="customers_read.php" class="btn btn-warning">Customer List</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <img src="images/4.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Products</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Total number of Products</h6>
                        <p class="card-text"><?php echo $total_products ?> products has added</p>
                        <a href="product_read.php" class="btn btn-warning">Products List</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <img src="images/3.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Order</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Total number of Order</h6>
                        <p class="card-text"><?php echo $total_orders ?> sales still going on</p>
                        <a href="order_read.php" class="btn btn-warning">Order List</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-2 g-4">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Latest Order</h5>
                        <p class="card-text">
                            <?php
                            $query = "SELECT c.first_name, c.last_name, c.username, o.order_date, o.total_amount, order_id 
                                FROM order_summary o 
                                INNER JOIN customers c 
                                ON c.customer_id = o.customer_id 
                                ORDER BY order_id DESC LIMIT 0,1";
                            $stmt = $con->prepare($query);
                            $stmt->execute();
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                            // values to fill up our form
                            $order_id = $row['order_id'];
                            $username = $row['username'];
                            $first_name = $row['first_name'];
                            $last_name = $row['last_name'];
                            $order_date = $row['order_date'];
                            $total_amount = $row['total_amount'];

                            echo "Order ID: " . "<b>" . $order_id . "</b>";
                            echo "</br>";
                            echo "</br>";
                            echo "Username: " . "<b>" . $username . "</b>";
                            echo "</br>";
                            echo "</br>";
                            echo "Customer Name: " . "<b>" . $first_name . ' ' . $last_name . "</b>";
                            echo "</br>";
                            echo "</br>";
                            echo "Total Amount: <b>RM </b>" .  "<b>" . number_format((float)htmlspecialchars($total_amount, ENT_QUOTES), 2, '.', '') . "</b>";
                            echo "</br>";
                            echo "</br>";
                            echo "Order Date: " . "<b>" . $order_date . "</b>";
                            ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Highest Purchased Amount</h5>
                        <p class="card-text">
                            <?php
                            $query = "SELECT username, first_name, last_name, total_amount, order_date, order_id
                            FROM order_summary o 
                            INNER JOIN customers c
                            ON c.customer_id = o.customer_id
                            ORDER BY total_amount DESC LIMIT 0,1";
                            $stmt = $con->prepare($query);
                            $stmt->execute();
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                            $order_id = $row['order_id'];
                            $username = $row['username'];
                            $first_name = $row['first_name'];
                            $last_name = $row['last_name'];
                            $total_amount = $row['total_amount'];
                            $order_date = $row['order_date'];

                            echo "Order ID: " . "<b>" . $order_id . "</b>";
                            echo "</br>";
                            echo "</br>";
                            echo "Username: " . "<b>" . $username . "</b>";
                            echo "</br>";
                            echo "</br>";
                            echo "Customer Name: " . "<b>" . $first_name . ' ' . $last_name . "</b>";
                            echo "</br>";
                            echo "</br>";
                            echo "Total Amount: <b>RM </b>" .  "<b>" . number_format((float)htmlspecialchars($total_amount, ENT_QUOTES), 2, '.', '') . "</b>";
                            echo "</br>";
                            echo "</br>";
                            echo "Order Date: " . "<b>" . $order_date . "</b>";

                            ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Top 5 Selling Products</h5>
                        <p class="card-text">
                            <?php
                            $query = "SELECT o.product_id, SUM(o.quantity) as totalquantity ,p.name as productname FROM order_details o
                            INNER JOIN products p ON o.product_id = p.id
                            GROUP BY o.product_id 
                            ORDER BY totalquantity DESC LIMIT 5";
                            $stmt = $con->prepare($query);
                            $stmt->execute();
                            // this is how to get number of rows returned
                            $num = $stmt->rowCount();


                            if ($num > 0) {
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    extract($row);

                                    echo "<b>" . $productname . ' ' . $totalquantity . "</b>";
                                    echo "</br>";
                                }
                            } ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Products that never purchased by any customer</h5>
                        <p class="card-text">
                            <?php
                            $query = "SELECT p.name as productname
                            FROM products p
                            LEFT JOIN order_details o
                            ON p.id = o.product_id 
                            WHERE o.product_id IS NULL
                            ORDER BY p.name DESC LIMIT 3";
                            $stmt = $con->prepare($query);
                            $stmt->execute();
                            // this is how to get number of rows returned
                            $num = $stmt->rowCount();


                            if ($num > 0) {
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    extract($row);

                                    echo "<b>" . $productname . "</b>";
                                    echo "</br>";
                                }
                            } ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>

    <div class=" p-4 bg-dark text-white text-center">
        <div class="container">
            <div class="copyright">
                © Copyright <strong><span class="text-warning">Mellow Shoppe</span></strong>. All Rights Reserved
            </div>
        </div>
    </div>

</body>

</html>