<?php 
require_once 'url_restriction.php';
?>
<html>
<head>
    <title>Home</title>
    <style>
        .main a{
    width: 15%;
    height: 30px;
    background-color:white;
    border-radius: 5px;
    margin: 15px 0;
    font-size: 1.5em;
    font-weight: 700;
    letter-spacing: 2px;
    color: #303e5c;
    box-shadow: 0 10px 20px #303e5c69 ;
    cursor: pointer;
    float: left;
    text-decoration: none;
    margin-top: 15%;
    margin-left: 3.5%; 
    margin-right: 1%; 
    text-align: center;
    font-family: Verdana;
    padding-top: 2%;
    padding-bottom: 2%;   
    }
    a:hover{
    background-color: #fff;
    color:blue;
    }
    h1{
        font-family: Verdana;
        font-size: 1.5em;
        font-weight: 700;
        letter-spacing: 2px;
        color: #303e5c;
        margin-top: 8%;
    }

    </style>

</head>
<body bgcolor = "lightblue">
    <center><h1>Welcome !!</h1></center>
<div class = "main">
    <a href="categories.php">Categories</a>
    <a href="product.php">Products</a>
    <a href="displayOrders.php">Orders</a>
    <a href="customer.php">Customers</a>
    <a href="logout.php">Logout</a>

</div>

</body>
</html>

