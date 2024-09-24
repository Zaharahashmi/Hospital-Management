<?php
$link=mysqli_connect('localhost','root','','inpatient_record');
if(!$link)
{
die('connection error'.mysqli_connect_error());
}
if(isset($_POST['submitval']) && $_POST['submitval']=='submit')
{
    $ip_id=$_POST['ip_id'];
    $admit=$_POST['admit'];
    $discharge=$_POST['discharge'];
    $rno=$_POST['rno'];
    $lno=$_POST['lno'];
    $sql="insert into inpatient values('$ip_id','$admit','$discharge','$rno','$lno')";
    $res=mysqli_query($link,$sql);
    if($res)
    {
    header('location:ip_display.php');
    }
    else
    {
    echo "Record cannot be inserted";
    }
    }
    else if(isset($_POST['submitval']) && $_POST['submitval']=='update')
    {
        $ip_id=$_POST['ip_id'];
        $admit=$_POST['admit'];
        $discharge=$_POST['discharge'];
        $room_no=$_POST['rno'];
        $lab_no=$_POST['lno'];
    $query="UPDATE inpatient set
admit='$admit',discharge='$discharge',rno='$rno',lno='$lno' WHERE ip_id='$ip_id'";
    $result=mysqli_query($link,$query);
    if($result)
    {
    header('location:ip_display.php');
    }
    else{
    echo "error while updating record";
    }
}