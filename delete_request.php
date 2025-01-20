<?php
// Include the database connection
include('config.php');

// Start the session to access the session variables
session_start();

// Check if the user is logged in and is a librarian
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'librarian') {
    // If not logged in or not a librarian, return an error response
    echo "error: Please log in as a librarian";
    exit;
}

// Get the request ID from the form
if (isset($_POST['request_id'])) {
    $requestId = $_POST['request_id'];

    // Delete the request from the book_requests table
    $deleteSql = "DELETE FROM book_requests WHERE request_id = ?";
    $stmt = $conn->prepare($deleteSql);
    $stmt->bind_param("i", $requestId);

    if ($stmt->execute()) {
        // Return a success response
        echo "success";
    } else {
        // Return an error response
        echo "error: Failed to delete the request";
    }
} else {
    // Return an error response
    echo "error: Invalid request";
}
?>