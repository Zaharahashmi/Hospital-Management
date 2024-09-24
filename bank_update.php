<?php
if(isset($_GET['cust_id']))
{
?>
<?php
$link=mysqli_connect('localhost','root','','bank');
if(!$link)
{
die('connection error'.myssqli_connect_error());
}
$cust_id=$_GET['cust_id'];
$query="SELECT name,address,mobile no,dob,age FROM customer WHERE
cust_id='$cust_id'";
$result=mysqli_query($link,$query);
$numrow=mysqli_num_rows($result);
if($numrow==1)
{
$row=mysqli_fetch_assoc($result);
?>
<form action="bank_insert.php" method="post">
<input type="hidden" name="cust_id" value="<?=$cust_id?>">
NAME:<input type="text" name="name" value="<?=$row['name']?>"><br><br>
ADDRESS:<input type="text" name="address" value="<?=$row['address']?>"><br><br>
ADDRESS:<input type="text" name="mno" value="<?=$row['mobile no']?>"><br><br>
MOBILE NO:<input type="text" name="dob"
value="<?=$row['dob']?>"><br><br>
AGE:<input type="text" name="age"
value="<?=$row['age']?>"><br><br>
<input type="submit" name="submitval" value="update">
</form>
<?php }
else{
echo 'record not found';
}
}
else{
echo 'id does not exist';
}
?>