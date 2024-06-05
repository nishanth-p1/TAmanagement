<!-- This file creates the interface the displays the courses in a table -->
<?php
include 'db_connect.php'; // Make sure to use the correct path to your database connection script

$message = '';
$courses = [];

// Check if a filter form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['year'])) {
    $year = $connection->real_escape_string($_POST['year']);

    // Fetch courses filtered by year
    $sql = "SELECT * FROM course WHERE year = '$year'";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            array_push($courses, $row);
        }
    } else {
        $message = "No courses found for the selected year.";
    }
} else {
    // Fetch all courses
    $sql = "SELECT * FROM course";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            array_push($courses, $row);
        }
    } else {
        $message = "No courses found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Information</title>
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
            max-width: 800px;
            margin: 30px auto;
        }
        .message {
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 5px;
            color: #856404;
            background-color: #fff3cd;
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
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .header {
            background-color: #005f73;
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .filter-form {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .filter-form label,
        .filter-form select {
            margin-right: 10px;
        }
        .filter-form button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .filter-form button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Course Information</h2>
        </div>
        <?php if ($message): ?>
            <div class="message">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        <div class="filter-form">
            <form method="post" action="courses.php">
                <label for="year">Filter by Year:</label>
                <select id="year" name="year">
                    <option value="">Select Year</option>
                    <!-- Populate years dynamically or hardcode them -->
                    <?php
                    // Example for dynamic year options (replace with actual year retrieval from DB if needed)
                    for ($i = 1990; $i <= date('Y'); $i++) {
                        echo "<option value=\"$i\">$i</option>";
                    }
                    ?>
                </select>
                <button type="submit">Filter</button>
            </form>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Course Number</th>
                    <th>Course Name</th>
                    <th>Level</th>
                    <th>Year</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($courses as $course): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($course['coursenum']); ?></td>
                        <td><?php echo htmlspecialchars($course['coursename']); ?></td>
                        <td><?php echo htmlspecialchars($course['level']); ?></td>
                        <td><?php echo htmlspecialchars($course['year']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
