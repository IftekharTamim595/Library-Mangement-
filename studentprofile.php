<?php include('header.php'); ?>
<?php
session_start();
include('config.php');

// Check if user is logged in
if ($_SESSION['user_role'] !== 'student') {
    header("Location: login.php"); // Redirect if not logged in as student
    exit();
}

$user_id = $_SESSION['user_id'];
$borrowed_books = [];

$sql = "SELECT b.book_name, b.author_name, bb.borrow_date
        FROM borrowed_books bb
        JOIN books b ON bb.book_id = b.book_id
        WHERE bb.user_id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $borrowed_books[] = $row;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
</head>
<body>
    <h2>Your Borrowed Books</h2>
    <ul>
        <?php foreach ($borrowed_books as $book): ?>
            <li>
                <?php echo htmlspecialchars($book['book_name']); ?> by <?php echo htmlspecialchars($book['author_name']); ?>
                (Borrowed on: <?php echo $book['borrow_date']; ?>)
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
