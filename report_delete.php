<?php
if(isset($_GET['p_id']))
{
$p_id=$_GET['p_id'];
$link=mysqli_connect('localhost','root','','reports_details');
if(!$link)
{
die('connection error'.myssqli_connect_error());
}
$query="DELETE FROM report WHERE p_id='$p_id'";
$result=mysqli_query($link,$query);
if($result)
{
header('location:report_display.php');
}
else
{
echo 'Error while deleting the record';
}
}
else
{
echo 'Record cannot be deleted';
}