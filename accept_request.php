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

    // Fetch the request details
    $sql = "SELECT r.user_id, r.book_id, b.available_quantity, b.borrowed_quantity 
            FROM book_requests r
            JOIN books b ON r.book_id = b.book_id
            WHERE r.request_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $requestId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        $userId = $row['user_id'];
        $bookId = $row['book_id'];
        $availableQuantity = $row['available_quantity'];
        $borrowedQuantity = $row['borrowed_quantity'];

        // Check if the book is available
        if ($availableQuantity > 0) {
            // Update the request status to 'accepted'
            $updateRequestSql = "UPDATE book_requests SET status = 'accepted' WHERE request_id = ?";
            $stmt = $conn->prepare($updateRequestSql);
            $stmt->bind_param("i", $requestId);
            $stmt->execute();

            // Update the books table: decrease available_quantity and increase borrowed_quantity
            $updateBookSql = "UPDATE books 
                              SET available_quantity = available_quantity - 1, 
                                  borrowed_quantity = borrowed_quantity + 1 
                              WHERE book_id = ?";
            $stmt = $conn->prepare($updateBookSql);
            $stmt->bind_param("i", $bookId);
            $stmt->execute();

            // Add the book to the borrowed_books table
            $insertBorrowedSql = "INSERT INTO borrowed_books (user_id, book_id) VALUES (?, ?)";
            $stmt = $conn->prepare($insertBorrowedSql);
            $stmt->bind_param("ii", $userId, $bookId);
            $stmt->execute();

            // Return a success response
            echo "success";
            exit;
        } else {
            // Return an error response
            echo "error: Book not available";
            exit;
        }
    } else {
        // Return an error response
        echo "error: Request not found";
        exit;
    }
} else {
    // Return an error response
    echo "error: Invalid request";
    exit;
}
?>