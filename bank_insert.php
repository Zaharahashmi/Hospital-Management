<?php
$link=mysqli_connect('localhost','root','','bank');
if(!$link)
{
die('connection error'.mysqli_connect_error());
}
if(isset($_POST['submitval']) && $_POST['submitval']=='submit')
{
    $cust_id=$_POST['cust_id'];
    $name=$_POST['name'];
    $address=$_POST['address'];
    $mobile_no=$_POST['mno'];
    $dob=$_POST['dob'];
    $age=$_POST['age'];
    $sql="insert into customer values('$cust_id','$name','$address','$mobile_no','$DOB','$age')";
    $res=mysqli_query($link,$sql);
    if($res)
    {
    header('location:bank_display.php');
    }
    else
    {
    echo "Record cannot be inserted";
    }
    }
    else if(isset($_POST['submitval']) && $_POST['submitval']=='update')
    {
        $ip_id=$_POST['ip_id'];
        $date_of_admit=$_POST['admit'];
        $date_of_discharge=$_POST['discharge'];
        $room_no=$_POST['rno'];
        $lab_no=$_POST['lno'];
    $query="UPDATE inpatient set
date_of_admit='$date_of_admit',date_of_discharge='$date_of_discharge',room_no='$room_no',lab_no='$lab_no' WHERE ip_id='$ip_id'";
    $result=mysqli_query($link,$query);
    if($result)
    {
    header('location:ip_display.php');
    }
    else{
    echo "error while updating record";
    }
}