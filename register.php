<?php
// Include the database configuration file
include 'config.php';

// Initialize a message variable
$popupMessage = ""; // Variable for popup message

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form inputs
    $username = $conn->real_escape_string($_POST['email']); // Using email as the username
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password
    $user_type = $conn->real_escape_string($_POST['role']); // Role selected by the user

    // Check if the email already exists
    $checkEmailQuery = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($checkEmailQuery);

    if ($result->num_rows > 0) {
        // Email already exists
        $popupMessage = "User with this email already exists!";
    } else {
        // Insert data into the database
        $sql = "INSERT INTO users (username, password, user_type) VALUES ('$username', '$password', '$user_type')";

        if ($conn->query($sql) === TRUE) {
            $popupMessage = "Account created successfully!";
        } else {
            $popupMessage = "Error: " . $conn->error;
        }
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - IIUC Central Library</title>
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
            color: black;
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
            <h2>Create a New Account</h2>
            <form id="registerForm" action="" method="POST" onsubmit="return validateForm(event)">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Create a password" required>
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm your password" required>
                </div>
                <div class="form-group">
                    <label for="role">Select Role</label>
                    <select id="role" name="role">
                        <option value="student">Student</option>
                        <option value="librarian">Librarian</option>
                    </select>
                </div>
                <button type="submit" class="btn-primary">Register</button>
                <a href="login.php">Already have an account? Login</a>
            </form>
        </div>
    </div>

    <!-- Popup Modal -->
    <?php if (!empty($popupMessage)): ?>
        <div class="overlay" id="overlay"></div>
        <div class="modal" id="modal">
            <div class="modal-content">
                <p><?php echo htmlspecialchars($popupMessage); ?></p>
                <button class="close-button" onclick="closeModal()">Close</button>
            </div>
        </div>
    <?php endif; ?>

    <script>
        // Client-side validation
        function validateForm(event) {
            const password = document.getElementById("password").value;
            const confirmPassword = document.getElementById("confirmPassword").value;

            if (password !== confirmPassword) {
                alert("Passwords do not match!");
                event.preventDefault();
                return false;
            }
            return true;
        }

        // Show the modal and overlay if there is a message
        <?php if (!empty($popupMessage)): ?>
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