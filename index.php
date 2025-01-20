<?php
// Start session to check if user is logged in (optional, if needed)
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IIUC Library</title>
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
            height: 100vh;
        }

        /* Background Image with Blurry Effect */
        .background {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('https://i.ibb.co/2dz9r5m/463106311-3980577685509368-7328189217719667629-n.jpg'); /* Your Background Image */
            background-size: cover;
            background-position: center;
            filter: blur(8px);  /* Apply the blur effect */
            z-index: -1;  /* Make sure the background is behind other content */
        }

        /* Container for Content */
        .container {
            text-align: center;
            padding: 40px;
            background-color: rgba(255, 255, 255, 0.5);  /* Semi-transparent white background */
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 700px;
        }

        h1 {
            font-size: 36px;
            margin-bottom: 20px;
            color: #2980b9;
        }

        p {
            font-size: 18px;
            margin-bottom: 30px;
            color: #34495e;
        }

        .button {
            padding: 15px 30px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 18px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

<!-- Background Image -->
<div class="background"></div>

<div class="container">
    <h1>Welcome to IIUC Library</h1>
    <p>At IIUC Library, we provide a wide range of books and resources to support students in their academic pursuits. From textbooks to research materials, our library offers a wealth of information to help students succeed.</p>
    
    <p>Join us today by registering and gain access to a world of knowledge!</p>
    
    <!-- Register Button -->
    <a href="register.php" class="button">Register Now</a>
</div>

</body>
</html>
