<?php
// Include the database connection
include('config.php');

// Check if the user is a librarian (Add your session-based authentication here)
session_start();
if ($_SESSION['user_type'] !== 'librarian') {
    echo "Access denied. You must be a librarian to view this page.";
    exit;
}

// Fetch all book requests
$query = "SELECT br.request_id, u.username, b.book_name, br.status, br.request_date
          FROM book_requests br
          INNER JOIN users u ON br.user_id = u.user_id
          INNER JOIN books b ON br.book_id = b.book_id
          ORDER BY br.request_date DESC";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Book Requests</title>
    <style>
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .btn {
            padding: 5px 10px;
            margin: 0 5px;
            cursor: pointer;
        }

        .btn-accept {
            background-color: #4CAF50;
            color: white;
            border: none;
        }

        .btn-reject {
            background-color: #f44336;
            color: white;
            border: none;
        }
    </style>
</head>
<body>
    <h1>Book Requests</h1>
    <table>
        <tr>
            <th>Request ID</th>
            <th>Username</th>
            <th>Book Name</th>
            <th>Status</th>
            <th>Request Date</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['request_id']}</td>
                        <td>{$row['username']}</td>
                        <td>{$row['book_name']}</td>
                        <td>{$row['status']}</td>
                        <td>{$row['request_date']}</td>
                        <td>
                            <form method='POST' action='process_book.php' style='display:inline;'>
                                <input type='hidden' name='request_id' value='{$row['request_id']}'>
                                <button class='btn btn-accept' name='action' value='accept'>Accept</button>
                                <button class='btn btn-reject' name='action' value='reject'>Reject</button>
                            </form>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No requests found.</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
