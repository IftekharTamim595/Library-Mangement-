<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection
include('config.php');

// Start the session to access the session variables
session_start();

// Check if the user is logged in and is a librarian
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'librarian') {
    // If not logged in or not a librarian, redirect to login page with a message
    header("Location: login.php?message=Please+log+in+as+a+librarian");
    exit;
}

// Fetch all book requests with student and book details
$sql = "SELECT r.request_id, b.book_name, u.username, r.status, r.request_date 
        FROM book_requests r
        JOIN books b ON r.book_id = b.book_id
        JOIN users u ON r.user_id = u.user_id
        ORDER BY r.request_date DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librarian Panel - IIUC Central Library</title>
    <style>
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

        /* Title Styling */
        h2 {
            font-size: 2rem; /* Larger font size */
            font-weight: bold; /* Bold font for emphasis */
            color: #2c3e50; /* Dark blue color */
            text-align: center; /* Center-align the title */
            margin-top: 40px; /* Space above the title */
            margin-bottom: 20px; /* Space below the title */
            text-transform: uppercase; /* Make the title all uppercase */
            letter-spacing: 2px; /* Add letter spacing for a modern look */
            position: relative; /* To position the shadow and underline */
        }

        /* Add a subtle text shadow */
        h2::before {
            content: "";
            position: absolute;
            width: 100%;
            height: 3px;
            background-color: #3498db; /* Blue underline */
            bottom: 0;
            left: 0;
        }

        /* Add text shadow for a glowing effect */
        h2 {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        /* Request List Container */
        .request-list-container {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            justify-content: center;
            margin-top: 20px;
            padding: 20px;
        }

        /* Request Item */
        .request-item {
            background-color: rgba(255, 255, 255, 0.85); /* Semi-transparent white background */
            padding: 20px;
            border-radius: 15px; /* Rounded corners */
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3); /* Soft shadow */
            width: 250px; /* Fixed width for each item */
            text-align: center; /* Center-align content */
            transition: all 0.3s ease; /* Smooth hover effect */
        }

        .request-item:hover {
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.4); /* Enhanced shadow on hover */
        }

        .request-item h3 {
            font-size: 20px; /* Larger font size for book name */
            color: #34495e; /* Dark blue color */
            margin-bottom: 10px; /* Space below the book name */
        }

        .request-item p {
            font-size: 16px; /* Standard font size for details */
            color: #34495e; /* Dark blue color */
            margin: 5px 0; /* Space between paragraphs */
        }

        /* Button Styles */
        .btn-approve, .btn-reject {
            background-color: #28a745; /* Green for approve button */
            border-color: #28a745;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin: 5px 0;
            text-align: center;
            display: inline-block;
            width: 100%;
            transition: all 0.3s ease;
        }

        .btn-approve:hover {
            background-color: #218838; /* Darker green on hover */
            border-color: #1e7e34;
        }

        .btn-reject {
            background-color: #dc3545; /* Red for reject button */
            border-color: #dc3545;
        }

        .btn-reject:hover {
            background-color: #c82333; /* Darker red on hover */
            border-color: #bd2130;
        }
    </style>
</head>
<body>
    <!-- Background with blur effect -->
    <div class="background"></div>

    <!-- Display the book requests -->
    <h2>Book Requests</h2>
    <div class="request-list-container">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='request-item'>";
                echo "<h3>Book: " . $row['book_name'] . "</h3>";
                echo "<p>Requested By: " . $row['username'] . "</p>";
                echo "<p>Status: " . $row['status'] . "</p>";
                echo "<p>Requested At: " . $row['request_date'] . "</p>";

                // Add buttons for accepting and deleting requests
                if ($row['status'] === 'pending') {
                    echo "<form id='accept-form-" . $row['request_id'] . "' action='accept_request.php' method='POST' style='display:inline;'>
                          <input type='hidden' name='request_id' value='" . $row['request_id'] . "'>
                          <button type='submit' class='btn-approve'>Accept</button>
                          </form>";

                    echo "<form id='delete-form-" . $row['request_id'] . "' class='delete-form' data-request-id='" . $row['request_id'] . "' style='display:inline;'>
                          <button type='submit' class='btn-reject'>Delete</button>
                          </form>";
                }

                echo "</div>";
            }
        } else {
            echo "<p>No book requests found.</p>";
        }
        ?>
    </div>

    <script>
        // Function to handle accept form submission
        function handleAcceptFormSubmit(event) {
            event.preventDefault(); // Prevent the default form submission

            const form = event.target; // Get the form that triggered the event
            const formData = new FormData(form); // Create FormData object from the form

            // Send the form data using Fetch API
            fetch(form.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.text()) // Parse the response as text
            .then(data => {
                // Display a success message or update the UI
                alert("Request accepted successfully!");
                // Remove the request item from the UI
                form.closest('.request-item').remove();
            })
            .catch(error => {
                console.error("Error:", error);
                alert("An error occurred while processing the request.");
            });
        }

        // Function to handle delete form submission
        function handleDeleteFormSubmit(event) {
            event.preventDefault(); // Prevent the default form submission

            const form = event.target; // Get the form that triggered the event
            const requestId = form.getAttribute('data-request-id'); // Get the request ID from the form

            // Send the request ID to the server using Fetch API
            fetch('delete_request.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `request_id=${requestId}` // Send the request ID as form data
            })
            .then(response => response.text()) // Parse the response as text
            .then(data => {
                if (data === "success") {
                    // Display a success message or update the UI
                    alert("Request deleted successfully!");
                    // Remove the request item from the UI
                    form.closest('.request-item').remove();
                } else {
                    // Display an error message
                    alert("Failed to delete the request.");
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("An error occurred while processing the request.");
            });
        }

        // Attach event listeners to all accept forms
        document.querySelectorAll('form[id^="accept-form-"]').forEach(form => {
            form.addEventListener('submit', handleAcceptFormSubmit);
        });

        // Attach event listeners to all delete forms
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', handleDeleteFormSubmit);
        });
    </script>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>