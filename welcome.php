<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            /* color: #333;
            background-color: #f5f5f5; */
            text-align: center; /* Center-align the entire content */
        }

        h1 {
            color: #000000;
        }
        p {
            font-size: 1.5rem;
            font-weight: 600;
            color: #000000;
        }
        a{
            position: absolute;
            bottom: 15%;
            right: 15%;
            color: white;
            font-size: 2rem;
            
        }


        .content-container {
            width: 50%;
            height: 25vh;
            margin: 50px auto; /* Center-align the container */
            padding: 20px;
            background-color: white ;
            border-radius: 30px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <?php
    session_start();
    if (isset($_SESSION["user"])) {
        $user = $_SESSION["user"];
        echo "<div class='content-container'>";
        echo "<h1>Welcome, " . $user["fullName"] . "!</h1>";
        echo "<p>Your email: " . $user["email"] . "</p>";
        echo "<p>Your mobile: " . $user["mobile"] . "</p>";
        echo "</div>";
    } else {
        header("Location: login.html"); // Redirect to login if not authenticated
    }
    ?>
    <a href="logout.php">Logout</a>
</body>
</html>
