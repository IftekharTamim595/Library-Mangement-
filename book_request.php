<?php
// Include the database connection
include('config.php');

// Start the session to access the session variables
session_start();

// Check if the user is logged in (session exists)
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to login page with a message
    header("Location: login.php?message=Please+log+in+to+request+a+book");
    exit;
}

// Get the user ID from the session
$userId = $_SESSION['user_id'];
$bookId = $_POST['book_id'];
// Check if the request is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Debugging: Check the POST data
    error_log("POST data: " . print_r($_POST, true)); // Log the entire POST data

    // Get the book ID from the form
    $bookId = $_POST['book_id'];

    // Debugging: Log the book ID to check if it's correct
    error_log("Book ID from form: " . $bookId);  // This will log to the PHP error log

    // Check if the book ID is not empty
    if (empty($bookId)) {
        echo "Book ID is missing.";
        exit;
    }

    // Check if the book is available
    $checkBookQuery = "SELECT available_quantity FROM books WHERE book_id = ?";
    $stmt = $conn->prepare($checkBookQuery);
    $stmt->bind_param("i", $bookId);
    $stmt->execute();
    $stmt->bind_result($availableQuantity);
    $stmt->fetch();
    $stmt->close();

    if ($availableQuantity <= 0) {
        // If book is not available, redirect back with a message
        header("Location: bookList.php?message=Book+not+available");
        exit;
    }

    // Insert the request into the database
    $insertQuery = "INSERT INTO book_requests (user_id, book_id, status) VALUES (?, ?, 'pending')";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("ii", $userId, $bookId);

    if ($stmt->execute()) {
        // Success message and redirect
        header("Location: bookList.php?message=Request+sent+successfully");
        exit;
    } else {
        // Error handling in case of failure
        echo "Error: " . $stmt->error;
        exit;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>