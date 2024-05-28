<?php
session_start();
$total_quantity = 0;
if (isset($_SESSION['cart_item'])) { 
    foreach ($_SESSION["cart_item"] as $item){
        $total_quantity += $item["quantity"];
    }
}
error_reporting(E_ERROR | E_PARSE);
?>

<HTML>

<HEAD>
    <TITLE>Products</TITLE>
    <link href="stylesheet/style1.css" type="text/css" rel="stylesheet" />
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
     var element = document.getElementById("menu_item");
        element.classList.add("btn btn-outline-secondary");    
    </script>
  
</HEAD>

<BODY>
    <div style="height: 70px;">
        <nav class="navbar navbar-expand-lg fixed-top navbar-light" style="background-color: white; ">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"
                    style="font-family: 'Just Another Hand', cursive; font-size: 35px;">NWTG </a>
                <button class="navbar-toggler " type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarTogglerDemo02">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-1">
                        <li class="nav-item ">
                            <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./product.php">items</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-1">
                        <li class="nav-item ">
                            <?php if (isset($_SESSION['username'])) : ?>
                        <li>
                            <a class="nav-link" onclick="user_pro()" style="margin-top:-6px ;cursor: pointer;"
                                id="pointer"><strong><?php echo $_SESSION['username']; ?></strong></a>
                        </li>
                        <li>
                            <a class="nav-item"><a href="index.php?logout='1'" style="color: red;">Logout</a>
                        </li>
                        <?php endif ?>
                        <?php if (!isset($_SESSION['username'])) : ?>
                        <a class="nav-link active " id="user" aria-current="page" href="./login/login.php"
                            style="margin-top: -7px;">Login</a>
                        </li>
                        <?php endif ?>
                    </ul>

                    <ul class="navbar-nav ms-7 mb-3 mb-lg-3">
                        <li class="nav-item">
                            <?php if($total_quantity > 0): ?>
                            <div id="total_quantity" class="total_quantity animate__heartBeat"
                                style="margin-top:28px; margin-left:30px; color: red;font-size: 15px;font-weight: 900;">
                            </div>
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
    <div class="container">
        <div id="product-grid">
            <div class="txt-heading">Products</div>
            <div class="row">
                <div class="col">
                    <form action="product.php?PRODUCT_NAME=" method="GET">
                        <div class="search-box" >
                            <input type="text" autocomplete="on" placeholder="Search..." name="PRODUCT_NAME" class="form-control"/>
                            <input type="submit" name="search" value="search" style="margin-top:10px" class="btn btn-outline-primary btn-sm"/>
                        </div>
                    </form>
                </div>
                <div class="col">
                <a class="btn" href=product.php style="background-color:darkgray;color:white; hover: black">ALL</a>
                </div>                
            <?php include('./server/server.php');
            $sql= "SELECT DISTINCT(BRAND) FROM `product`";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_array($result)){
           
           
                echo "<div class=col>";
                echo   "<a #id=menu_item style=background-color:darkgray;color:white class=btn btn-primary href=product.php?BRAND=".$row["BRAND"].">".$row["BRAND"]."</a>";
                echo "</div>";

            } ?>

            </div>
            <?php
    
    require_once("server/dbcontroller.php");
    $db_handle = new DBController();
    if($_GET["PRODUCT_NAME"]){
        $product_array = $db_handle->runQuery("SELECT * FROM product WHERE PRODUCT_NAME LIKE '%" . $_GET["PRODUCT_NAME"] . "%'");
      
    }else{
        $product_array = $db_handle->runQuery("SELECT PRODUCT_ID,PRODUCT_NAME,PRODUCT_PRICE,photo,BRAND FROM product ORDER BY PRODUCT_ID ASC");
    }
	
    if($_GET["BRAND"]){
        $product_array = $db_handle->runQuery("SELECT * FROM product WHERE BRAND LIKE '%" . $_GET["BRAND"] . "%'");
    }
    
    if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
	?>
            <!-- form search -->

            <div class="product-item">
                <form method="post"
                    action="cart.php?action=add&PRODUCT_ID=<?php echo $product_array[$key]["PRODUCT_ID"]; ?>">
                    <div class="product-image"><img src="<?php echo $product_array[$key]["photo"]; ?>"></div>
                    <div class="product-tile-footer">
                        <span class="badge badge-primary"
                            style="color:red"><?php echo $product_array[$key]["BRAND"]; ?></span>
                        <div class="product-title"><?php echo $product_array[$key]["PRODUCT_NAME"]; ?></div>

                        <div class="product-price"><?php echo "฿".$product_array[$key]["PRODUCT_PRICE"]; ?></div>
                        <div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1"
                                size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" /></div>
                    </div>
                </form>
            </div>
            <?php
		}
	}
	?>
        </div>
        <script>
        
        let total_quantity = document.getElementById("total_quantity");
        total_quantity.innerHTML = <?=json_encode($total_quantity)?>;

        
        
        function user_pro() {
            location.href = "./userprofile.php";
        }
        </script>

    </div>
</BODY>

</HTML>