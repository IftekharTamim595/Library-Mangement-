<?php
// Start session to check if user is logged in
session_start();

// Include database connection
include('config.php');

// Check if the user is logged in
// if (!isset($_SESSION['user_id'])) {
//     header('Location: login.php'); // Redirect to login page if not logged in
//     exit();
// }

// Get the user details from the database based on session user_id
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE user_id = $user_id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Fetch user details
    $user = mysqli_fetch_assoc($result);
} else {
    // Handle case when user data is not found
    echo "User details not found.";
    exit();
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
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
        .profile-card {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .profile-card h2 {
            margin: 10px 0;
            font-size: 20px;
        }
        .profile-card p {
            margin: 5px 0;
            font-size: 16px;
        }
        .button {
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 10px;
        }
        .button:hover {
            background-color: #2980b9;
        }
        .student-options {
            margin-top: 20px;
        }
        .student-options button {
            padding: 10px 20px;
            margin: 5px;
            background-color: #27ae60;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>User Profile</h1>

    <div class="profile-card">
        <h2><?php echo $user['username']; ?></h2>
        <p>Email: <?php echo $user['email']; ?></p>
        
        <?php if ($user['user_type'] == 'student'): ?>
            <div class="student-options">
                <button class="button" onclick="window.location.href='borrowBooks.php'">Borrow Books</button>
                <button class="button" onclick="window.location.href='requestBook.php'">Request a Book</button>
            </div>
        <?php elseif ($user['user_type'] == 'librarian'): ?>
            <button class="button" onclick="window.location.href='librarianProfile.php'">View Librarian Details</button>
        <?php endif; ?>
    </div>

</div>

</body>
</html>
