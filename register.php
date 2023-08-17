<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to the database
    $conn = new mysqli("localhost", "root", "", "user_data");
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        echo "success";
    }
    
    $data = json_decode(file_get_contents("php://input"));
    $fullName = $data->fullName;
    $email = $data->email;
    $mobile = $data->mobile;
    $dob = $data->dob;
    $password = password_hash($data->password, PASSWORD_DEFAULT); 
    
    // Use prepared statement to insert data
    $stmt = $conn->prepare("INSERT INTO users (fullName, email, mobile, dob, passwordHash) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $fullName, $email, $mobile, $dob, $password);
    
    // if ($stmt->execute()) {
    //     echo json_encode(["success" => true]);
    // } else {
    //     echo json_encode(["success" => false]);
    // }
    if ($stmt->execute()) {
        echo "success"; // Send "success" response
    } else {
        echo "failure"; // Send "failure" response
    }
    
    $stmt->close();
    $conn->close();
}
?>
