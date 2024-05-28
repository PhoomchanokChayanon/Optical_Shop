<?php
session_start();
require_once("server/dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT PRODUCT_ID,PRODUCT_NAME,PRODUCT_PRICE,photo FROM product WHERE PRODUCT_ID='" . $_GET["PRODUCT_ID"] . "' ORDER BY PRODUCT_ID ASC");
			$itemArray = array($productByCode[0]["PRODUCT_ID"]=>array('PRODUCT_NAME'=>$productByCode[0]["PRODUCT_NAME"], 'PRODUCT_ID'=>$productByCode[0]["PRODUCT_ID"], 'quantity'=>$_POST["quantity"], 'PRODUCT_PRICE'=>$productByCode[0]["PRODUCT_PRICE"], 'photo'=>$productByCode[0]["photo"]));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["PRODUCT_ID"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["PRODUCT_ID"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
        header("location:./product.php");
        }
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
}
}
    

if (!isset($_SESSION['username'])){
        $username = "Guest";
    } 
    else{
        $username = $_SESSION['username'];
    }

    $total_quantity = 0;
    if (isset($_SESSION['cart_item'])) { 
        foreach ($_SESSION["cart_item"] as $item){
            $total_quantity += $item["quantity"];
        }
    }

?>
<HTML>

<HEAD>
    <TITLE>Simple PHP Shopping Cart</TITLE>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="stylesheet/style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="style.css" type="text/css" rel="stylesheet" />
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
                        <li class="nav-item "></li>
                        <?php if (isset($_SESSION['username'])) : ?>
                        <li>
                            <a class="nav-link" onclick="user_pro()" style="margin-top:-6px"
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
        <div id="info" class="" role="alert"></div>
        <div id="shopping-cart">
            <div class="txt-heading">Shopping Cart</div>

            <a id="btnEmpty" href="cart.php?action=empty" class="btn btn-outline-danger btn-sm">Empty Cart</a>
            <?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_PRODUCT_PRICE = 0;
?>
            <table class="tbl-cart" cellpadding="10" cellspacing="1">
                <tbody>
                    <tr>
                        <th style="text-align:left;">Name</th>
                        <th style="text-align:left;">Code</th>
                        <th style="text-align:right;" width="5%">Quantity</th>
                        <th style="text-align:right;" width="10%">Unit Price</th>
                        <th style="text-align:right;" width="15%">Price</th>
                    </tr>
                    <?php		
    foreach ($_SESSION["cart_item"] as $item){
        $item_PRODUCT_PRICE = $item["quantity"]*$item["PRODUCT_PRICE"];
		?>
                    <tr>
                        <td><img src="<?php echo $item["photo"]; ?>"
                                class="cart-item-image" /><?php echo $item["PRODUCT_NAME"]; ?></td>
                        <td><?php echo $item["PRODUCT_ID"]; ?></td>
                        <td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
                        <td style="text-align:right;"><?php echo "฿ ".$item["PRODUCT_PRICE"]; ?></td>
                        <td style="text-align:right;"><?php echo "฿ ". number_format($item_PRODUCT_PRICE,2); ?></td>
                    </tr>
                    <?php
				$total_quantity += $item["quantity"];
				$total_PRODUCT_PRICE += ($item["PRODUCT_PRICE"]*$item["quantity"]);
		}
		?>

                    <tr>
                        <td colspan="2" align="right">Total:</td>
                        <td align="right"><?php echo $total_quantity; ?></td>
                        <td align="right" colspan="2">
                            <strong><?php echo "฿ ".number_format($total_PRODUCT_PRICE, 2); ?></strong>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php
} else {
?>
            <div class="no-records">Your Cart is Empty</div>
            <?php 
}
?>
        </div>

        <button id="goto_product" class="btn btn-outline-secondary">เลือกสินค้าต่อ</button>
        <button id="order_confirm" class="btn btn-outline-success float-end"
            style="padding-right:-30px; ">ยืนยันการสั่งซื้อ</button>
    </div>
    <script>
    let total_quantity = document.getElementById("total_quantity");
    total_quantity.innerHTML = <?=json_encode($total_quantity)?>;
    </script>

    <script type="text/javascript">
    document.getElementById("goto_product").onclick = function() {
        location.href = "product.php";
    };

    document.getElementById("order_confirm").onclick = function() {
        var username = <?=json_encode($username)?>;
        if (username != "Guest") {
            if (<?=$total_quantity?>) {
                $.ajax({
                    url: "./confirm.php",
                    error() {
                        $("#info").addClass("alert alert-danger");
                        $('#info').html("Fail to order");
                    },
                    success() {
                        $("#info").addClass("alert alert-success");
                        $('#info').html("Order successfully");
                        $('.tbl-cart').html("");
                        $('#total_quantity').html("")
                        $("#total_quantity").css("padding-top: 500px;");
                    }
                })
            } else {
                $("#info").addClass("alert alert-danger");
                $('#info').html("Please add product to cart");
            }
        } else {


            $("#info").addClass("alert alert-danger");
            $('#info').html("Please login first");
            
            //fateout
             setTimeout(function() {
                 $("#info").removeClass("alert alert-danger");
                 $('#info').html("");
             }, 3000);
          

        }

    };

    function user_pro() {
        location.href = "./userprofile.php";
    }
    </script>


</BODY>

</HTML>