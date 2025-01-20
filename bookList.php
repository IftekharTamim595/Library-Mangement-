<?php
session_start();  // This should be at the very top, before any HTML or output
?>

<?php
// Include the necessary files
include('config.php');
include('header.php');

// Fetch all books from the database
$sql = "SELECT * FROM books";
$result = $conn->query($sql);

echo "<div class='book-list-container'>";
while ($row = $result->fetch_assoc()) {
    echo "<div class='book-item'>";
    echo "<h3>" . $row['book_name'] . "</h3>";
    echo "<p>Author: " . $row['author_name'] . "</p>";
    echo "<p>Genre: " . $row['genre'] . "</p>";
    echo "<p>Available Quantity: " . $row['available_quantity'] . "</p>";
    echo "<p><strong>Book ID:</strong> " . $row['book_id'] . "</p>";  // Display the Book ID

    // Only show the request button if there are available books
    if ($row['available_quantity'] > 0) {
        echo "<form action='book_request.php' method='POST' onsubmit='return showRequestPopup(event, " . $row['book_id'] . ");'>";
        echo "<input type='hidden' name='book_id' value='" . $row['book_id'] . "'>";
        echo "<button type='submit' class='btn-primary'>Request Book</button>";
        echo "</form>";
    } else {
        echo "<p>Out of Stock</p>";
    }

    echo "</div>";
}
echo "</div>";
?>
<div class="background"></div>
<!-- Popup Modal for Request Sent -->
<div id="requestPopup" class="popup">
    <div class="popup-content">
        <span class="close" onclick="closePopup();">&times;</span>
        <p>Request Sent Successfully!</p>
    </div>
</div>

<script>
    function showRequestPopup(event, bookId) {
        // Prevent form submission to show popup
        event.preventDefault();

        // Show the popup
        document.getElementById("requestPopup").style.display = "block";

        // Submit the form after the popup is shown
        setTimeout(function() {
            event.target.submit(); // Submit the form that triggered the event
        }, 1500);
    }

    function closePopup() {
        document.getElementById("requestPopup").style.display = "none";
    }
</script>

<style>
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
    /* General Book List Styles */
    .book-list-container {
        display: flex;
        flex-wrap: wrap;
        gap: 30px;
        justify-content: center;
        margin-top: 20px;
        padding: 20px;
    }

    .book-item {
        background-color: rgba(255, 255, 255, 0.85);
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        width: 250px;
        text-align: center;
        transition: all 0.3s ease;
    }

    .book-item:hover {
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.4);
    }

    .book-item h3 {
        font-size: 20px;
        color: #34495e;
        margin-bottom: 10px;
    }

    .book-item p {
        font-size: 16px;
        color: #34495e;
        margin: 5px 0;
    }

    .book-item .btn-primary {
        background-color: #28a745;
        border-color: #28a745;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .book-item .btn-primary:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    /* Popup Modal Styles */
    .popup {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .popup-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        text-align: center;
        border-radius: 10px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    }

    .popup .close {
        color: #aaa;
        font-size: 28px;
        font-weight: bold;
        position: absolute;
        top: 0;
        right: 15px;
        cursor: pointer;
    }

    .popup .close:hover,
    .popup .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>