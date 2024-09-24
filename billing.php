<?php
$link=mysqli_connect('localhost','root','','billing');
if(!$link)
{
die('connection error'.mysqli_connect_error());
}
if(isset($_POST['submitval']) && $_POST['submitval']=='submit')
{
    $ip_id=$_POST['ip_id'];
    $ip_name=$_POST['name'];
    $bill_no=$_POST['billno'];
    $no_of_days=$_POST['days'];
    $room_rent=$_POST['roomrent'];
    $medical=$_POST['medical'];
    $lab=$_POST['lab'];
}
$total=0;
$total=($no_of_days*$room_rent)+$medical+$lab;



echo "<hr>TOTAL BILL:$total<hr>";
    ?>