<?php
// Start the session
session_start();

// Include the database connection
include('config.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to login page with a message
    header("Location: login.php?message=Please+log+in+to+access+the+library");
    exit;
}

// Get the user ID from the session
$userId = $_SESSION['user_id'];

// Fetch the user's details from the database
$userSql = "SELECT username FROM users WHERE user_id = ?";
$stmt = $conn->prepare($userSql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$stmt->bind_result($username);
$stmt->fetch();
$stmt->close();

// Fetch the books borrowed by the user
$borrowedBooksSql = "SELECT b.book_name 
                     FROM borrowed_books bb
                     JOIN books b ON bb.book_id = b.book_id
                     WHERE bb.user_id = ?";
$stmt = $conn->prepare($borrowedBooksSql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$borrowedBooksResult = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IIUC Central Library - Home</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet"> <!-- Changed to Poppins font -->
    <link href="homepagecss.css" rel="stylesheet">
</head>
<body>
    <!-- Background with blur effect -->
    <div class="background"></div> 

    <!-- Library Description -->
    <section class="library-description">
        <p>Welcome, <?php echo htmlspecialchars($username); ?>, to the IIUC Central Library! Your gateway to a world of knowledge. Explore, read, and learn with us.</p>
        
        <!-- Display borrowed books -->
        <?php if ($borrowedBooksResult->num_rows > 0): ?>
            <div class="borrowed-books">
                <h3>Books You Have Borrowed:</h3>
                <ul>
                    <?php while ($row = $borrowedBooksResult->fetch_assoc()): ?>
                        <li><?php echo htmlspecialchars($row['book_name']); ?></li>
                    <?php endwhile; ?>
                </ul>
            </div>
        <?php else: ?>
            <p>You have not borrowed any books yet.</p>
        <?php endif; ?>
    </section>

    <!-- Buttons Container -->
    <section class="buttons-container">
        <div class="button-card">
            <button class="button" onclick="location.href='searchBooks.php'">
                <span>Search Books</span>
            </button>
            <p>Find the books you're looking for.</p>
        </div>
        <div class="button-card">
            <button class="button" onclick="location.href='bookList.php'">
                <span>Book List</span>
            </button>
            <p>View available books and borrow them.</p>
        </div>
        <div class="button-card">
            <button class="button" onclick="location.href='currentHoldings.php'">
                <span>Current Holdings</span>
            </button>
            <p>Check the books you currently have borrowed.</p>
        </div>
        <div class="button-card">
            <button class="button" onclick="location.href='requestBook.php'">
                <span>Request Book</span>
            </button>
            <p>Request a book that is unavailable.</p>
        </div>
        <div class="button-card">
            <button class="button" onclick="location.href='contactLibrarian.php'">
                <span>Contact Librarian</span>  
            </button>
            <p>Get in touch with the librarian for assistance.</p>
        </div>
    </section>

    <script src="script.js"></script>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>