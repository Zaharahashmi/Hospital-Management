<?php
// Start the session if not already started (optional)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Report Details</title>
    <style>
        body {
            background-image: url('hp.png');
            background-repeat: no-repeat;
            background-size: cover;
            font-family: Arial, sans-serif;
            color: #333;
        }
        .form-container {
            background-color: rgba(255, 255, 255, 0.9); /* Light background with transparency */
            border-radius: 10px; /* Rounded corners */
            padding: 20px; /* Padding around form */
            max-width: 400px; /* Maximum width */
            margin: 50px auto; /* Center the form */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); /* Shadow for depth */
        }
        .form-container input[type="text"], 
        .form-container input[type="number"],
        .form-container input[type="date"] {
            width: 95%; /* Full width */
            height: 30px; /* Height of the input */
            margin: 10px 0; /* Margin for spacing */
            padding: 10px; /* Inner padding */
            border: 1px solid #001F3F; /* Navy border */
            border-radius: 5px; /* Rounded corners */
            font-size: 16px; /* Font size */
        }
        .form-container input[type="submit"] {
            background-color: #001F3F; /* Navy background */
            color: white; /* White text */
            border: none; /* No border */
            border-radius: 5px; /* Rounded corners */
            padding: 10px 15px; /* Padding */
            font-size: 18px; /* Font size */
            cursor: pointer; /* Pointer cursor */
            transition: background-color 0.3s; /* Transition effect */
        }
        .form-container input[type="submit"]:hover {
            background-color: #003366; /* Darker navy on hover */
        }
        .error-message {
            color: red;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>
<?php
if(isset($_GET['p_id'])) {
    // Database connection
    $link = mysqli_connect('localhost', 'root', '', 'reports_details');
    if(!$link) {
        die('Connection error: ' . mysqli_connect_error());
    }

    // Sanitize the input to prevent SQL injection
    $p_id = mysqli_real_escape_string($link, $_GET['p_id']);

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $link->prepare("SELECT name, age, gender, tname, result FROM report WHERE p_id = ?");
    if(!$stmt){
        die('Prepare failed: ' . mysqli_error($link));
    }

    // Bind the parameter
    $stmt->bind_param("s", $p_id);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if exactly one record is found
    if($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        ?>
        <div class="form-container">
            <form action="report_insert.php" method="post">
                <!-- Hidden input to pass the patient ID -->
                <input type="hidden" name="p_id" value="<?= htmlspecialchars($p_id) ?>">

                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($row['name']) ?>" required><br><br>

                <label for="age">Age:</label>
                <input type="number" id="age" name="age" value="<?= htmlspecialchars($row['age']) ?>" min="0" required><br><br>

                <label for="gender">Gender:</label>
                <input type="text" id="gender" name="gender" value="<?= htmlspecialchars($row['gender']) ?>" required><br><br>

                <label for="tname">Test Name:</label>
                <input type="text" id="tname" name="tname" value="<?= htmlspecialchars($row['tname']) ?>" required><br><br>

                <label for="result">Result:</label>
                <input type="text" id="result" name="result" value="<?= htmlspecialchars($row['result']) ?>" required><br><br>

                <input type="submit" name="submitval" value="Update">
            </form>
        </div>
        <?php
    }
    else{
        echo '<div class="error-message">Record not found.</div>';
    }

    // Close the statement and connection
    $stmt->close();
    mysqli_close($link);
}
else{
    echo '<div class="error-message">ID does not exist.</div>';
}
?>
</body>
</html>
