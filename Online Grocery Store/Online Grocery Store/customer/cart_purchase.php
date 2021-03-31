<?php
 require_once "connection.php";
  
 $flag=0;
 if(isset($_POST['submit']))
    {
        session_start();
        $id=$_SESSION['USER_ID'];
        $sql="SELECT * FROM cart WHERE user_id='$id' ";
        $query=$dbhandler->query($sql);
        $r=$query->fetchAll(PDO::FETCH_ASSOC);
        if(!empty($r))
        {
            $i=0;
            foreach($r as $row)
            {
               $c_array[$i]=$row['cat_id'];
               $p_array[$i]=$row['product_id'];
               $q_array[$i]=$row['cart_qty'];
               $i++;
            }
        }
        $c=implode(",",$c_array);
        $p=implode(",",$p_array);
        $q=implode(",",$q_array);
       
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $addrss=$_POST['address'];
        $contact=$_POST['contact'];
        $amount=$_SESSION['CART_AMOUNT'];
        $sql="INSERT INTO cart_orders (user_id,c_id,p_id,quantity,amount,fname,lname,address,contact)
        VALUES ('$id','$c','$p','$q','$amount','$fname','$lname','$addrss','$contact')";
        $query=$dbhandler->query($sql);
        $_SESSION['CART_QUANTITY']=$q_array;
        header("Location: ./payment.php?id=-1");

    }
 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>cart_purchase</title>
</head>

<body>
    <link rel="stylesheet" type="text/css" href="../css/style_cartpurchase.css" />
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
            <h1>Cart Purchase</h1>
        </div>
        <div class="content">
         <?php 
           if ($flag==0){
               
               echo '<form method="post" action="">
               <table border="1" bordercolor="white" width="100%">
               <tr>
                   <th colspan="2">Enter Details to proceed to payment</th>
                </tr>
               <tr>
                   <td>Enter Firstname :</td>
                   <td><input type="text" name="fname" placeholder="Delivery on fname"/required></td>
               </tr>
               <tr>
                   <td>Enter Lastname :</td>
                   <td><input type="text" name="lname" placeholder="Delivery on lname"/required></td>
               </tr>
               <tr>
                   <td>Enter Your address :</td>
                   <td><textarea name="address" placeholder="Delivery at address"/required></textarea></td>
               </tr>
               <tr>
                   <td>Enter ContactNo :</td>
                   <td><input type="text" name="contact" maxlength="10" placeholder="Enter Contact"/required></td>
               </tr>
               <tr>
                   <td colspan="2"><input type="submit" name="submit" value="Submit"/></td>
               </tr>
               </form>';
           }
              ?>
              
       
        </div>

</div>
</body>

</html>
