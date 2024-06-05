<!-- This file creates an interface that allows the user to edit the attributes of a TA -->
<?php
include 'db_connect.php'; // Ensure this path is correct

$message = '';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tauserid'])) {
    // Collect and sanitize input data
    $tauserid = $conn->real_escape_string($_POST['tauserid']);
    $firstname = $conn->real_escape_string($_POST['firstname']);
    $lastname = $conn->real_escape_string($_POST['lastname']);
    $studentnum = $conn->real_escape_string($_POST['studentnum']);
    $degreetype = $conn->real_escape_string($_POST['degreetype']);

    // Update the TA's information in the database
    $sql = "UPDATE ta SET firstname = '$firstname', lastname = '$lastname', studentnum = '$studentnum', degreetype = '$degreetype' WHERE tauserid = '$tauserid'";

    if ($conn->query($sql) === TRUE) {
        $message = "TA updated successfully.";
    } else {
        $message = "Error updating TA: " . $conn->error;
    }
}

// Get the TA's current information to prefill the form
$taInfo = null;
if (isset($_GET['tauserid'])) {
    $tauserid = $conn->real_escape_string($_GET['tauserid']);
    $sql = "SELECT * FROM ta WHERE tauserid = '$tauserid'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $taInfo = $result->fetch_assoc();
    } else {
        $message = "TA not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Teaching Assistant</title>
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
        .message {
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 5px;
            color: #155724;
            background-color: #d4edda;
        }
        .button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 10px;
        }
        .button:hover {
            background-color: #0069d9;
        }
        .header {
            background-color: #005f73;
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        form {
            margin-top: 20px;
        }
        input, select {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            width: 100%;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Edit Teaching Assistant</h2>
        </div>
        <?php if ($message): ?>
            <div class="message">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        <?php if ($taInfo): ?>
            <form method="post" action="edit_ta.php">
                <input type="hidden" name="tauserid" value="<?php echo htmlspecialchars($taInfo['tauserid']); ?>">

                <label for="firstname">First Name:</label>
                <input type="text" id="firstname" name="firstname" value="<?php echo htmlspecialchars($taInfo['firstname']); ?>" required>

                <label for="lastname">Last Name:</label>
                <input type="text" id="lastname" name="lastname" value="<?php echo htmlspecialchars($taInfo['lastname']); ?>" required>

                <label for="studentnum">Student Number:</label>
                <input type="text" id="studentnum" name="studentnum" value="<?php echo htmlspecialchars($taInfo['studentnum']); ?>" required>

                <label for="degreetype">Degree Type:</label>
                <select id="degreetype" name="degreetype" required>
                    <option value="Masters" <?php echo $taInfo['degreetype'] == 'Masters' ? 'selected' : ''; ?>>Masters</option>
                    <option value="PhD" <?php echo $taInfo['degreetype'] == 'PhD' ? 'selected' : ''; ?>>PhD</option>
                </select>

                <input type="submit" value="Update TA" class="button">
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
