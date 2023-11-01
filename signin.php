<?php
include("db_config.php");

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the login form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST["email"];
    $password = $_POST["password"];

    // You should perform additional validation and sanitization of the data here

    // Retrieve user data from the database
    $sql = "SELECT email, password FROM user WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Verify the hashed password
        if (password_verify($password, $user["password"])) {
            // Login successful
            echo "Login successful! Welcome, " . $user["email"];
        } else {
            // Password is incorrect
            echo "Incorrect password.";
        }
    } else {
        // User not found
        echo "User not found.";
    }
    
    // Close the database connection
    $conn->close();
}
?>
