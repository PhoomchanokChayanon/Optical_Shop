<?php
     include('./server/server.php');
    session_start();
    $cus_username = json_encode($_SESSION['username']);
    $customer = "SELECT * FROM  customer WHERE username = $cus_username";
    $sql2 = mysqli_query($conn, $customer);
    $row = mysqli_fetch_array($sql2);
    
    $total_quantity = 0;
    if (isset($_SESSION['cart_item'])) { 
    foreach ($_SESSION["cart_item"] as $item){
        $total_quantity += $item["quantity"];
    }
    if (!isset($_SESSION['username'])){
        $username = "Guest";
    } 
    else{
        $username = json_encode($_SESSION['username']);
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="stylesheet/stylesheet.css">
    <link href="https://fonts.googleapis.com/css2?family=Gochi+Hand&family=Just+Another+Hand&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Gochi+Hand&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <style>
    .form-control {
        width: 40%;
        margin-bottom: 10px;
    }

    .container-sm {
        margin-top: 1%;
        margin-left: 35%;
    }

    #btnCancel {
        margin-left: 75px;
        margin-top: -65px;
    }
    </style>
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
               
                <div id="info" class="" role="alert" style="font-size: 30px"></div>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-1">
                    <li class="nav-item ">
                        <?php if (isset($_SESSION['username'])) : ?>
                    <li>
                        <a class="nav-link" onclick="user_pro()" style="margin-top:-6px"
                            id="pointer"><strong><?php $_SESSION['username'] ?></strong></a>
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

    <!-- form edit -->

    <h1> Edit Customer info</h1>
   
    <div class="container-sm">
        <form method="POST" id="idForm">
            <div class='form-group mb-5'>
                <label for='username'>Customer ID</label>
                <input type='text' class='form-control' name='cus_id' value='<?=$row["cus_id"]?>' disabled>
            </div>
            <div class='form-group mb-5'>
                <label for='username'>Username</label>
                <input type='text' class='form-control' name='username' value='<?=$row["username"]?>' disabled>
            </div>
            <div class='form-group mb-5'>
                <label for='fname'>Firstname</label>
                <input type='text' class='form-control' name='fname' value='<?=$row["fname"]?>'>
            </div>
            <div class='form-group mb-5'>
                <label for='fname'>Lastname</label>
                <input type='text' class='form-control' name='lname' value='<?=$row["lname"]?>'>
            </div>
            <div class='form-group mb-5'>
                <label for='fname'>Firstname</label>
                <input type='text' class='form-control' name='phone' value='<?=$row["phone"]?>'>
            </div>
            <div class='form-group mb-5'>
                <label for='Email '>Email</label>
                <input type='text' class='form-control' name='email' value='<?=$row["email"]?>'>
            </div>
            <div class='form-group mb-5'>
                <label for='password'>address</label>
                <textarea class="form-control" name="address" rows="3"><?=$row["address"]?></textarea>
            </div>

            <div class='form-group mb-5'>
                <label for='password'>New Password</label>
                <input type='password' class='form-control' name='password' id="password">
            </div>
            <div class='form-group mb-5'>
            </div>
            <input type="submit" name="save" value="save" class="btn btn-outline-success" id="submitButton">
        </form>
        <input type="submit" name="cancel" value="Go back" class="btn btn-outline-danger" id="btnCancel"
            onclick="goback()">
    </div>

    <script>
    $(document).ready(function() {
            $('#idForm').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "./edit.php",
                    data: $(this).serialize(),
                    success: function(response) {
                        $("#info").addClass("alert alert-success");
                        $('#info').html("Edit Success");
                        $("#info").css("position:fixed; top:0; width:100%; z-index:100;")
                        $('.tbl-cart').html("");
                        $('#total_quantity').html("")
                        $("#total_quantity").css("padding-top: 500px;");
                        $('#password').val("");
                        //fateout
                        setTimeout(function() {
                            $("#info").removeClass("alert alert-success");
                            $("#info").html("");
                        }, 2000);
                    }
                });
            });
        
    });


    function goback() {
        window.history.back();
    }
    </script>
</body>

</html>