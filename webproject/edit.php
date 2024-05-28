<?php include('./server/server.php'); 
session_start();
//update info customer   
    $username = $_SESSION['username'];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    $sql = "UPDATE customer SET fname = '$fname', lname = '$lname', address = '$address', phone = '$phone', email = '$email', password = '$password' WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    if($result){
        //echo "<script>alert('Update Success')</script>";
        //echo "<script>window.location.href='editprofile.php'</script>";
    }
    else{
        //echo "<script>alert('Update Fail')</script>";
        //echo "<script>window.location.href='editprofile.php'</script>";
    }
    
?>