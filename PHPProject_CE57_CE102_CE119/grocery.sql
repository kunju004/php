-- Database: `grocery`

-- Table structure for table `admins`

CREATE TABLE `admin_users` ( `id` INT NOT NULL AUTO_INCREMENT , `username` VARCHAR(255) NOT NULL , 
`password` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`));

-- Table structure for table `cart`

CREATE TABLE `cart` ( `id` INT NOT NULL AUTO_INCREMENT , `cat_id` INT NOT NULL ,
 `user_id` INT NOT NULL , `product_id` INT NOT NULL , `cart_qty` FLOAT NOT NULL , PRIMARY KEY (`id`));

-- Table structure for table `cart_orders`

CREATE TABLE `cart_orders` ( `id` INT NOT NULL AUTO_INCREMENT ,  `user_id` INT NOT NULL , 
 `c_id` VARCHAR(255) NOT NULL ,  `p_id` VARCHAR(255) NOT NULL ,  `quantity` VARCHAR(255) NOT NULL , `amount` VARCHAR(255) NOT NULL,
 `fname` VARCHAR(255) NOT NULL , `lname` VARCHAR(255) NOT NULL , `address` VARCHAR(255) NOT NULL ,
 `contact` VARCHAR(10) NOT NULL , `paymode` VARCHAR(255) NULL , `pay_status` TINYINT NOT NULL  , PRIMARY KEY (`id`));


-- Table structure for table `categories`

CREATE TABLE `categories` ( `id` INT NOT NULL AUTO_INCREMENT ,  `categories` VARCHAR(255) NOT NULL ,  
`status` TINYINT NOT NULL ,  PRIMARY KEY  (`id`)) ;

-- Table structure for table `customer`

CREATE TABLE `customer` ( `Id` INT NOT NULL AUTO_INCREMENT ,  
`FirstName` VARCHAR(255) NOT NULL ,  `LastName` VARCHAR(255) NOT NULL ,  `Email` VARCHAR(255) NOT NULL ,
`Password` VARCHAR(255) NOT NULL , `Gender` VARCHAR(255) NOT NULL , `Address` VARCHAR(255) NOT NULL ,
`City` VARCHAR(255) NOT NULL , `Contact` VARCHAR(10) NOT NULL , PRIMARY KEY  (`Id`)) ;

-- Table structure for table `orders`

CREATE TABLE `orders` ( `id` INT NOT NULL AUTO_INCREMENT ,  `email` VARCHAR(255) NOT NULL ,  
`product_id` INT NOT NULL ,  `category_id` INT NOT NULL ,  `quantity` VARCHAR(255) NOT NULL ,  `amount` FLOAT NOT NULL, 
`firstname` VARCHAR(255) NOT NULL , `lastname` VARCHAR(255) NOT NULL , `address` VARCHAR(255) NOT NULL , `contact` VARCHAR(10) NOT NULL ,
`paymode` VARCHAR(255)  NULL , `pay_status` TINYINT NOT NULL ,  PRIMARY KEY  (`id`)) ;


-- Table structure for table `product`

CREATE TABLE `product` ( `id` INT NOT NULL AUTO_INCREMENT ,  `categories_id` INT NOT NULL ,  
`name` VARCHAR(255) NOT NULL ,  `mrp` FLOAT NOT NULL ,  `price` FLOAT NOT NULL , `qty` VARCHAR(255) NOT NULL ,
`image` VARCHAR(255) NOT NULL, `status` TINYINT NOT NULL ,  PRIMARY KEY  (`id`)) ;