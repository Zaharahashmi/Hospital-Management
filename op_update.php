<style>
    body {
    background-image: url('hp.png');
    background-repeat: no-repeat;
    background-size: cover;
    font-family: Arial, sans-serif;
    color: #333;
}

form {
    background-color: rgba(255, 255, 255, 0.9); /* Light background with transparency */
    border-radius: 10px; /* Rounded corners */
    padding: 20px; /* Padding around form */
    max-width: 400px; /* Maximum width */
    margin: 50px auto; /* Center the form */
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); /* Shadow for depth */
}

input[type="text"],
input[type="datetime-local"] {
    width: 100%; /* Full width */
    height: 40px; /* Height of the input */
    margin: 10px 0; /* Margin for spacing */
    padding: 10px; /* Inner padding */
    border: 1px solid #001F3F; /* Navy border */
    border-radius: 5px; /* Rounded corners */
    font-size: 16px; /* Font size */
}

input[type="submit"] {
    background-color: #001F3F; /* Navy background */
    color: white; /* White text */
    border: none; /* No border */
    border-radius: 5px; /* Rounded corners */
    padding: 10px 15px; /* Padding */
    font-size: 18px; /* Font size */
    cursor: pointer; /* Pointer cursor */
    transition: background-color 0.3s; /* Transition effect */
}

input[type="submit"]:hover {
    background-color: #003366; /* Darker navy on hover */
}

/* Responsive adjustments */
@media (max-width: 600px) {
    form {
        width: 90%; /* Full width on smaller screens */
    }
}

</style>
<?php
if(isset($_GET['op_id']))
{
?>
<?php
$link=mysqli_connect('localhost','root','','outpatient_record');
if(!$link)
{
die('connection error'.myssqli_connect_error());
}
$op_id=$_GET['op_id'];
$query="SELECT name,date_time,age,gender FROM outpatient WHERE
op_id='$op_id'";
$result=mysqli_query($link,$query);
$numrow=mysqli_num_rows($result);
if($numrow==1)
{
$row=mysqli_fetch_assoc($result);
?>
<form action="op_insert.php" method="post">
<input type="hidden" name="op_id" value="<?=$op_id?>">
NAME:<input type="text" name="name" value="<?=$row['name']?>"><br><br>
DATETIME:<input type="datetime-local" name="date_time" value="<?=$row['date_time']?>"><br><br>
AGE:<input type="text" name="age" value="<?=$row['age']?>"><br><br>
GENDER:<input type="text" name="gender" value="<?=$row['gender']?>"><br><br>
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