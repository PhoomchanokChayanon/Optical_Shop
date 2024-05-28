<?php 

    session_start();
    $total_quantity = 0;
    include('./server/server.php');
    $bestseller = "SELECT * FROM `product` ORDER BY `product`.`PRODUCT_SELL` DESC LIMIT 3";
    $sql1  = mysqli_query($conn, $bestseller);


    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header("location:./index.php");
    }

    if (isset($_SESSION['cart_item'])) { 
        foreach ($_SESSION["cart_item"] as $item){
            $total_quantity += $item["quantity"];
        }
    }
    if (!isset($_SESSION['username'])){
        $username = "Guest";
    } 
    else{
        $username = $_SESSION['username'];
    }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="stylesheet/stylesheet.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gochi+Hand&family=Just+Another+Hand&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Gochi+Hand&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/particlesjs/2.2.3/particles.min.js" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <title>Home</title>
    <script>
    </script>
</head>

<body>
    <div style="height: 70px;"></div>
    <nav class="navbar navbar-expand-lg fixed-top navbar-light" style="background-color: white; ">
        <div class="container-fluid">
            <a class="navbar-brand" href="#" style="font-family: 'Just Another Hand', cursive; font-size: 35px;">NWTG
            </a>
            <button class="navbar-toggler " type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarTogglerDemo02">
                <ul class="navbar-nav me-auto mb-2 mb-lg-1">
                    <li class="nav-item ">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./product.php">items</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-1">
                    <li class="nav-item ">
                        <?php if (isset($_SESSION['username'])) : ?>
                    <li>
                        <a class="nav-link" onclick="user_pro()" style="margin-top:-6px"
                            id="pointer"><strong><?php echo $username; ?></strong></a>
                    </li>
                    <li>
                        <a class="nav-item"><a href="index.php?logout='1'" style="color: red;">Logout</a>
                    </li>
                    <?php endif ?>
                    <?php if (!isset($_SESSION['username'])) :?>
                    <a class="nav-link active " id="user" aria-current="page" href="./login/login.php"
                        style="margin-top: -7px;">Login</a>
                    </li>
                    <?php endif ?>
                </ul>

                <ul class="navbar-nav ms-7 mb-3 mb-lg-3">
                    <li class="nav-item">
                        <?php if($total_quantity > 0): ?>
                        <div id="total_quantity" class="total_quantity animate__heartBeat"
                            style="margin-top:28px; margin-left:30px; "></div>
                        <a class="nav-link" href="./cart.php" style="margin-top:-45px; "><img src="./image/cart.png"
                                style="width: 26px; height: 25px"></a>
                        <?php else: ?>
                        <a class="nav-link" href="./cart.php" style="margin-top:5px; "><img src="./image/cart.png"
                                style="width: 26px; height: 25px"></a>

                        <?php endif ?>

                    </li>
                </ul>
            </div>
        </div>
    </nav>
    </div>
    <div style="height: 750px;" class="container-fluid">
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner ">
                <div class="carousel-item active">

                    <img src="https://imageio.forbes.com/specials-images/imageserve/6241bb6221a92ba51b4650f5/0x0.jpg?format=jpg&width=1200"
                        class="d-block" style="width: 100%; max-height: 700px">
                </div>
                <div class="carousel-item">
                    <img src="https://media.cnn.com/api/v1/images/stellar/prod/glasses-group-2.jpg?q=h_900,w_1600,x_0,y_0"
                        class="d-block w-100" style="width: 100%; height: 700px">
                </div>
                <div class="carousel-item">
                    <img src="https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/woman-hand-holding-eyeglasses-optical-store-glasses-royalty-free-image-1634934203.jpg"
                        class="d-block w-100" style="width: 100%; height: 700px">
                </div>
            </div>
        </div>
    </div>
    <div style="height: 100px; display: flex;  justify-content: center; ">
        <div style="border-bottom: 1px solid; width: 400px; text-align: center; " class="Best-seller container-fluid">
            Best seller
        </div>
    </div>

    <!-- display product from query -->
    <center>
        <div class="container-fluid" style="padding-top:100px; padding-bottom:100px">
            <div class="row" style="padding-left:22%">
                <?php
            if ($sql1):
                if(mysqli_num_rows($sql1) > 0):
                    while($product = mysqli_fetch_assoc($sql1)):
            ?>
                <div class="col-md-3">
                    <form method="post" action="cart.php?action=add&id=<?php echo $product['PRODUCT_ID']; ?>">
                        <div class="product">
                            <img src="<?php echo $product['photo']; ?>" class="img-responsive">
                            <h5 class="text-info"><?php echo $product['PRODUCT_NAME']; ?></h5>
                            <h5 class="text-danger">฿<?php echo $product['PRODUCT_PRICE']; ?></h5>
                        </div>
                    </form>
                </div>
                <?php
                    endwhile;
                endif;
            endif;
            ?>
            </div>
    </center>
    <center>

    <!-- latest New not sql-->
    <div style="height: 100px; display: flex;  justify-content: center; background-color: lightgray;">
        <div style="border-bottom: 1px solid; width: 400px; text-align: center; " class="Best-seller container-fluid">
            Latest New
        </div>
    </div>
    <div class="container-fluid" style="padding-top:100px; padding-bottom:100px; background-color: lightgray;">
        <div class="row latest-new" style="padding-left:22%" style="">
            <div class="col-md-3">
                <div class="product" style="background-color: white; padding-top: 20px">
                    <img src="https://www.owndays.com/images/specials/products/kuromi/main-image.svg"
                        class="img-responsive" style="height:300px; width:300px; background-color: white;">
                    <h5 class="text-info">Kuromi X NWTG</h5>
                </div>
            </div>
            <div class="col-md-3">
                <div class="product"  style="background-color: white; padding-top: 20px"">
                    <img src="https://www.owndays.com/images/specials/products/airultem2022/main-pc.webp"
                        class="img-responsive" style="height:300px; width:300px; background-color: white;">
                    <h5 class="text-info">Airultem2022 x NWTG</h5>

                </div>
            </div>
            <div class="col-md-3">
                <div class="product"  style="background-color: white; padding-top: 20px">
                    <img src="https://www.owndays.com/images/specials/products/owndayspc2022/about1.webp"
                        class="img-responsive" style="height:300px; width:300px; background-color: white;">
                    <h5 class="text-info">Owndayspc2022 x NWTG</h5>
                </div>
            </div>
        </div>
    </div>
    </center> 
    
    <footer>
        <!--contract us -->
        


    </footer>























    <script>
    let total_quantity = document.getElementById("total_quantity");
    total_quantity.innerHTML = <?=json_encode($total_quantity)?>;

    function user_pro() {
        location.href = "./userprofile.php";
    }
    </script>
</body>

</html>