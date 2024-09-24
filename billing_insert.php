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
    $medical_expenses=$_POST['medical'];
    $lab_charges=$_POST['lab'];
    $sql="insert into ip_billing values('$ip_id','$ip_name','$bill_no','$no_of_days','$room_rent','$medical_expenses','$lab_charges')";
    $res=mysqli_query($link,$sql);
    if($res)
    {
        echo "record inserted";
    }
    else
    {
    echo "Record cannot be inserted";
    }
    }