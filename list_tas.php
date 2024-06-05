<!-- This file lists out all the TAs in a table -->
<?php
// Include your database connection script
include 'db_connect.php';

// Determine the sort order and column
$order_by = isset($_GET['order_by']) ? $_GET['order_by'] : 'lastname';
$order_type = isset($_GET['order_type']) && $_GET['order_type'] == 'DESC' ? 'DESC' : 'ASC';

// SQL query to fetch all teaching assistants
$sql = "SELECT * FROM ta ORDER BY $order_by $order_type";
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
        <h1>Teaching Assistant List</h1>
    </div>
    <div class="container">
        <a href="mainmenu.php" class="button">Back to Home</a>
	 <!-- Add the instructional text here -->
        <p style="font-style: italic;">
            Click on last name to order by last name and click on degree type to order by degree type.
        </p>
        <table>
            <thead>
                <tr>
                    <th>First Name</th>
                    <th><a href="?order_by=lastname&order_type=<?php echo $order_type == 'ASC' ? 'DESC' : 'ASC'; ?>">Last Name</a></th>
                    <th>Student Number</th>
                    <th><a href="?order_by=degreetype&order_type=<?php echo $order_type == 'ASC' ? 'DESC' : 'ASC'; ?>">Degree Type</a></th>
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
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No teaching assistants found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
