<?php
include 'db_connect.php';

session_start();

// Redirect to login if user is not authenticated
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Learn Play</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body, html {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #fdeff4, #f6f4d2);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .wrapper {
            text-align: center;
        }

        h1 {
            font-family: 'Press Start 2P', cursive;
            font-size: 48px;
            color: #0095A9;
            margin-bottom: 50px;
        }

        .welcome {
            font-size: 20px;
            color: #555;
            margin-bottom: 30px;
        }

        .button-container {
            display: inline-flex;
            flex-direction: column;
            gap: 20px;
        }

        .btn {
            font-family: 'Press Start 2P', cursive;
            font-size: 20px;
            padding: 20px;
            border: none;
            border-radius: 25px;
            background-color: #0095A9;
            color: white;
            width: 300px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: left;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1);
            gap: 20px;
            padding-left: 30px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .btn:hover {
            background-color: #007a8c;
            transform: translateY(-5px);
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
        }

        .btn img {
            width: 40px;
            height: 40px;
        }

        .btn:focus {
            outline: none;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h1>Learn Play</h1>
        <p class="welcome">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
        <div class="button-container">
            <button class="btn" onclick="window.location.href='play.html'">
                <img src="book.png" alt="Play Icon"> Play
            </button>
            <button class="btn" onclick="window.location.href='profile.html'">
                <img src="profile.png" alt="Profile Icon"> Profile
            </button>
            <button class="btn" onclick="window.location.href='logout.php'">
                <img src="logout.png" alt="Logout Icon"> Logout
            </button>
        </div>
    </div>
</body>
</html>
