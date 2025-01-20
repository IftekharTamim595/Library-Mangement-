<?php include('header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Book</title>
</head>
<body>
    <div class="background"></div>
    <div class="container">
        <div class="form-container">
            <h2>Add a Book</h2>
            <form action="process_book.php" method="POST" id="addBookForm" onsubmit="return showPopup();">
                <div class="form-group">
                    <label for="bookTitle">Book Title</label>
                    <input type="text" id="bookTitle" name="bookTitle" required>
                </div>
                <div class="form-group">
                    <label for="author">Author</label>
                    <input type="text" id="author" name="author" required>
                </div>
                <div class="form-group">
                    <label for="genre">Genre</label>
                    <input type="text" id="genre" name="genre" required>
                </div>
                <div class="form-group">
                    <label for="quantity">Total Quantity</label>
                    <input type="number" id="quantity" name="quantity" required>
                </div>
                <button type="submit" class="btn-primary">Add Book</button>
            </form>
        </div>
    </div>

    <!-- Popup Modal -->
    <div id="popup" class="popup">
        <div class="popup-content">
            <span class="close" onclick="closePopup();">&times;</span>
            <p>Book added successfully!</p>
        </div>
    </div>

    <script>
        function showPopup() {
            // Prevent form submission to stay on the same page
            event.preventDefault();

            // Show the popup
            document.getElementById("popup").style.display = "block";

            // Simulate form submission using AJAX or update database after this (e.g., using process_book.php)

            // After showing popup, submit the form using AJAX or directly after a few seconds
            setTimeout(function() {
                document.getElementById('addBookForm').submit(); // Actually submit the form
            }, 1500); // delay 1.5 seconds
        }

        function closePopup() {
            document.getElementById("popup").style.display = "none";
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
        body {
            background-image: url('https://i.ibb.co/v1ThJhG/bg-01.jpg');
            background-size: cover;
            background-position: center;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        h1 {
            font-family: 'Roboto', sans-serif;
            text-align: center;
            font-size: 60px;
            color: #ffffff;
            margin-top: 30px;
            margin-bottom: 30px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 3px;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
            line-height: 1.2;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            width: 100%;
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.85);
            padding: 50px 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 380px;
            animation: fadeIn 1s ease-out;
            position: relative;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-container h2 {
            text-align: center;
            color: #34495e;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .form-group {
            position: relative;
            margin-bottom: 20px;
        }

        .form-group input {
            font-size: 16px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #bdc3c7;
            width: 100%;
            box-sizing: border-box;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-group input:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            padding: 12px;
            border-radius: 5px;
            font-size: 16px;
            width: 100%;
            margin-top: 20px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
            transform: scale(1.05);
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
</body>
</html>
