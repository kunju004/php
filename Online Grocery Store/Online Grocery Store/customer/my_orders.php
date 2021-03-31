<?php
 $flag=0;$flag1=0;
 session_start();
 require_once "connection.php";
  
 $email=$_SESSION['USER_EMAIL'];
 $user_id=$_SESSION['USER_ID'];
 $sql="SELECT * FROM orders WHERE email='$email' ";
 $query=$dbhandler->query($sql);
 $r=$query->fetchAll(PDO::FETCH_ASSOC);
 if(!empty($r))
  {
      foreach($r as $row)
    {
        if($row['pay_status']==0)
        {
            $sql="DELETE FROM orders WHERE pay_status=0 ";
            $query=$dbhandler->query($sql);
        }
    }
    $nRows = $dbhandler->query("SELECT COUNT(*) FROM orders WHERE email= '$email' ")->fetchColumn(); 
      if($nRows==0)
      {
          $flag=1;
      }  
  }
  else{
      $flag=1;
  }
  $sql1="SELECT * FROM cart_orders WHERE user_id='$user_id' ";
  $query=$dbhandler->query($sql1);
  $a=$query->fetchAll(PDO::FETCH_ASSOC);
  if(!empty($a)) {
      foreach($a as $r1){
      if($r1['pay_status']==0)
        {
            $sql="DELETE FROM cart_orders WHERE pay_status=0 ";
            $query=$dbhandler->query($sql);
        }
    }
    $nRows = $dbhandler->query("SELECT COUNT(*) FROM cart_orders WHERE user_id= '$user_id' ")->fetchColumn(); 
      if($nRows==0)
      {
          $flag1=1;
      }
    
  }
  else{
     $flag1=1;
  }

  if(isset($_POST['submit1']))
  { 
    if($flag==0)
    {
        $pid=$_POST['product_id']; 
        $qty=$_POST['qty'];

        $sql="SELECT * FROM product WHERE id='$pid' ";
        $query=$dbhandler->query($sql);
        $r=$query->fetch(PDO::FETCH_ASSOC);
        if(!empty($r))
        { $qty1=$qty + $r['qty']; }
        
        $sql1="UPDATE product SET  qty= ? WHERE id='$pid'";
        $dbhandler->prepare($sql1)->execute([$qty1]);
        if($r['qty']>0)
        {
            $a=1;
            $sql="UPDATE product SET  status= ? WHERE id='$pid'";
            $dbhandler->prepare($sql)->execute([$a]);
        }
        $sql="DELETE FROM orders WHERE product_id='$pid' AND quantity='$qty'";
        $query=$dbhandler->query($sql);
   
    }




    $email=$_SESSION['USER_EMAIL'];
    $sql="SELECT * FROM orders WHERE email='$email' ";
    $query=$dbhandler->query($sql);
    $r=$query->fetchAll(PDO::FETCH_ASSOC);
    if(!empty($r))
    {  foreach($r as $row)
        {
            if($row['pay_status']==0)
            {
                $sql="DELETE FROM orders WHERE pay_status=0 ";
                $query=$dbhandler->query($sql);
            }
        }
        $nRows = $dbhandler->query("SELECT COUNT(*) FROM orders WHERE email= '$email' ")->fetchColumn(); 
          if($nRows==0)
          {
              $flag=1;
          }  
     }
    else
    {
        $flag=1;
    }
    $sql1="SELECT * FROM cart_orders WHERE user_id='$user_id' ";
  $query=$dbhandler->query($sql1);
  $a=$query->fetchAll(PDO::FETCH_ASSOC);
  if(!empty($a)) {
      foreach($a as $r1){
      if($r1['pay_status']==0)
        {
            $sql="DELETE FROM cart_orders WHERE pay_status=0 ";
            $query=$dbhandler->query($sql);
        }
    }
    $nRows = $dbhandler->query("SELECT COUNT(*) FROM cart_orders WHERE user_id= '$user_id' ")->fetchColumn(); 
      if($nRows==0)
      {
          $flag1=1;
      }
    
  }
  else{
     $flag1=1;
  }

}

    if(isset($_POST['submit']))
    { 
        if($flag1==0)
        {
            $cart_pid=explode(',',$_POST['cart_pid']);
            $cart_qty=explode(',',$_POST['cart_qty']);
        
    
            for($i=0;$i<count($cart_qty);$i++)
            {
                $pid=$cart_pid[$i];
                $sql="SELECT * FROM product WHERE id='$pid' ";
                $query=$dbhandler->query($sql);
                $r=$query->fetch(PDO::FETCH_ASSOC);
                if(!empty($r))
                { $qty1=$cart_qty[$i] + $r['qty']; }

                $sql1="UPDATE product SET  qty= ? WHERE id='$pid'";
                $dbhandler->prepare($sql1)->execute([$qty1]);
                if($r['qty']>0)
                {
                    $a=1;
                    $sql="UPDATE product SET  status= ? WHERE id='$pid'";
                    $dbhandler->prepare($sql)->execute([$a]);
                }
            }
            $p=implode(',',$cart_pid);
            $q=implode(',',$cart_qty);
            $sql="DELETE FROM cart_orders WHERE p_id='$p' AND quantity='$q'";
            $query=$dbhandler->query($sql);
    
        }

        $email=$_SESSION['USER_EMAIL'];
    $sql="SELECT * FROM orders WHERE email='$email' ";
    $query=$dbhandler->query($sql);
    $r=$query->fetchAll(PDO::FETCH_ASSOC);
    if(!empty($r))
    {  foreach($r as $row)
        {
            if($row['pay_status']==0)
            {
                $sql="DELETE FROM orders WHERE pay_status=0 ";
                $query=$dbhandler->query($sql);
            }
        }
        $nRows = $dbhandler->query("SELECT COUNT(*) FROM orders WHERE email= '$email' ")->fetchColumn(); 
          if($nRows==0)
          {
              $flag=1;
          }  
     }
    else
    {
        $flag=1;
    }
    $sql1="SELECT * FROM cart_orders WHERE user_id='$user_id' ";
  $query=$dbhandler->query($sql1);
  $a=$query->fetchAll(PDO::FETCH_ASSOC);
  if(!empty($a)) 
  {
      foreach($a as $r1)
      {
        if($r1['pay_status']==0)
            {
                $sql="DELETE FROM cart_orders WHERE pay_status=0 ";
                $query=$dbhandler->query($sql);
            }
        }
    $nRows = $dbhandler->query("SELECT COUNT(*) FROM cart_orders WHERE user_id= '$user_id' ")->fetchColumn(); 
      if($nRows==0)
      {
          $flag1=1;
      }
    
  }
  else
  {
     $flag1=1;
  }
}
 
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>my_orders</title>
</head>

<body>
    <link rel="stylesheet" type="text/css" href="../css/style_myorders.css" />
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
                    <li class="active"><a href="">My Orders</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </header>
        <div class="banner">
            <h1>My Orders !</h1>
        </div>
        <div class="content">
        <?php
        if($flag==1 && $flag1==1){?>
         <div class="message">
          <p><br/>You do not have any orders placed !!<br/>
          <input onClick="window.location.href='../customer/categories.php'" type="submit" Value="Order Now">
          </div>
       <?php }
        
        ?>
       
       <?php if($flag==0 || $flag1==0){ ?>
        <form action="" method="post">
        <table border="1">
        <thread>
            <th>Order Details</th>
            <th>Product Details</th>
        </thread>
        <tbody>
        <?php
        if($flag==0){
        foreach($r as $row){ 
        $product=$row['product_id'];
        $category=$row['category_id'];
        $sql="SELECT product.*,categories.categories FROM product,categories WHERE product.id='$product' AND  categories.id='$category'";
        $query=$dbhandler->query($sql);
        $r1=$query->fetch(PDO::FETCH_ASSOC);
        if(!empty($r1))
        {
  
        }
        echo' <tr>
              <td>
              <b>Firstname :</b>'.$row['firstname'].'<br/> 
              <b>Lastname :</b>'.$row['lastname'].'<br/>
              <b>Address :</b>'.$row['address'].'<br/> 
              <b>Contact :</b>'.$row['contact'].'<br/> 
              </td>

              <td>
              <b>Category :</b>'.$r1['categories'].'<br/> 
              <b>Product :</b>'.$r1['name'].'<br/> 
              <b>Quantity :</b>'.$row['quantity'].'<br/> 
              <b>Amount :</b>'.$row['amount'].'<br/> 
              <b>PayMode :</b>'.$row['paymode'].'<br/> 
              </td>
            </tr>
            <tr>
                <td colspan="2">
                <input type="submit" name="submit1" value="Cancel Order">
                </td>
                <input type="hidden" name="product_id" value="'.$product.'">
                <input type="hidden" name="qty" value="'.$row['quantity'].'">
                
            </tr>';}}
            if($flag1==0){
                foreach($a as $row1){ 
                echo' <tr>
                      <td>
                      <b>Firstname :</b>'.$row1['fname'].'<br/> 
                      <b>Lastname :</b>'.$row1['lname'].'<br/>
                      <b>Address :</b>'.$row1['address'].'<br/> 
                      <b>Contact :</b>'.$row1['contact'].'<br/> 
                      </td>';
                $c_array = explode (",", $row1['c_id']);
                $p_array = explode (",", $row1['p_id']); 
                $q_array = explode (",", $row1['quantity']);
                echo' <td>
                      <b>Category :</b>'; 
                 
                for($i=0 ; $i<count($c_array) ; $i++){ 
                $category=$c_array[$i];
                $sql="SELECT categories FROM categories WHERE id='$category'";
                $query=$dbhandler->query($sql);
                $r1=$query->fetch(PDO::FETCH_ASSOC);
                if(!empty($r1))
                {
          
                }
                echo $r1['categories'].', ';
                }
                
                echo'<br/><b>Product :</b>';
                
                for($i=0 ; $i<count($p_array) ; $i++){ 
                    $product=$p_array[$i];
                    $sql="SELECT * FROM product WHERE id='$product'";
                    $query=$dbhandler->query($sql);
                    $r1=$query->fetch(PDO::FETCH_ASSOC);
                    if(!empty($r1))
                    {
              
                    }
                    echo $r1['name'].', ';
                }
                
                echo'<br/><b>Quantity :</b>';
                
                for($i=0 ; $i<count($q_array) ; $i++){ 

                    echo $q_array[$i].', ';
                }
                      
                echo '<br/><b>Amount :</b>'.$row1['amount'].'<br/> 
                      <b>PayMode :</b>'.$row1['paymode'].'<br/> 
                      </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                        <input type="submit" name="submit" value="Cancel Order">
                        </td>
                        <input type="hidden" name="cart_pid" value="'.implode(',',$p_array).'">
                        
                        <input type="hidden" name="cart_qty" value="'.implode(',',$q_array).'">
                        
                    </tr>';}}
        ?>
        </tbody>
        </table>
        </form> 
        <?php } ?>   
        </div>

</div>
</body>

</html>