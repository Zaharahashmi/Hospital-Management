<?php
$link=mysqli_connect('localhost','root','','record');
if(!$link)
{
die('connection error'.mysqli_connect_error());
}
if(isset($_POST['submitval']) && $_POST['submitval']=='submit')
{
    $name=$_POST['name'];
    $d_id=$_POST['d_id'];
    $gender=$_POST['gender'];
    $yrs_of_exp=$_POST['yrs_of_exp'];
    $age=$_POST['age'];
    $specialization=$_POST['specialization'];
    $sql="insert into doctor_details values('$name','$d_id','$gender','$yrs_of_exp','$specialization','$age')";
    $res=mysqli_query($link,$sql);
    if($res)
    {
    header('location:display.php');
    }
    else
    {
    echo "Record cannot be inserted";
    }
    }
    else if(isset($_POST['submitval']) && $_POST['submitval']=='update')
    {
    $d_id=$_POST['d_id'];
    $name=$_POST['name'];
    $gender=$_POST['gender'];
    $yrs_of_exp=$_POST['yrs_of_exp'];
    $age=$_POST['age'];
    $specialization=$_POST['specialization'];
    $query="UPDATE doctor_details set name='$name',gender='$gender',yrs_of_exp=$yrs_of_exp,age=$age,specialization='$specialization' WHERE d_id='$d_id'";
    $result=mysqli_query($link,$query);
    if($result)
    {
    header('location:display.php');
    }
    else{
    echo "error while updating record";
    }
}