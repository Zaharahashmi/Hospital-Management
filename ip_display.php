<style>
     body {
    background-image: url('hp.png');
    background-repeat: no-repeat;
    background-size: cover;
    font-family: Arial, sans-serif;
    color: #333;
}

.dbresult {
    width: 80%; /* Make the table responsive */
    max-width: 800px; /* Limit max width */
    margin: 20px auto;
    border-radius: 10px; /* Rounded corners */
    overflow: hidden; /* Clip inner elements */
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); /* Shadow for depth */
}

.dbresult th, .dbresult td {
    border: 1px solid #001F3F; /* Navy blue border color */
    padding: 12px; /* Increased padding */
    text-align: left; /* Left-align text */
}

.dbresult th {
    background-color: #001F3F; /* Header background color */
    color: white; /* Header text color */
}

.dbresult tr:nth-child(odd) {
    background-color: #e6f2ff; /* Light blue for odd rows */
}

.dbresult tr:nth-child(even) {
    background-color: #f2f9ff; /* Lighter blue for even rows */
}

.dbresult tr:hover {
    background-color: #99ccff; /* Highlight row on hover */
}

.dbresult a {
    color: #001F3F; /* Navy blue link color */
    text-decoration: none; /* Remove underline */
}

.dbresult a:hover {
    text-decoration: underline; /* Underline on hover */
}
</style>
<?php
$link=mysqli_connect('localhost','root','','inpatient_record');
if(!$link)
{
die('connection error'.myssqli_connect_error());
}
$query="SELECT * FROM inpatient";
$result=mysqli_query($link,$query);
$numrow=mysqli_num_rows($result);
if($numrow>0)
{
echo '<table class="dbresult">';
echo '<tr>><th colspan="7"><a href="ip_form.html" style="color:white;">GO BACK</a></th></tr>';
echo '<tr>';
echo '<th>DELETE</th>';
echo '<th>UPDATE</th>';
echo '<th>IP_ID</th>';
echo '<th>Date_of_Admit</th>';
echo '<th>Date_of_Discharge</th>';
echo '<th>Room_no</th>';
echo '<th>Lab_no</th>';
echo '</tr>';
while($row=mysqli_fetch_assoc($result))
{
$ip_id=$row['ip_id'];
echo '<tr>';
echo '<td><a href="ip_delete.php?ip_id='.$ip_id.'" >delete</a></td>';
echo '<td><a href="ip_update.php?ip_id='.$ip_id.'">update</a></td>';
echo '<td>' . $row['ip_id'] . '</td>';
echo '<td>' . $row['admit'] . '</td>';
echo '<td>' . $row['discharge'] . '</td>';
echo '<td>' .$row['rno'] . '</td>';
echo '<td>' . $row['lno'] . '</td>';
echo '</tr>';
}
echo '</table>';
}
else{
echo 'record not found';
}