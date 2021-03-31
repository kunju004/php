<?php
 session_start();
 require_once "connection.php"; 
 $empty='';$flag=0;
 $cat_id=$_GET['id'];
 $_SESSION['CAT_ID'] = $cat_id;

 if(isset($_SESSION['USER_ID']) && !empty($_SESSION['USER_ID']))
    {
        $userid = $_SESSION['USER_ID'];
      
    }

    
    if(isset($_POST['submit']))
    {
        $_SESSION['cart_qty'] = $_POST['quantity'];
        $cart_qty = $_SESSION['cart_qty'];
        
        $product_id = $_POST['product_id'] ;
        $total_qty = $_POST['total_qty'];
        $name = $_POST['name'];
        
        if( $total_qty < $cart_qty)
        {
            $msg = "The available quantity for " . $name  ." is " . $total_qty ."kg.
            Please select a value less than or equal to ". $total_qty." ";
            $flag = 2;
        }
        else
        {
            $cart_query = "INSERT INTO cart(cat_id,user_id,product_id,cart_qty) VALUES ('$cat_id','$userid','$product_id' , '$cart_qty')";
            $query1=$dbhandler->query($cart_query);
        }
    }

 $sql="SELECT * FROM product WHERE categories_id='$cat_id' AND status='1' ";
 $query=$dbhandler->query($sql);
 $r=$query->fetchAll(PDO::FETCH_ASSOC);
    if(!empty($r))
    {
    }
    else{
        $empty="Sorry! There are no products available for this category !!";
        $flag=1;
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>products</title>
</head>

<body>
    <link rel="stylesheet" type="text/css" href="../css/style_products.css" />
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
        
        <div class="content">
        <div class="error">
              <p>
                  <?php 
                  if($flag==1)
                  {  echo $empty;
                     die();
                  }
                  if($flag==2)
                  {
                    echo $msg;
                    $flag=0;
                  }
                  ?>
               </p>
         </div>
         
         <?php 
         if ($flag==0){
         echo '<table border="1" style="width:75%;">
              <tr>
                  <th colspan="4">Products</th>
              </tr>';
              $i = 0;
             foreach($r as $row){
                  echo '<tr>
                        <td><img src="../css/images/product/'.$row['image'].'" width="200" height="200"/></td>
                        <td>Name :'.$row['name'].'<br/>MRP(/Kg) :'.$row['mrp'].'<br/>Price(/Kg) :'.$row['price'].'<br/></td>
                        <td><a href="purchase.php?id='. $row['id'].'">Buy Now</a></td>
                        <td>
                        <form method = "POST" action="">
                        <input type = "number" min = "0.1" step = "0.1" name = "quantity" placeholder = "Enter Quantity" /required><br/> 
                        <input type = "submit" name = "submit" value = "Add to Cart">
                         
                        </td>
                       
                        <input type="hidden" name="product_id" value="'.$row['id'].'">
                        <input type="hidden" name="name" value="'.$row['name'].'">
                        <input type="hidden" name="total_qty" value="'.$row['qty'].'">
                     
                        </form>
                        </tr>';
                       
            }
             }   
             echo '</table>';  ?>
              <br/><p><center><a href="categories.php" style="
    color: #ffffff;
    letter-spacing: 1px;
    font-size: 1.5em;">Back</a><center></p>
        </div>

</div>
</body>

</html>