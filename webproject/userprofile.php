<?php
    include('./server/server.php');
    session_start();
    if (!isset($_SESSION['username'])){
        $username = "Guest";
    } 
    else{
        $cus_username = json_encode($_SESSION['username']);
    }
    //bind value
    if($_GET['t_id'])
    {
        $t_id = $_GET['t_id'];
        $transtation = "SELECT * FROM transactions WHERE cus_id = (SELECT cus_id FROM customer WHERE username = $cus_username) and t_id = ?";
        $stmt = $conn->prepare($transtation);
        $stmt->bind_param("i", $t_id);
    }else{
        $transtation = "SELECT * FROM transactions WHERE cus_id = (SELECT cus_id FROM customer WHERE username = $cus_username)";
        $stmt = $conn->prepare($transtation);
    }     
    
    $stmt->execute();
    $sql1 = $stmt->get_result();


    //$sql1  = mysqli_query($conn, $transtation);
    $customer = "SELECT * FROM  customer WHERE username = $cus_username";
    $sql2 = mysqli_query($conn, $customer);
    $total_quantity = 0;
    if (isset($_SESSION['cart_item'])) { 
    foreach ($_SESSION["cart_item"] as $item){
        $total_quantity += $item["quantity"];
    }
}
?>



<!DOCTYPE html>
<html lang="en">

</html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link rel="stylesheet" href="stylesheet/stylesheet.css?v=<?php echo time(); ?>">
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/particlesjs/2.2.3/particles.min.js" rel="stylesheet">
    <title>user Profile</title>
    <script>
    var username = <?=json_encode($username)?>;
    if (username == "Guest") {
        alert("You must log in first");
        location.href = "./login/login.php";

    }

    function editProfile() {
        location.href = "./editprofile.php";
    }
    </script>

</head>

<body>
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
                            <a class="nav-link " id="pointer" onclick="user_pro()"
                                style="margin-top:-6px"><strong><?php echo $_SESSION['username']; ?></strong></a>
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


    <div class="container">

        <h1>Customer Detail</h1>


        <button class="btn btn-outline-danger" style="float:right" onclick="editProfile()">Edit</button>
        <table class="table table-borderless">
            <?php while ($row = $sql2->fetch_assoc()) { 
        echo "<tr>";
        echo "<tr><td>Customer_ID: ".$row['cus_id']."</td>"."</tr>";
        echo "<tr><td>Name: ".$row['fname']."  ".$row['lname']."</td></p>"."</tr>";
        echo "<tr ><td>Address: ".$row['address']."</td>"."</tr>";
        echo "<tr><td>Phone: ".$row['phone']."</td>"."</tr>";
        echo "<tr><td>Email: ".$row['email']."</td>"."</tr>";
        echo "</tr>";
    }   
 ?>
    </table>
   
        <h1>Order History</h1>
        <h5 class="text-secondary">Search Transactions ID</h5>
            <form action="userprofile.php?t_id=" method="GET">
                <input type="text" name="t_id" placeholder="ID Transactions" class="form-control" style="width:20%; padding-botton">
                <input type="submit" name="submit" value="Search" class="btn btn-outline-info btn-sm" style="margin-top:3px; margin-bottom:7px">
            </form>
        <div style="overflow-y: scroll;height: 450px">
            <table class="table table-striped table-hover">
                <tr>
                    <th>Transactions</th>
                    <th>PRODUCT_NAME</th>
                    <th>Quantity</th>
                    <th>Time</th>
                </tr>
                <?php while ($row = $sql1->fetch_assoc()) { 
     $json_data = json_decode($row['orderlist'],true);
     foreach($json_data as $key=>$value){
        echo "<tr>";
        echo "<td>".$row['t_id']."</td>";
        echo "<td>".$json_data[$key]["PRODUCT_NAME"]."</td>";
        echo "<td>".$json_data[$key]["quantity"]."</td>";
        echo "<td>".$row["updated_at"]."</td>";
        echo "</tr>";
     }
    }   
 ?>
            </table>
            <div>
            </div>
            <footer>

            </footer>
            <script>
            let total_quantity = document.getElementById("total_quantity");
            total_quantity.innerHTML = <?=json_encode($total_quantity)?>;
            </script>
</body>

</html>