<style>
     body
    {
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
<form method="POST">
    BILL_NO<input type="text" name="bill_no">
    <input type="submit" name="submitval" value="sub">
</form>
<?php
// Connect to the database
$link = mysqli_connect('localhost', 'root', '', 'billing');
if (!$link) {
    die('connection error' . mysqli_connect_error());
}

// Check if the form was submitted
if (isset($_POST['submitval']) && $_POST['submitval'] == 'sub') {
    $bill_no = $_POST['bill_no'];

    // Use the correct column name for the query
    $query = "SELECT * FROM ip_billing WHERE billno='$bill_no'";
    $result = mysqli_query($link, $query);

    // Check if the query returned any rows
    if (mysqli_num_rows($result) > 0) {
        // Display the data in a table
        echo '<table class="dbresult">';
        echo '<tr><th colspan="8"><a href="billing.html" style="color:white;">GO BACK</a></th></tr>';
        echo '<tr>';
        echo '<th>ip_id</th>';
        echo '<th>ip_name</th>';
        echo '<th>bill_no</th>';
        echo '<th>no_of_days</th>';
        echo '<th>room_rent</th>';
        echo '<th>medical_expenses</th>';
        echo '<th>lab_charges</th>';
        echo '</tr>';

        $total = 0; // Initialize total variable

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['ip_id'] . '</td>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td>' . $row['billno'] . '</td>';
            echo '<td>' . ($row['days'] ?? 0) . '</td>';
            echo '<td>' . ($row['roomrent'] ?? 0) . '</td>';
            echo '<td>' . ($row['medical'] ?? 0) . '</td>';
            echo '<td>' . ($row['lab'] ?? 0) . '</td>';
            echo '</tr>';

            // Calculate total bill in the loop
            $no_of_days = $row['days'] ?? 0;
            $room_rent = $row['roomrent'] ?? 0;
            $medical_expenses = $row['medical'] ?? 0;
            $lab_charges = $row['lab'] ?? 0;
            $total += ($no_of_days * $room_rent) + $medical_expenses + $lab_charges;
        }
        echo '</table>';

        // Display the total bill after the table
        echo "<hr>TOTAL BILL: $total<hr>";
    } else {
        echo "No results found!";
    }
}
?>

