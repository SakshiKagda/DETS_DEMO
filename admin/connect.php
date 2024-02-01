<?php
    $conn=mysqli_connect("localhost","root","","expense_db") or die("connection failed".mysqli_error($conn)); 

$sqli="ALTER TABLE users
    ADD COLUMN reset_token VARCHAR(255),
    ADD COLUMN token_expiry TIMESTAMP,
    ADD COLUMN reset_status INT DEFAULT 0,
    ADD COLUMN hashed_reset_token VARCHAR(255)";

	

if(mysqli_query($conn,$sqli)>0)
{
echo "table created";
}
else
{
echo "error:".mysqli_error($conn);
}
	
?>