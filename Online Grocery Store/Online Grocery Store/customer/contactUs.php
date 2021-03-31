<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>contactUs</title>
</head>

<body>
    <link rel="stylesheet" type="text/css" href="../css/style_contact.css" />
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
            <h1>How can we help you ?</h1>
        </div>
        <div class="content">
    
    <form action = "" method = "POST">
        <?php
            if(isset($_POST['submit']))
            {
                echo '<center><h3>Your query has been considered ! We will get to you by email soon !!</h3></center><br/>';
            }
            else{
                echo '<center><h3>If you have a question about our service or have an issue to report , please send a request and we 
                will get back to you as soon as possible.</h3></center><br/>';
            }
    ?>
     <table border = "1" bordercolor="white"style="width:90%;margin-left:auto;margin-right:auto;">
    <tr>
        <td>Email: </td><td><input type = "email" name = "email" placeholder="Enter your email" required></td>
    </tr>
    <tr>
        <td>Subject: </td><td><input type = "text" name ="sub" placeholder="Enter subject"required></td>
    </tr>
    <tr>
        <td>Message: </td><td><textarea name = "msg" rows="2" cols="30" placeholder="Enter your query"></textarea></td>
    </tr>
    <tr>
        <td colspan="2"><input type = "submit" name = "submit"> </td>
        
    </tr>
    </table>
    </form>
        </div>

</div>
</body>

</html>


















