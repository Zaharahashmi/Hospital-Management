<?php
$link=mysqli_connect('localhost','root','','record');
if(!$link)
{
    die('connection error'.myssqli_connect_error());
}
if(isset($_POST['update']))
{
    $id=$_POST['d_id'];
    $name=$_POST['name'];
    $gender=$_POST['gender'];
    $years_of_experience=$_POST['yrs_of_exp'];
    $age=$_POST['age'];
    $specialization=$_POST['specialization'];       
    
    $query="UPDATE doctor_details set name='$name',gender='$gender',years_of_experience=$years_of_experience,age=$age,specialization='$specialization' WHERE id='$id'";
    $result=mysqli_query($link,$query);
    if($result)
    {
        header('location:display.php');
    }
    else{
        echo "error while updating record";
    }
}