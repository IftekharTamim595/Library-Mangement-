<?php
// Include database configuration
include 'config.php';

// Start the session
session_start();
// Initialize variables
$message = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    // Query the database for the user
    $sql = "SELECT * FROM users WHERE username = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch user details
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['user_id']; // Assuming 'id' is the user's unique identifier
            $_SESSION['user_role'] = $user['user_type']; // Store the user role

            // Redirect based on role
            if ($user['user_type'] === 'student') {
                header("Location: studentHome.php");
                exit();
            } elseif ($user['user_type'] === 'librarian') {
                header("Location: librarianHome.php");
                exit();
            }
        } else {
            $message = "Incorrect password. Please try again.";
        }
    } else {
        $message = "No account found with that email.";
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - IIUC Central Library</title>
    <link href="styles.css" rel="stylesheet">
    <style>
        /* Button styles */
        .btn-primary {
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }

        /* Popup modal styles */
        .modal {
            display: none; /* Hidden by default */
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            z-index: 1000;
        }

        .modal-content {
            text-align: center;
            color:black;
        }

        .close-button {
            margin-top: 10px;
            padding: 5px 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .close-button:hover {
            background-color: #0056b3;
        }

        /* Overlay background */
        .overlay {
            display: none; /* Hidden by default */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }
    </style>
</head>
<body>
    <div class="background"></div> 
    <h1>IIUC Central Library</h1>

    <div class="container">
        <div class="form-container">
            <h2>Login to your Account</h2>
            <form id="loginForm" method="POST" action="">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="btn-primary">Login</button>
                <a href="register.php">Don't have an account? Register</a>
            </form>
        </div>
    </div>

    <!-- Popup Modal for Messages -->
    <?php if (!empty($message)): ?>
        <div class="overlay" id="overlay"></div>
        <div class="modal" id="modal">
            <div class="modal-content">
                <p><?php echo htmlspecialchars($message); ?></p>
                <button class="close-button" onclick="closeModal()">Close</button>
            </div>
        </div>
    <?php endif; ?>

    <script>
        // Show the modal and overlay if there is a message
        <?php if (!empty($message)): ?>
            document.getElementById("modal").style.display = "block";
            document.getElementById("overlay").style.display = "block";
        <?php endif; ?>

        // Close the modal and overlay
        function closeModal() {
            document.getElementById("modal").style.display = "none";
            document.getElementById("overlay").style.display = "none";
        }
    </script>
</body>
</html>