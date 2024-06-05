<!-- This file sets up the main menu home page with the necessary buttons -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teaching Assistant Database</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            text-align: center;
        }
        .header {
            background-color: #005f73;
            color: white;
            padding: 20px;
            margin-bottom: 40px;
        }
        .button {
            background-color: #0a9396;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #94d2bd;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Teaching Assistant Database</h1>
        </div>
        <div>
            <a href="list_tas.php" class="button">View TAs</a>
            <a href="add_ta.php" class="button">Add</a>
            <a href="delete_ta.php" class="button">Delete</a>
            <a href="edit_ta.php" class="button">Edit</a>
            <a href="courses.php" class="button">Courses</a>
        </div>
    </div>
</body>
</html>
