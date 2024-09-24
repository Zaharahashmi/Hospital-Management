<?php
// Start the session if not already started (optional, if you plan to use sessions)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Doctor Record</title>
    <style>
        body {
            background-image: url('hp.png');
            background-repeat: no-repeat;
            background-size: cover;
            font-family: Arial, sans-serif;
        }
        .message {
            width: 500px;
            margin: 100px auto;
            padding: 20px;
            background-color: rgba(255,255,255,0.9);
            border: 1px solid #ccc;
            border-radius: 8px;
            text-align: center;
        }
        .error {
            color: red;
        }
        .success {
            color: green;
        }
        a.button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        a.button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<?php
if (isset($_GET['id'])) {
    // Retrieve the 'id' from GET parameters
    $id = $_GET['id'];

    // Database connection
    $link = mysqli_connect('localhost', 'root', '', 'record');
    if (!$link) {
        // Log the error instead of displaying it to the user
        error_log('Connection error: ' . mysqli_connect_error());
        echo '<div class="message error">An unexpected error occurred. Please try again later.</div>';
        exit;
    }

    // Prepare the DELETE statement to prevent SQL injection
    $stmt = $link->prepare("DELETE FROM doctor_details WHERE d_id = ?");
    if (!$stmt) {
        // Log the error
        error_log('Prepare failed: ' . mysqli_error($link));
        echo '<div class="message error">An unexpected error occurred. Please try again later.</div>';
        mysqli_close($link);
        exit;
    }

    // Bind the parameter
    $stmt->bind_param("s", $id);

    // Execute the statement
    if ($stmt->execute()) {
        // Check if a row was actually deleted
        if ($stmt->affected_rows > 0) {
            // Success: Redirect to display.php with a success message
            header('Location: display.php?message=deleted');
            exit;
        } else {
            // No rows affected: ID not found
            echo '<div class="message error">No record found with the provided ID.</div>';
        }
    } else {
        // Log the error
        error_log('Execute failed: ' . $stmt->error);
        echo '<div class="message error">Error while deleting the record. Please try again.</div>';
    }

    // Close the statement and connection
    $stmt->close();
    mysqli_close($link);
} else {
    echo '<div class="message error">No ID provided. Record cannot be deleted.</div>';
}
?>
    <a href="display.php" class="button">Go Back</a>
</body>
</html>
