<?php
 session_start();
 require_once "connection.php";

 $empty='';$flag=0;

 //fetching the current page url
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$CurPageURL = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];  
//Getting the record id from the url 
 $pid=substr($CurPageURL, -1);
 if(is_numeric($pid)){
     if($pid==0){
        $user_id=$_SESSION['USER_ID'];
        $amount=$_SESSION['CART_AMOUNT'];
        $quantity=implode(',',$_SESSION['CART_QUANTITY']);
        $sql1="DELETE FROM cart_orders WHERE user_id='$user_id' AND quantity='$quantity' AND amount='$amount' AND  pay_status=0";
        $query=$dbhandler->query($sql1);    
     }else{
    $email=$_SESSION['USER_EMAIL'];
    $quantity=$_SESSION['QUANTITY'];
    $sql1="DELETE FROM orders WHERE product_id='$pid' AND quantity='$quantity' AND email='$email' AND  pay_status=0";
    $query=$dbhandler->query($sql1);
     }
 }
 
 $sql="SELECT * FROM categories WHERE status='1' ";
 $query=$dbhandler->query($sql);
 $r=$query->fetchAll(PDO::FETCH_ASSOC);
    if(!empty($r))
    {
    }
    else{
        $empty="Sorry! There are no categories available right now !!";
        $flag=1;
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>categories</title>
</head>

<body>
    <link rel="stylesheet" type="text/css" href="../css/style_categories.css" />
    <div class="box-area">
        <header>
            <div class="wrapper">
                <div class="logo">
                    <img src="../css/images/logo-for-grocery-store.png">
                </div>
                <ul>
                    <li><a href="welcome.php">Home</a></li>
                    <li class="active"><a href="">Categories</a></li>
                    <li><a href="cart.php">My Cart</a></li>
                    <li><a href="my_orders.php">My Orders</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </header>
        <div class="banner">
            <h1>Categories</h1>
        </div>
        <div class="content">
            <br/><br/>
        <div class="error">
               <p>
                  <?php 
                  if($flag==1)
                  {  echo $empty.'<br/>';
                     die();
                  }
                  ?>
               </p>
         </div>
         <?php 
         if ($flag==0){
            echo '<table border="1" style="width:60%">
              <tr>
                  <th colspan="2">Categories</th>
              </tr>';
    
             foreach($r as $row){
                  echo '<tr>
                        <td>'.$row['categories'].'</td>
                        <td><u><a href="products.php?id='. $row['id'].'">View Products</a></u></td>
                        </tr>'; 
                }
            }
            echo '</table>';  ?>
       
        </div>

</div>
</body>

</html>