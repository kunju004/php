<?php
 require_once "connection.php";

 $empty='';$flag=0;
  
 $id=$_GET['id'];
 $sql="SELECT * FROM product WHERE id='$id' AND status='1' ";
 $query=$dbhandler->query($sql);
 $r=$query->fetch(PDO::FETCH_ASSOC);
    if(!empty($r))
    {
        $price=$r['price'];
    }
    else{
        $empty="Sorry! The product is already sold !!";
        $flag=1;
         
    }
    if(isset($_POST['submit']))
    {
     $qty=$_POST['qty'];
     
     if($qty > $r['qty'])
     {
         if($r['qty']==0)
         {
             $error="Sorry! The product is out of stock !!";
             $flag=2;
         }else{
         $error="The available quantity for this product is ". $r['qty'] ."kg.Please select a value less than or equal to ". $r['qty']."";
         $flag=2;
         }
     }
     else{
        session_start();
        $_SESSION['QUANTITY']=$qty;
        $email=$_SESSION['USER_EMAIL'];
        $p_id=$r['id'];
        $c_id=$r['categories_id'];
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $addrss=$_POST['address'];
        $contact=$_POST['contact'];
        $amount=$qty*$price;
        $sql="INSERT INTO orders (email,product_id,category_id,quantity,amount,firstname,lastname,address,contact)
        VALUES ('$email','$p_id','$c_id','$qty','$amount','$fname','$lname','$addrss','$contact')";
        $query=$dbhandler->query($sql);
        header("Location: ./payment.php?id=".$r['id']."");
     }
     
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>purchase</title>
</head>

<body>
    <link rel="stylesheet" type="text/css" href="../css/style_purchase.css" />
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
            <h1>Purchase</h1>
        </div>
        <div class="content">
        <div class="error">
              <p>
                  <?php 
                  if($flag==1)
                  {  echo $empty;
                    $sql="SELECT * FROM product WHERE id='$id'";
                    $query=$dbhandler->query($sql);
                    $r=$query->fetchAll(PDO::FETCH_ASSOC);
                    foreach($r as $row){$category_id=$row['categories_id'];}
                    echo '<br/><a href="products.php?id='.$category_id.'">Choose Another</a>';
                     die();
                  }
                  if($flag==2)
                  {  echo $error;
                     $flag=0;
                  }
                  ?>
               </p>
         </div>
         <?php 
           if ($flag==0){
               
              
               echo '<form method="post" action="">
               <table border="1" bordercolor="white" width="100%">
               <tr>
                   <th colspan="2">Enter Details to proceed to payment</th>
                </tr>
               <tr>
                   <td>Product Name :</td>
                   <td><input type="text" name="pname" value="'.$r['name'].'"></td>
               </tr>
               <tr>
                   <td>Enter Quantity(in Kg):</td>
                   <td><input type="number" step="0.1" min="0.1" name="qty" placeholder="Quantity to purchase"/required></td>
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
                   <td><input type="text" name="contact" maxlength="10" placeholder="Enter Contact" /required></td>
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
