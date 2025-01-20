<?php
// Include database connection
include('config.php');

// Fetch librarian details from the database
$sql = "SELECT * FROM users WHERE user_type = 'librarian'";
$result = mysqli_query($conn, $sql);

// Check if there are any librarians in the database
if (mysqli_num_rows($result) > 0) {
    // Fetch all librarian details
    $librarians = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $librarians = [];
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Librarian</title>
    <style>
        /* General Styles */
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f8f9fa;
            color: #34495e;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            /* background-image: url('https://i.ibb.co/v1ThJhG/bg-01.jpg'); Background Image */
            background-size: cover;
            background-position: center;
        }
        .background {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    min-height: 100vh; /* Ensure background fills the entire height */
    background-image: url('https://i.ibb.co/2dz9r5m/463106311-3980577685509368-7328189217719667629-n.jpg'); /* Your Background Image */
    background-size: cover;
    background-position: center;
    filter: blur(8px); /* Apply the blur effect */
    z-index: -1; /* Ensure background is behind content */
}

        .container {
            text-align: center;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 800px;
        }
        h1 {
            margin-bottom: 20px;
            color:white;
            shadow: 1px;
        }
        .librarian-card {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .librarian-card h2 {
            margin: 10px 0;
            font-size: 20px;
        }
        .librarian-card p {
            margin: 5px 0;
            font-size: 16px;
        }
        .contact-button {
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .contact-button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
<div class="background"></div>
<div>
    <h1>Contact Librarian</h1>

    <?php if (count($librarians) > 0): ?>
        <?php foreach ($librarians as $librarian): ?>
            <div class="librarian-card">
                <h2><?php echo $librarian['username']; ?></h2>
                <p>Email: <?php echo $librarian['email']; ?></p>
                <p>Phone: <?php echo isset($librarian['phone']) ? $librarian['phone'] : 'N/A'; ?></p>
                <button class="contact-button" onclick="window.location.href='mailto:<?php echo $librarian['email']; ?>'">Contact</button>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No librarians found.</p>
    <?php endif; ?>

</div>

</body>
</html>
