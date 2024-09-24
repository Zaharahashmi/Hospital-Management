<?php
if(isset($_GET['op_id']))
{
$op_id=$_GET['op_id'];
$link=mysqli_connect('localhost','root','','outpatient_record');
if(!$link)
{
die('connection error'.myssqli_connect_error());
}
$query="DELETE FROM outpatient WHERE op_id='$op_id'";
$result=mysqli_query($link,$query);
if($result)
{
header('location:op_display.php');
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