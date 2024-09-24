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
if (isset($_GET['ip_id'])) {
    $link = mysqli_connect('localhost', 'root', '', 'inpatient_record');
    if (!$link) {
        die('Connection error: ' . mysqli_connect_error());
    }

    $ip_id = $_GET['ip_id'];
    $query = "SELECT admit, discharge, rno, lno FROM inpatient WHERE ip_id='$ip_id'";
    $result = mysqli_query($link, $query);
    $numrow = mysqli_num_rows($result);

    if ($numrow == 1) {
        $row = mysqli_fetch_assoc($result);
        ?>
        <div class="form-container">
            <form action="ip_insert.php" method="post">
                <input type="hidden" name="ip_id" value="<?=$ip_id?>">
                DATE OF ADMIT:<input type="date" name="admit" value="<?=$row['admit']?>"><br>
                DATE OF DISCHARGE:<input type="date" name="discharge" value="<?=$row['discharge']?>"><br>
                ROOM NO:<input type="text" name="rno" value="<?=$row['rno']?>"><br>
                LAB NO:<input type="text" name="lno" value="<?=$row['lno']?>"><br>
                <input type="submit" name="submitval" value="Update">
            </form>
        </div>
        <?php
    } else {
        echo '<div class="error-message">Record not found</div>';
    }
} else {
    echo '<div class="error-message">ID does not exist</div>';
}
?>
</body>
</html>
