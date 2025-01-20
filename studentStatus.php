<?php
// Include database connection
include('config.php');

// Fetch student details from the database
$sql = "SELECT * FROM users WHERE user_type = 'student'";
$result = mysqli_query($conn, $sql);

// Check if there are any students in the database
if (mysqli_num_rows($result) > 0) {
    // Fetch all student details
    $students = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $students = [];
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Status</title>
    <style>
        /* General Styles */
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f8f9fa;
            color: #34495e;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('https://i.ibb.co/v1ThJhG/bg-01.jpg'); /* Background Image */
            background-size: cover;
            background-position: center;
        }
        .container {
            text-align: center;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 800px;
        }
        h1 {
            margin-bottom: 20px;
        }
        .student-card {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .student-card h2 {
            margin: 10px 0;
            font-size: 20px;
        }
        .student-card p {
            margin: 5px 0;
            font-size: 16px;
        }
        .contact-button {
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .contact-button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Student Status</h1>

    <?php if (count($students) > 0): ?>
        <?php foreach ($students as $student): ?>
            <div class="student-card">
                <h2><?php echo $student['username']; ?></h2>
                <p>Email: <?php echo $student['email']; ?></p>
                <p>Phone: <?php echo isset($student['phone']) ? $student['phone'] : 'N/A'; ?></p>
                <button class="contact-button" onclick="window.location.href='mailto:<?php echo $student['email']; ?>'">Contact</button>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No students found.</p>
    <?php endif; ?>

</div>

</body>
</html>
