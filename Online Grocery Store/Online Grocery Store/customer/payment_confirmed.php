<?php
session_start();
 require_once "connection.php";
 
 $id=$_GET['id'];

 $sql="SELECT * FROM product WHERE id='$id' AND status='1' ";
 $query=$dbhandler->query($sql);
 $r=$query->fetch(PDO::FETCH_ASSOC);
 if(!empty($r))
{   
    
}
    
 if(isset($_POST['submit']))
    {
        header("Location: ./my_orders.php");
    }
 ?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>payment</title>
</head>

<body>
    <link rel="stylesheet" type="text/css" href="../css/style_paymentconfirmed.css" />
    <div class="box-area">
        <header>
            <div class="wrapper">
                <div class="logo">
                    <img src="../css/images/logo-for-grocery-store.png">
                </div>
                <ul>
                    <li><a href="welcome.php">Home</a></li>
                    <li><a href="categories.php">Categories</a></li>
                    <li><a href="cart.php">My Cart</a></li>
                    <li><a href="my_orders.php">My Orders</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </header>
        <div class="banner">
            <h1>Congratulations !! <br/>Your Payment is Successfull !!</h1>
           
        </div>
        <div class="content">
            <br/><br/>
            <h2>Your Order has been placed.You will receive the delivery soon !!</h2>
        <form action="" method="post">
        <p>
            <input type="submit" name="submit" value="View Order Details"></p>
            <a href="welcome.php" style="
    color: #ffffff;
    letter-spacing: 1px;
    font-size: 1.8em;">Home</a>
        </form>    
        </div>

</div>
</body>

</html>