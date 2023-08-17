<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    session_start();
    if (isset($_SESSION["user"]) && $_SESSION["user"]["email"] === "admin@example.com") {
        $conn = new mysqli("localhost", "root", "", "user_data");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            echo "<table class='table'>";
            echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Date Created</th><th>Last Login</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["fullName"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["dateCreated"] . "</td>";
                echo "<td>" . $row["lastLogin"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No users found.";
        }
        
        $conn->close();
    } else {
        header("Location: login.html");
    }
    ?>
    <div class="admin">
    <a href="logout.php" id="adm" >Logout</a>
    </div>
    
</body>
</html>
