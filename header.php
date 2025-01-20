<?php
// Start the session (if needed for user information or session-based authentication)
// session_start();

// Example: Replace with real user session data
// $username = $_SESSION['username'] ?? 'Librarian';
$username = 'Librarian'; // Placeholder for demonstration
?>

<header>
    <div class="custom-top-navbar">
        <div class="custom-navbar-title">
            <h1>IIUC Central Library</h1>
        </div>
        <div class="custom-profile-menu">
            <a href="profile.php" class="profile-button">Profile</a> <!-- Link to profile page -->
            <a href="logout.php" class="logout-button">Logout</a> <!-- Link to logout page -->
        </div>
    </div>
</header>

<style>
    /* Custom header styles */
    .custom-top-navbar {
        background: linear-gradient(to bottom, #007BFF,rgb(57, 139, 227)); /* Bluish gradient */
        color: white;
        padding: 20px 15px; /* Increased padding for better spacing */
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .custom-navbar-title {
        flex-grow: 1; /* Allow the title to take up available space */
        text-align: center; /* Center the title */
        margin-left: 100px; /* Adjust this value to center the title */
    }

    .custom-navbar-title h1 {
        margin: 0;
        font-size: 2.2rem; /* Larger font size */
        font-family: 'Georgia', serif; /* Standard font */
        color: #fff; /* White text */
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3); /* Text shadow for better readability */
    }

    .custom-profile-menu {
        display: flex;
        align-items: center;
        gap: 10px; /* Space between buttons */
    }

    /* Button styles for Profile and Logout */
    .profile-button, .logout-button {
        background-color:rgb(62, 128, 200); /* Blue background for buttons */
        color: white;
        padding: 10px 20px; /* Padding for button size */
        border-radius: 25px; /* Rounded corners */
        text-decoration: none;
        font-size: 1rem;
        font-family: 'Arial', sans-serif; /* Standard font for buttons */
        transition: background-color 0.3s ease; /* Smooth hover effect */
    }

    .profile-button:hover, .logout-button:hover {
        background-color:rgb(86, 160, 239); /* Darker blue on hover */
    }
</style>