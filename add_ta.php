<!-- This file creates the interface to add a TA on to the database -->
<?php
include 'db_connect.php'; // Ensure this path is correct

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $tauserid = $connection->real_escape_string($_POST['tauserid']);
    $firstname = $connection->real_escape_string($_POST['firstname']);
    $lastname = $connection->real_escape_string($_POST['lastname']);
    $studentnum = $connection->real_escape_string($_POST['studentnum']);
    $degreetype = $connection->real_escape_string($_POST['degreetype']);

    // Attempt to insert the new TA into the database
    $sql = "INSERT INTO ta (tauserid, firstname, lastname, studentnum, degreetype) VALUES ('$tauserid', '$firstname', '$lastname', '$studentnum', '$degreetype')";

    if ($connection->query($sql) === TRUE) {
        echo "<script>alert('New TA added successfully');</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Teaching Assistant</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            max-width: 600px;
            margin: 30px auto;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input, select {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        label {
            margin-bottom: 5px;
        }
        .button {
            background-color: #0a9396;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
        }
        .button:hover {
            background-color: #94d2bd;
        }
        .header {
            background-color: #005f73;
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
	.back-button {
            background-color: #0a9396;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-bottom: 20px;
        }
        .back-button:hover {
            background-color: #94d2bd;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Add New Teaching Assistant</h2>
        </div>
	<!-- Back to Home button -->
        <a href="mainmenu.php" class="back-button">Back to Home</a>
        <form method="post" action="add_ta.php">
            <label for="tauserid">TA User ID:</label>
            <input type="text" id="tauserid" name="tauserid" required>

            <label for="firstname">First Name:</label>
            <input type="text" id="firstname" name="firstname" required>

            <label for="lastname">Last Name:</label>
            <input type="text" id="lastname" name="lastname" required>

            <label for="studentnum">Student Number:</label>
            <input type="text" id="studentnum" name="studentnum" required>

            <label for="degreetype">Degree Type:</label>
            <select id="degreetype" name="degreetype" required>
                <option value="Masters">Masters</option>
                <option value="PhD">PhD</option>
            </select>

            <input type="submit" value="Add TA" class="button">
        </form>
    </div>
</body>
</html>
