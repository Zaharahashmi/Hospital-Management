<?php
$link=mysqli_connect('localhost','root','','outpatient_record');
if(!$link)
{
die('connection error'.mysqli_connect_error());
}
if(isset($_POST['submitval']) && $_POST['submitval']=='submit')
{
    $name=$_POST['name'];
    $op_id=$_POST['op_id'];
    $date_time=$_POST['date_time'];
    $age=$_POST['age'];
    $gender=$_POST['gender'];
    $sql="insert into outpatient values('$name','$op_id','$date_time','$age','$gender')";
    $res=mysqli_query($link,$sql);
    if($res)
    {
    header('location:op_display.php');
    }
    else
    { 
    echo "Record cannot be inserted";
    }
    }
    else if(isset($_POST['submitval']) && $_POST['submitval']=='update')
    {
    $op_id=$_POST['op_id'];
    $name=$_POST['name'];
    $date_time=$_POST['date_time'];
    $age=$_POST['age'];
    $gender=$_POST['gender'];
    $query="UPDATE outpatient set
    name='$name',date_time='$date_time',age=$age,gender='$gender' WHERE op_id='$op_id'";
    $result=mysqli_query($link,$query);
    if($result)
    {
    header('location:op_display.php');
    }
    else{
    echo "error while updating record";
    }
}