<?php
include 'session.php';
?>

<!DOCTYPE HTML>
<html>

<head>
    <title>PDO - Create a Record - PHP CRUD Tutorial</title>
    <!-- Latest compiled and minified Bootstrap CSS (Apply your Bootstrap here -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <?php
    include 'menu.php';
    include 'config/database.php';

    $query = "SELECT * FROM customer";
    $stmt = $con->prepare($query);
    $stmt->execute();
    // this is how to get number of rows returned
    $total_customer = $stmt->rowCount();


    //Latest order
    $query = "SELECT * c.firstname, c.lastname FROM order_summary s
    INNER JOIN customer c ON s.customer_id = c.id
    GROUP BY c.customer
    ORDER BY order_id DESC LIMIT 5";
    $stmt = $con->prepare($query);
    $stmt->execute();
    // this is how to get number of rows returned
    $num = $stmt->rowCount();


    if ($num > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            echo $productname . "<br>";
            echo $totalquantity . "<br>";
        }
    }








    ?>

    <!-- container -->
    <div class="container">
        <div class="page-header">
            <!-- <h1>Home</h1> -->
        </div>

        <div class="card mt-5">
            <div class="card-header bg-danger text-light">
                Announcement
            </div>
            <div class="card-body">
                <h5 class="card-title text-danger">Chinese New Year Offer</h5>
                <p class="card-text">Thank you for customer supporting, we have 3 days promotion! Keep system work smooth</p>
                <a href="order_read.php" class="btn btn-warning">Go Order List</a>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title text-center">
                    <h2 class="fw-bold mb-5 py-4">LITTLAZY CAMERA</h2>
                </div>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Customer</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Total number of Customer</h6>
                        <p class="card-text"><?php echo $total_customer ?> user has been resgister</p>
                        <a href="customer_read.php" class="btn btn-primary">Customer List</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Products</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Total number of Products</h6>
                        <p class="card-text">11 camera has added</p>
                        <a href="product_read.php" class="btn btn-primary">Products List</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Order</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Total number of Order</h6>
                        <p class="card-text">Sales still going on</p>
                        <a href="order_read.php" class="btn btn-primary">Order List</a>
                    </div>
                </div>
            </div>
        </div>


        <div class="row row-cols-1 row-cols-md-2 g-4">
            <div class="col">
                <div class="card">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text"><?php
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

                                                        echo $productname . "<br>";
                                                        echo $totalquantity . "<br>";
                                                    }
                                                } ?></p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                </div>
            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>