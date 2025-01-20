<?php
// Start the session (if needed for user information or session-based authentication)
// session_start();

// Example: Replace with real user session data
// $username = $_SESSION['username'] ?? 'Librarian';
$username = 'Librarian'; // Placeholder for demonstration
?>
<?php include('header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IIUC Central Library - Librarian Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <link href="homepagecss.css" rel="stylesheet">
    <style>
        /* General Styles */
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            color: #34495e;
            position: relative; /* Ensure the body is a positioning context */
            overflow: hidden; /* Prevent scrolling */
        }

        /* Background with blur effect */
        .background {
            position: fixed; /* Use fixed to ensure it covers the entire viewport */
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('https://i.ibb.co/2dz9r5m/463106311-3980577685509368-7328189217719667629-n.jpg'); /* Your Background Image */
            background-size: cover;
            background-position: center;
            filter: blur(8px); /* Apply the blur effect */
            z-index: -1; /* Ensure the background is behind other content */
        }

        /* Library Description */
        .library-description {
            text-align: center;
            padding: 20px 10px;
            margin-top: 10px;
            font-size: 22px;
            font-weight: bold;
            color: #2c3e50;
            background-color: rgba(236, 240, 241, 0.9); /* Semi-transparent background */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 80%;
            margin-left: auto;
            margin-right: auto;
            z-index: 1; /* Ensure it's above the background */
        }

        /* Buttons Container */
        .buttons-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px; /* Reduced gap between buttons */
            justify-content: center;
            margin-top: 20px;
            padding: 20px;
            z-index: 1; /* Ensure it's above the background */
        }

        /* Button Card */
        .button-card {
            background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white background */
            border-radius: 15px; /* Slightly rounded corners */
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2); /* Softer shadow */
            width: 180px; /* Reduced button width */
            height: 160px; /* Reduced button height */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            padding: 15px; /* Added padding */
            gap: 8px; /* Reduced gap between title and description */
        }

        .button-card:hover {
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.3); /* Enhanced hover shadow */
            background-color: rgba(255, 255, 255, 1); /* Fully opaque on hover */
            transform: translateY(-5px); /* Slight lift effect */
        }

        .button-card span {
            font-size: 18px; /* Slightly larger font */
            font-weight: 700; /* Bold for distinction */
            color: #007BFF; /* Blue color for titles */
            line-height: 1.3;
        }

        .button-card p {
            font-size: 14px; /* Slightly larger font */
            color: #34495e; /* Darker text color */
            margin-top: 5px; /* Reduced margin between title and description */
            line-height: 1.4;
            text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.8); /* White shadow for readability */
        }

        .button-card .button {
            all: unset;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background: transparent;
            cursor: pointer;
        }
    </style>
</head>
<body>

<!-- Background with blur effect -->
<div class="background"></div>

<!-- Library Description -->
<section class="library-description">
    <p>Welcome, <?php echo htmlspecialchars($username); ?>, to the Librarian Panel! Manage the library effectively with the tools below.</p>
</section>

<!-- Buttons Container -->
<section class="buttons-container">
    <div class="button-card">
        <button class="button" onclick="location.href='addBook.php'">
            <span>Add Book</span>
        </button>
        <p>Add new books to the library catalog.</p>
    </div>

    <div class="button-card">
        <button class="button" onclick="location.href='studentStatus.php'">
            <span>See Student Status</span>
        </button>
        <p>View borrowing history and fines for students.</p>
    </div>

    <div class="button-card">
        <button class="button" onclick="location.href='booklist2.php'">
            <span>Book Status</span>
        </button>
        <p>Check the availability and details of books in the library.</p>
    </div>

    <div class="button-card">
        <button class="button" onclick="location.href='request_books.php'">
            <span>Book Requests</span>
        </button>
        <p>Manage book requests from students.</p>
    </div>
</section>

<script src="script.js"></script>
</body>
</html>