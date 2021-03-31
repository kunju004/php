<?php
if(isset($_POST['submit']))
{   require_once "connection.php"; 
    $passwd=$_POST['passwd'];
    $Cpasswd=$_POST['Cpasswd'];
    if($passwd != $Cpasswd)
    {
        echo 'Password and Confirm Password must match';
        die();
    }
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $email=$_POST['email'];
    
    $gender=$_POST['gender'];
    $city=$_POST['city'];
    $contact=$_POST['contact'];
    $sql="INSERT INTO customer (Firstname,Lastname,Email,Password,Gender,City,Contact)
          VALUES ('$fname','$lname','$email','$passwd','$gender','$city','$contact')";
    $query=$dbhandler->query($sql);
    $_SESSION['USER_REGISTER']='yes';
	$_SESSION['USER_EMAIL']=$email;
    header("Location: ./welcome.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>register</title>
</head>

<body>
    <link rel="stylesheet" type="text/css" href="../css/style_register.css" />
    <div class="message">
    <p>
        <?php
        if(isset($_SESSION['MESSAGE']) && $_SESSION['MESSAGE'] != '')
          {
             print_r($_SESSION['MESSAGE']);
          }
        ?>
    </p>
    <form class="register" action="" method="POST"> 
        <center><h1>New User</h1></center>

        <input type="text" name="fname" placeholder="Enter FirstName"/required>
        <input type="text" name="lname" placeholder="Enter LastName"/required>
        <input type="email" name="email" placeholder="Enter Email"/required>
        <input type="password" name="passwd" placeholder="Enter Password" maxlength="6"/required>
        <input type="password" name="Cpasswd" placeholder="Confirm Password" maxlength="6"/required>
        <p>
        <input type="radio" name="gender" value="Male" /required>
                <label for="Male">Male</label>
                <input type="radio" name="gender" value="Female">
                <label for="Female">Female</label>
                <input type="radio" name="gender" value="Other">
                <label for="Other">Other</label>
            </p>
        <textarea name="address" placeholder="Enter Your Address"></textarea> 
        <input type="text" name="city" placeholder="Enter Your City"/required>
        <input type="text" name="contact" placeholder="Enter ContactNo" maxlength="10"/required>      
        
        <button name="submit">SignUp</button>
    </form>
</body>

</html>