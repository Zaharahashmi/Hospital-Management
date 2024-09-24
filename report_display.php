<style>
     body
    {
        background-image: url('hp.png');
        background-repeat: no-repeat;
        background-size: cover;
        font-family: Arial, sans-serif;
        color: #333;
    }
    .result {
    width: 80%; /* Make the table responsive */
    max-width: 800px; /* Limit max width */
    margin: 20px auto;
    border-radius: 10px; /* Rounded corners */
    overflow: hidden; /* Clip inner elements */
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); /* Shadow for depth */
}

.result th, .result td {
    border: 1px solid #001F3F; /* Navy blue border color */
    padding: 12px; /* Increased padding */
    text-align: left; /* Left-align text */
}

.result th {
    background-color: #001F3F; /* Header background color */
    color: white; /* Header text color */
}

.result tr:nth-child(odd) {
    background-color: #e6f2ff; /* Light blue for odd rows */
}

.result tr:nth-child(even) {
    background-color: #f2f9ff; /* Lighter blue for even rows */
}

.result tr:hover {
 background-color: #99ccff; /* Highlight row on hover */
}

.result a {
    color: #001F3F; /* Navy blue link color */
    text-decoration: none; /* Remove underline */
}

.result a:hover {
    text-decoration: underline; /* Underline on hover */
}
</style>
<?php
$link=mysqli_connect('localhost','root','','reports_details');
if(!$link)
{
die('connection error'.myssqli_connect_error());
}
$query="SELECT * FROM report";
$result=mysqli_query($link,$query);
$numrow=mysqli_num_rows($result);
if($numrow>0)
{
echo '<table class="result">';
echo '<tr><th colspan="8"><a href="report.html" style="color:white;">Go Back</a></th></tr>';
echo '<tr>';
echo '<th>Delete</th>';
echo '<th>Update</th>';
echo '<th>Patient ID</th>';
echo '<th>Name</th>';
echo '<th>Age</th>';
echo '<th>Gender</th>';
echo '<th>Test_Name</th>';
echo '<th>Results</th>';
echo '</tr>';
while($row=mysqli_fetch_assoc($result))
{
$p_id=$row['p_id'];
echo '<tr>';
echo '<td><a href="report_delete.php?p_id='.$p_id.'" >Delete</a></td>';
echo '<td><a href="report_update.php?p_id='.$p_id.'">Update</a></td>';
echo '<td>'.$row['p_id'].'</td>';
echo '<td>'.$row['name'].'</td>';
echo '<td>'.$row['age'].'</td>';
echo '<td>'.$row['gender'].'</td>';
echo '<td>'.$row['tname'].'</td>';
echo '<td>'.$row['result'].'</td>';
echo '</tr>';
}
echo '</table>';
}
else{
echo 'Record not found';
}