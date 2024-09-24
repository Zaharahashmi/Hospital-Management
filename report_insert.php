<?php
$link=mysqli_connect('localhost','root','','reports_details');
if(!$link)
{
die('connection error'.myssqli_connect_error());
}
if(isset($_POST['submitval']) && $_POST['submitval']=='Submit')
{
$p_id=$_POST['p_id'];
$name=$_POST['name'];
$age=$_POST['age'];
$gender=$_POST['gender'];
$test_name=$_POST['tname'];
$result=$_POST['result'];
$sql="insert into report values('$p_id','$name','$age','$gender','$test_name','$result')";
$res=mysqli_query($link,$sql);
if($res)
{
header('location:report_display.php');
}
}
else if(isset($_POST['submitval']) && $_POST['submitval']=='update')
{
$p_id=$_POST['p_id'];
$name=$_POST['name'];
$age=$_POST['age'];
$gender=$_POST['gender'];
$test_name=$_POST['tname'];
$result=$_POST['result'];
$query="UPDATE report set name='$name',age=$age, gender='$gender',
test_name='$test_name',result='$result' WHERE p_id='$p_id'";
$result=mysqli_query($link,$query);
if($result)
{
header('location:report_display.php');
}
else{
echo "error while updating record";
}
}
