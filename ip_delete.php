<?php
if(isset($_GET['ip_id']))
{
$ip_id=$_GET['ip_id'];
$link=mysqli_connect('localhost','root','','inpatient_record');
if(!$link)
{
die('connection error'.myssqli_connect_error());
}
$query="DELETE FROM inpatient WHERE ip_id='$ip_id'";
$result=mysqli_query($link,$query);
if($result)
{
header('location:ip_display.php');
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