<?php
session_start();
 require_once "connection.php";
//  require_once 'url_restriction.php'; 
 $id=$_GET['id'];

 $sql="SELECT * FROM product WHERE id='$id' AND status='1' ";
 $query=$dbhandler->query($sql);
 $r=$query->fetch(PDO::FETCH_ASSOC);
 if(!empty($r))
    {
        $price=$r['price'];
        $amount=($_SESSION['QUANTITY'] * $price);
    }
 else{
     $amount=$_SESSION['CART_AMOUNT'];
 }

 if(isset($_POST['submit']))
    {
        if($id==-1)
        {
           $user_id=$_SESSION['USER_ID'];
           $amount=$_SESSION['CART_AMOUNT'];
           $quantity=implode(',',$_SESSION['CART_QUANTITY']);
           $sql="SELECT * FROM cart_orders WHERE user_id='$user_id' AND amount='$amount' AND quantity='$quantity'";
           $query=$dbhandler->query($sql);
           $r=$query->fetch(PDO::FETCH_ASSOC);
           if(!empty($r)){
               $p=1;
               $paymode="Credit/Debit Card";
               $sql2="UPDATE cart_orders SET  paymode= ? WHERE user_id='$user_id' AND amount='$amount' AND quantity='$quantity'";
               $dbhandler->prepare($sql2)->execute([$paymode]);
               
               $sql2="UPDATE cart_orders SET  pay_status= ? WHERE user_id='$user_id' AND amount='$amount' AND quantity='$quantity'";
               $dbhandler->prepare($sql2)->execute([$p]);
        
               $p_array = explode (",", $r['p_id']); 
               $q_array = explode (",", $r['quantity']);
               for($i=0 ; $i<count($p_array) ; $i++)
               {
                   $p=$p_array[$i];
                   $q=$q_array[$i];
                   
                   $sql="SELECT * FROM product WHERE id='$p' AND status='1' ";
                   $query=$dbhandler->query($sql);
                   $a=$query->fetch(PDO::FETCH_ASSOC);
                   $qty1=$a['qty']-$q;
                   
                   $sql1="UPDATE product SET  qty= ? WHERE id='$p' AND status='1' ";
                   $dbhandler->prepare($sql1)->execute([$qty1]);
                   if($a['qty']==0)
                   {
                   $s=0;
                   $sql="UPDATE product SET  status= ? WHERE id='$p'";
                   $dbhandler->prepare($sql)->execute([$s]);
                   }
               }
               
           }
           header("Location: ./payment_confirmed.php?id=-1");
        }
        else{
                $p=1;
                $email=$_SESSION['USER_EMAIL'];
                $paymode="Credit/Debit Card";
                $quantity=$_SESSION['QUANTITY'];
                $sql2="UPDATE orders SET  paymode= ? WHERE product_id='$id' AND email='$email' AND quantity='$quantity' ";
                $dbhandler->prepare($sql2)->execute([$paymode]);
                
                $sql2="UPDATE orders SET  pay_status= ? WHERE product_id='$id' AND email='$email' AND quantity='$quantity' ";
                $dbhandler->prepare($sql2)->execute([$p]);
                
                $Squantity=$r['qty']-$_SESSION['QUANTITY'];
                $sql1="UPDATE product SET  qty= ? WHERE id='$id' AND status='1' ";
                $dbhandler->prepare($sql1)->execute([$Squantity]);
                
                if($r['qty']==0)
                {
                    $a=0;
                    $sql="UPDATE product SET  status= ? WHERE id='$id'";
                    $dbhandler->prepare($sql)->execute([$a]);
                }
                header("Location: ./payment_confirmed.php?id=".$r['id']."");
            }
            
}
 ?>

 
 <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>payment</title>
</head>

<body>
    <link rel="stylesheet" type="text/css" href="../css/style_card.css" />
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
            <h1>Credit/Debit Card Payment</h1>
        </div>
        <div class="content">
        <form action="" method="post">
                <h1>Amount :<?php echo $amount; ?></h1>
                <h2>Enter Details</h2>
                <br>
                <input type="text" name="name_on_card" placeholder="Enter Name On Card" maxlength="25" /required>
                <br><br/>
                <input type="text" name="card_number" placeholder="Enter Card-Number" maxlength="25" /required>
                <br><br/>
                <input type="text"  name="expiry"  onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="Enter Expiry-Date"/required>
                <br><br/>
                <input type="text" name="cvv" placeholder="Enter CVV" maxlength="5" /required>
                <br>
                <button name="submit">Submit</button>
                <div class="cancel">
                    <p>
                     <?php if($id==-1){
                         echo'<p>
                        <a href="../customer/categories.php?id=0">Cancel</a>&emsp;&emsp;&emsp;&emsp;
                        <a href="../customer/payment.php?id=-1">Back</a></p>';
                        }else{
                        echo'<p> <a href="../customer/categories.php?id='.$r['id'].'">Cancel</a>&emsp;&emsp;&emsp;&emsp;
                        <a href="../customer/payment.php?id='.$r['id'].'">Back</a></p>';
                        }
                        ?>
                </div>
            </form>
            
        </div>

</div>
</body>

</html>