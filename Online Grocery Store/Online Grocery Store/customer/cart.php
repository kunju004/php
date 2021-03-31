<?php
require_once "connection.php";

session_start();
$flag = 0;
if(isset($_SESSION['USER_ID']) && !empty($_SESSION['USER_ID']))
    {
        $userid = $_SESSION['USER_ID'];
    }


if(isset($_GET['type']) && $_GET['type']!='')
{
	$type=($_GET['type']);

    if($type=='delete'){
        $product_id=$_GET['id'];
        $qty=$_GET['qty'];
        $delete_sql="delete from cart where product_id='$product_id' and cart_qty='$qty' and user_id = '$userid'";
        $query1 =$dbhandler->query($delete_sql);
    }
    
}

$sql="SELECT * FROM cart WHERE user_id='$userid'";
$query=$dbhandler->query($sql);
$r=$query->fetchAll(PDO::FETCH_ASSOC);
if(!empty($r))
  {   
      
    
  }
  else{
    $empty="Sorry! There are no products in your cart !!";
    $flag=1;
}


    
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cart</title>
</head>

<body>
    <link rel="stylesheet" type="text/css" href="../css/style_cart.css" />
    <div class="box-area">
        <header>
            <div class="wrapper">
                <div class="logo">
                    <img src="../css/images/logo-for-grocery-store.png">
                </div>
               
                <ul>
                    <li><a href="welcome.php">Home</a></li>
                    <li><a href="categories.php">Categories</a></li>
                    <li class="active"><a href="">My Cart</a></li>
                    <li><a href="my_orders.php">My Orders</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
                
            </div>
        </header>
        <div class="banner">
          
        </div>
        <div class="content">
        <?php
        if($flag==1){?>
         <div class="error">
          <p><br/><?php echo $empty; ?><br/>
          <input onClick="window.location.href='../customer/categories.php'" type="submit" Value="Add Products">
          </div>
       <?php die();}
        
        ?>
                  
         <?php 
         if ($flag==0)
         {
         echo '<table border="1" style="width:70%;">
              <tr>
                  <th colspan="3">Products</th>
              </tr>';
              $total = 0;
            foreach($r as $row)
            { 
                
                $product=$row['product_id'];
                $category=$row['cat_id'];
                $cart_qty = $row['cart_qty'];
                $sql="SELECT product.*,categories.categories FROM product,categories WHERE product.id='$product' AND  categories.id='$category'";
                $query=$dbhandler->query($sql);
                $r1=$query->fetch(PDO::FETCH_ASSOC);
                if(!empty($r1))
                {
          
                }
                echo '<tr>
                        <td><img src="../css/images/product/'.$r1['image'].'" width="200" height="200"></td>
                        <td>Name :'.$r1['name'].'<br/>MRP(/Kg) :'.$r1['mrp'].'<br/>Price(/Kg) :'.$r1['price'].'<br/>Quantity(in Kg/s) :'.$row['cart_qty'].'<br/></td>
                        <td><a href="?type=delete&id='.$r1['id'].'&qty='.$row['cart_qty'].'">Delete</a>
                        </td>
                        </tr>';

                        $total = $total + ($row['cart_qty'] * $r1['price']);
                        
                 
             }   
             echo '</table>';  
            }
            echo '<br>';
            echo "<p>Your total amount is: " . $total ."Rs.";
            echo '<br>';
            $_SESSION['CART_AMOUNT']=$total;
        ?>
        
        <a href = "cart_purchase.php">Buy All</a></p>
            
       
        </div>

</div>
</body>

</html>