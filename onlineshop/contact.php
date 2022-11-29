<?php
include "session.php";
?>

<!doctype html>
<html lang="en">

<head>
    <title>Contact</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        * {
            font-family: montserrat;
        }

        body {
            padding-top: 55px;
        }

        .bg-darkblue {
            background-color: #0c151b;
        }
    </style>
</head>

<body>

    <?php
    include "nav.php";
    ?>

    <div class="p-5 bg-warning text-dark text-center">
        <h1><strong>Contact Us</strong></h1>
        <h6>Can't find what you're looking for? Let us help you!</h6>
    </div>

    <div class="p-5 bg-dark">
        <div class="container text-white">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Message</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Default file input example</label>
                <input class="form-control" type="file" id="formFile">
            </div>
            <p><a href="#" class="btn btn-warning mt3 justify-content-center">Submit</a></p>
        </div>
    </div>


    <div class=" p-4 bg-dark text-white text-center">
        <div class="container">
            <div class="copyright">
                © Copyright <strong><span class="text-warning">Mellow Shoppe</span></strong>. All Rights Reserved
            </div>
        </div>
    </div>



</body>

</html>