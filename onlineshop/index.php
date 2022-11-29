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
    <title>Mellow Shoppe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>

    <?php
    include "session.php";
    include "nav.php";
    ?>

    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/home1.jpg" class="d-block w-100" alt="banner1">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Mellow Shoppe</h5>
                    <p>If you can't stop thinking about it, BUY IT!</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/home2.jpg" class="d-block w-100" alt="banner2">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Welcome to Mellow Shoppe.</h5>
                    <p>There's nothing better than online shopping in your PJ's with a glass of wine with the kids
                        asleep!.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/home3.jpg" class="d-block w-100" alt="banner3">
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