<?php
// Start the session if not already started (optional, if you plan to use sessions)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Doctor Details</title>
    <style>
        body {
            background-image: url('hp.png');
            background-repeat: no-repeat;
            background-size: cover;
            font-family: Arial, sans-serif;
        }
        .form-container {
            background-color: rgba(255, 255, 255, 0.9); /* Light background with transparency */
            border-radius: 10px; /* Rounded corners */
            padding: 20px; /* Padding around form */
            max-width: 400px; /* Maximum width */
            margin: 50px auto; /* Center the form */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }
        .form-container input[type="text"], 
        .form-container input[type="number"] {
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
            transition: background-color 0.3s;
        }
        .form-container input[type="submit"]:hover {
            background-color: #003366;
        }
        .error-message {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
<?php
if(isset($_GET['id'])) {
    // Database connection
    $link = mysqli_connect('localhost', 'root', '', 'record');
    if(!$link) {
        die('Connection error: ' . mysqli_connect_error());
    }

    // Sanitize the input to prevent SQL injection
    $d_id = mysqli_real_escape_string($link, $_GET['id']);

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $link->prepare("SELECT name, gender, yrs_of_exp, specialization, age FROM doctor_details WHERE d_id = ?");
    if(!$stmt){
        die('Prepare failed: ' . mysqli_error($link));
    }

    // Bind the parameter
    $stmt->bind_param("s", $d_id);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if exactly one record is found
    if($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        ?>
        <div class="form-container">
            <h2>Update Doctor Details</h2>
            <form action="insert.php" method="post">
                <!-- Hidden input to pass the doctor ID -->
                <input type="hidden" name="d_id" value="<?= htmlspecialchars($d_id) ?>">

                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($row['name']) ?>" required>

                <label for="gender">Gender:</label>
                <input type="text" id="gender" name="gender" value="<?= htmlspecialchars($row['gender']) ?>" required>

                <label for="yrs_of_exp">Years of Experience:</label>
                <input type="number" id="yrs_of_exp" name="yrs_of_exp" value="<?= htmlspecialchars($row['yrs_of_exp']) ?>" min="0" required>

                <label for="age">Age:</label>
                <input type="number" id="age" name="age" value="<?= htmlspecialchars($row['age']) ?>" min="0" required>

                <label for="specialization">Specialization:</label>
                <input type="text" id="specialization" name="specialization" value="<?= htmlspecialchars($row['specialization']) ?>" required>

                <input type="submit" name="submitval" value="update">
            </form>
        </div>
        <?php
    } else {
        echo '<p class="error-message">Record not found.</p>';
    }

    // Close the statement and connection
    $stmt->close();
    mysqli_close($link);
} else {
    echo '<p class="error-message">No ID provided.</p>';
}
?>
</body>
</html>
