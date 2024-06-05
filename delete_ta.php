<?php
include 'db_connect.php'; // Ensure this path is correct

$message = '';

// Check if a delete request was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tauserid'])) {
    $tauserid = $connnection->real_escape_string($_POST['tauserid']);

    // Perform the deletion query
    $sql = "DELETE FROM ta WHERE tauserid = '$tauserid'";
    if ($conn->query($sql) === TRUE) {
        $message = "TA deleted successfully.";
    } else {
        $message = "Error deleting TA: " . $conn->error;
    }
}

// Fetch all TAs to display in the table
$sql = "SELECT * FROM ta";
$result = $connection->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Teaching Assistants</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
        }
        .container {
            width: 80%;
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
            text-align: left;
        }
        th, td {
            padding: 10px;
        }
        th {
            background-color: #005f73;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .header {
            background-color: #005f73;
            color: white;
            padding: 20px;
            width: 100%;
            box-sizing: border-box;
        }
        a.button {
            background-color: #0a9396;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        a.button:hover {
            background-color: #94d2bd;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Delete Teaching Assistant</h1>
    </div>
    <div class="container">
        <a href="mainmenu.php" class="button">Back to Home</a>

        <?php if ($message): ?>
            <p style="color: red;"><?php echo $message; ?></p>
        <?php endif; ?>

        <table>
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Student Number</th>
                    <th>Degree Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['firstname']); ?></td>
                            <td><?php echo htmlspecialchars($row['lastname']); ?></td>
                            <td><?php echo htmlspecialchars($row['studentnum']); ?></td>
                            <td><?php echo htmlspecialchars($row['degreetype']); ?></td>
                            <td>
                                <form method="post" action="delete_ta.php" onsubmit="return confirm('Are you sure you want to delete this TA?');">
                                    <input type="hidden" name="tauserid" value="<?php echo htmlspecialchars($row['tauserid']); ?>">
                                    <input type="submit" value="Delete" style="color: red;">
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No teaching assistants found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
