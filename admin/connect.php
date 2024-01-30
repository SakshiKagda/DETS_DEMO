<?php
	$conn=mysqli_connect("localhost","root","");
	if(! $conn)
	{
	  die("connection failed=".$conn->connect_error);
	}
	echo "connected successfully<br>";
    // $sql="create database expense_db";
	// if(mysqli_query($conn,$sql))
	// {
	//   echo "<br>database created successfully";
	// }
	// else
	// {
	// 	echo "error creating database=".mysqli_error($conn);
	// }
    $conn=mysqli_connect("localhost","root","","expense_db");   
    // $sqli="create table admin(admin_id INT(10) PRIMARY KEY,admin_name VARCHAR(45) NULL,username VARCHAR(45) NULL,password VARCHAR(120)  NULL,email VARCHAR(120)  NULL,mobile_num NUMERIC(11) NULL)";
	$sqli="CREATE TABLE users (
		id INT PRIMARY KEY AUTO_INCREMENT,
		username VARCHAR(255) NOT NULL,
		email VARCHAR(255) NOT NULL,
		password VARCHAR(255) NOT NULL,
		confirm_password VARCHAR(255) NOT NULL
	)";
	
	// $sqli="create table users(user_id INT(10) PRIMARY KEY,username VARCHAR(45) NULL,password VARCHAR(45) NULL, confirm password VARCHAR(45)  NULL,email VARCHAR(120)  NULL)";
if(mysqli_query($conn,$sqli))
{
echo "table created";
}
else
{
echo "error:".mysqli_error($conn);
}
mysqli_close($conn);	
?>