<?php
session_start();
$con=mysqli_connect('localhost','root','','encyclopedia');
//$db=mysqli_select_db($con,"sms");
if ($con->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>