<style>
.dbresult,.dbresult td,.dbresult th{
border:1px solid black;
border-collapse:collapse;
padding:8px;
}
.dbresult
{
width:500px;
margin:auto;
}
.dbresult tr:nth-child(odd)
{
background-color:white;
}
.dbresult tr:nth-child(even)
{
background-color:lightcyan;
}
</style>
<?php
$link=mysqli_connect('localhost','root','','bank');
if(!$link)
{
die('connection error'.myssqli_connect_error());
}
$query="SELECT * FROM customer";
$result=mysqli_query($link,$query);
$numrow=mysqli_num_rows($result);
if($numrow>0)
{
echo '<table class="dbresult">';
echo '<tr>><th colspan="7"><a href="bank.html">GO BACK</a></th></tr>';
echo '<tr>';
echo '<th>delete</th>';
echo '<th>update</th>';
echo '<th>cust_id</th>';
echo '<th>name</th>';
echo '<th>address</th>';
echo '<th>mobile_no</th>';
echo '<th>dob</th>';
echo '<th>age</th>';
echo '</tr>';
while($row=mysqli_fetch_assoc($result))
{
$cust_id=$row['cust_id'];
echo '<tr>';
echo '<td><a href="bank_delete.php?cust_id='.$cust_id.'" >delete</a></td>';
echo '<td><a href="bank_update.php?cust_id='.$cust_id.'">update</a></td>';
echo '<td>' . $row['cust_id'] . '</td>';
echo '<td>' . $row['name'] . '</td>';
echo '<td>' . $row['address'] . '</td>';
echo '<td>' .$row['mobile no'] . '</td>';
echo '<td>' . $row['DOB'] . '</td>';
echo '<td>' . $row['age'] . '</td>';
echo '</tr>';
}
echo '</table>';
}
else{
echo 'record not found';
}