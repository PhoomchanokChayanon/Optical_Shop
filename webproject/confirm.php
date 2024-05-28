<?php include('./server/server.php');
    session_start();
    $total_PRODUCT_PRICE = 0;
    $total_quantity = 0;
    if (isset($_SESSION['cart_item'])) { 
        foreach ($_SESSION["cart_item"] as $item){
            $total_quantity += $item["quantity"];
            $total_PRODUCT_PRICE += ($item["PRODUCT_PRICE"]* $item["quantity"]);
        }
    }
    if($total_quantity)
    {
        $myjson = json_encode($_SESSION['cart_item']);
        $cus_username = json_encode($_SESSION['username']);
        $time = date("Y-m-d-h:i:s",time());
        
        $insert = "INSERT INTO transactions VALUES ('','$myjson','$total_PRODUCT_PRICE', '$time',(SELECT cus_id FROM customer WHERE username = $cus_username))"; 
        unset($_SESSION["cart_item"]);

        if(mysqli_query($conn, $insert)){
            echo "success";
        }
        else{
            echo "fail";
        }
    }
    else{
        die();
    }
    ?>
}