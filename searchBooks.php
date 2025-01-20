<?php
// Include database connection
include('config.php');

// Initialize variables
$searchQuery = '';

// Check if the search form is submitted
if (isset($_POST['search'])) {
    $searchQuery = $_POST['search_query'];

    // Sanitize the input to prevent SQL injection
    $searchQuery = mysqli_real_escape_string($conn, $searchQuery);

    // SQL query to search for books by name
    $sql = "SELECT * FROM books WHERE book_name LIKE '%$searchQuery%'";
    $result = mysqli_query($conn, $sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Books</title>
    <style>
        /* General Styles */
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            color: #34495e;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh; /* Use min-height instead of height */
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
            z-index: -1; /* Make sure the background is behind other content */
        }

        /* Container for the search form and results */
        .container {
            text-align: center;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white background */
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 600px;
            z-index: 1; /* Ensure the container is above the background */
        }

        /* Search bar styling */
        .search-bar {
            width: 90%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 25px;
            border: 1px solid #ddd;
            font-size: 16px;
        }

        /* Search button styling */
        .search-button {
            padding: 10px 20px;
            border-radius: 25px;
            background-color: #3498db;
            color: white;
            border: none;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .search-button:hover {
            background-color: #2980b9;
        }

        /* Table styling */
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #ecf0f1;
        }
    </style>
</head>
<body>

<!-- Background with blur effect -->
<div class="background"></div>

<!-- Container for the search form and results -->
<div class="container">
    <h1>Search Books</h1>
    <form method="POST" action="">
        <input type="text" name="search_query" class="search-bar" placeholder="Search by Book Name" value="<?php echo $searchQuery; ?>" required>
        <button type="submit" class="search-button" name="search">Search</button>
    </form>

    <?php
    // If search results exist, show them
    if (isset($result) && mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr><th>Book ID</th><th>Book Name</th><th>Author</th><th>Genre</th><th>Available</th></tr>";

        // Loop through the results and display each book's details
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['book_id'] . "</td>";
            echo "<td>" . $row['book_name'] . "</td>";
            echo "<td>" . $row['author_name'] . "</td>";
            echo "<td>" . $row['genre'] . "</td>";
            echo "<td>" . $row['available_quantity'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } elseif (isset($result) && mysqli_num_rows($result) == 0) {
        echo "<p>No books found matching your search query.</p>";
    }
    ?>
</div>

</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>