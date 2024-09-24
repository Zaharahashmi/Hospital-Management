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
// Database connection
$link = mysqli_connect('localhost', 'root', '', 'record');
if (!$link) {
    die('Connection error: ' . mysqli_connect_error());
}

// Fetching records from the database
$query = "SELECT * FROM doctor_details";
$result = mysqli_query($link, $query);
$numrow = mysqli_num_rows($result);

// Displaying the records if they exist
if ($numrow > 0) {
    echo '<table class="dbresult">';
    echo '<tr><th colspan="8"><a href="form.html" style="color: white;">GO BACK</a></th></tr>';
    echo '<tr>';
    echo '<th>DELETE</th>';
    echo '<th>UPDATE</th>';
    echo '<th>NAME</th>';
    echo '<th>ID</th>';
    echo '<th>GENDER</th>';
    echo '<th>Years_of_Experience</th>';
    echo '<th>AGE</th>';
    echo '<th>Specialization</th>';
    echo '</tr>';
    
    // Loop through the records and display them in the table
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['d_id'];  // Use $id for links
        echo '<tr>';
        echo '<td><a href="delete.php?id=' . $id . '">delete</a></td>';
        echo '<td><a href="update.php?id=' . $id . '">update</a></td>';
        echo '<td>' . htmlspecialchars($row['name']) . '</td>';
        echo '<td>' . htmlspecialchars($row['d_id']) . '</td>';
        echo '<td>' . htmlspecialchars($row['gender']) . '</td>';
        echo '<td>' . htmlspecialchars($row['yrs_of_exp']) . '</td>';
        echo '<td>' . htmlspecialchars($row['age']) . '</td>';
        echo '<td>' . htmlspecialchars($row['specialization']) . '</td>';
        echo '</tr>';
    }
    
    echo '</table>';
} else {
    echo 'Record not found';
}
?>
