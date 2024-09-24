<?php
if(isset($_GET['cust_id']))
{
$cust_id=$_GET['cust_id'];
$link=mysqli_connect('localhost','root','','bank');
if(!$link)
{
die('connection error'.myssqli_connect_error());
}
$query="DELETE FROM customer WHERE cust_id='$cust_id'";
$result=mysqli_query($link,$query);
if($result)
{
header('location:bank_display.php');
}
else
{
echo 'error while deleting the record';
}
}
else
{
echo 'record cannot be deleted';
}