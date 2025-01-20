<?php
// Include database connection
include('config.php');

// Initialize variables
$requestStatus = '';

if (isset($_POST['submit_request'])) {
    // Sanitize input
    $bookName = mysqli_real_escape_string($conn, $_POST['book_name']);
    $authorName = mysqli_real_escape_string($conn, $_POST['author_name']);
    $edition = mysqli_real_escape_string($conn, $_POST['edition']);

    // SQL query to insert the request into the database (assumes there's a 'requests' table)
    $sql = "INSERT INTO requests (book_name, author_name, edition) VALUES ('$bookName', '$authorName', '$edition')";
    if (mysqli_query($conn, $sql)) {
        $requestStatus = "Your request has been successfully submitted!";
    } else {
        $requestStatus = "Error: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Book</title>
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
            z-index: -1; /* Ensure the background is behind other content */
        }

        /* Container for the form */
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

        h1 {
            margin-bottom: 20px;
        }

        .input-field {
            width: 90%;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 25px;
            border: 1px solid #ddd;
            font-size: 16px;
        }

        .submit-button {
            padding: 12px 20px;
            border-radius: 25px;
            background-color: #3498db;
            color: white;
            border: none;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-button:hover {
            background-color: #2980b9;
        }

        .status-message {
            margin-top: 20px;
            font-size: 18px;
            color: green;
        }
    </style>
</head>
<body>

<!-- Background with blur effect -->
<div class="background"></div>

<!-- Container for the form -->
<div class="container">
    <h1>Request a Book</h1>
    <form method="POST" action="">
        <input type="text" name="book_name" class="input-field" placeholder="Enter Book Name" required>
        <input type="text" name="author_name" class="input-field" placeholder="Enter Author Name" required>
        <input type="text" name="edition" class="input-field" placeholder="Enter Edition" required>
        <button type="submit" class="submit-button" name="submit_request">Submit Request</button>
    </form>

    <?php
    // Display the status message after form submission
    if ($requestStatus) {
        echo "<p class='status-message'>$requestStatus</p>";
    }
    ?>
</div>

</body>
</html>