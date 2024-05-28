<?php
    session_start();
    include('../server/server.php'); 
    if(!isset($_SESSION['username'])){
        $username = "Guest";
    }
    else{
        $username = $_SESSION['username'];
    }

    if(!isset($_COOKIE['username'])){
        $username = "Guest";
    }

    $total_quantity = 0;
    if (isset($_SESSION['cart_item'])) { 
        foreach ($_SESSION["cart_item"] as $item){
            $total_quantity += $item["quantity"];
        }
    }
    
   

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

    <link rel="stylesheet" href="../stylesheet/sty.css">
    <link href="https://unpkg.com/tailwindcss@%5E1.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css%22%3E">
    <link rel="preconnect" href="https://fonts.googleapis.com/%22%3E">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
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
    <script>
    var username = <?=json_encode($username)?>;
    if (username != "Guest") {
        window.location.href = "../index.php";
    }
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
                        <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../product.php">items</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-1">
                    <li class="nav-item ">
                        <?php if (isset($_SESSION['username'])) : ?>
                    <li>
                        <a class="nav-link" onclick="user_pro()" style="margin-top:-6px"
                            id="pointer"><strong><?php echo $_SESSION['username']; ?></strong></a>
                    </li>
                    <li>
                        <a class="nav-item"><a href="index.php?logout='1'" style="color: red;">Logout</a>
                    </li>
                    <?php endif ?>
                    <?php if (!isset($_SESSION['username'])) :?>
                    <a class="nav-link active " id="user" aria-current="page" href="./login.php"
                        style="margin-top: -7px;">Login</a>
                    </li>
                    <?php endif ?>
                </ul>

                <ul class="navbar-nav ms-7 mb-3 mb-lg-3">
                    <li class="nav-item">
                        <?php if($total_quantity > 0): ?>
                        <div id="total_quantity" class="total_quantity animate__heartBeat"
                            style="margin-top:28px; margin-left:30px; "></div>
                        <a class="nav-link" href="../cart.php" style="margin-top:-45px; "><img src="../image/cart.png"
                                style="width: 26px; height: 25px"></a>
                        <?php else: ?>
                        <a class="nav-link" href="../cart.php" style="margin-top:5px; "><img src="../image/cart.png"
                                style="width: 26px; height: 25px"></a>

                        <?php endif ?>

                    </li>
                </ul>
            </div>
        </div>
    </nav>
    </div>
    <div class="header">
        <h2>Login</h2>
    </div>

    <form action="login_db.php" method="post">
        <?php if (isset($_SESSION['error'])) : ?>
        <div class="error">
            <h3>
                <?php 
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    ?>
            </h3>
        </div>
        <?php endif ?>
        <div class="input-group">
            <label for="username">Username</label>
            <input type="text" name="username" pattern="\w{1,10}">
        </div>
        <div class="input-group">
            <label for="password">Password</label>
            <input type="password" name="password">
        </div>
        <div class="input-group">
            <button type="submit" name="login_user" class="btn btn-outline-dark">Login</button>
        </div>
        <p>Not yet a member? <a href="register.php">Sign Up</a></p>
    </form>

</body>

</html>