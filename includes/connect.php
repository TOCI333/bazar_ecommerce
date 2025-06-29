<?php 
// $con=mysqli_connect('localhost','root','','ecommerce_1');
$con = new mysqli('localhost','root','','bazar');
if(!$con){
    die(mysqli_error($con));
}
?>