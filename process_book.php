<?php
// Include the database connection
include('config.php');

// Check if the request is POST (from the add book form)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $bookTitle = $_POST['bookTitle'];  // This corresponds to the form field 'bookTitle'
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $quantity = $_POST['quantity'];

    // Prepare the SQL query to insert the new book
    $insertQuery = "INSERT INTO books (book_name, author_name, genre, total_quantity, available_quantity) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);

    // Bind parameters and execute the query
    $stmt->bind_param("ssssi", $bookTitle, $author, $genre, $quantity, $quantity);  // 'quantity' for both total_quantity and available_quantity

    if ($stmt->execute()) {
        // Book added successfully, redirect or show success message
        header("Location: addbook.php?message=Book+added+successfully");
        exit;
    } else {
        // Error during execution
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
