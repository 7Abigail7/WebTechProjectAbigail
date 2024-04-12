<?php
// Include the database connection file
include '../settings/connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Collect form data and assign each to a variable
    $FirstName = $_POST['fname'];
    $LastName = $_POST['lname'];
    $Email = $_POST['email'];
    $Username = $_POST['username']; 
    $Password = $_POST['password'];
    $hashed_Password = password_hash($Password, PASSWORD_DEFAULT); // Encrypt the password

    // Prepare and execute the SQL statement to insert a new user
    $sql = "INSERT INTO users (FirstName, LastName, Email, Username, Password) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $FirstName, $LastName, $Email, $Username, $hashed_Password); // Add an 's' for the username

    if ($stmt->execute()) {
        // Registration successful, redirect to login page
        header("Location: ../login/login_view.php?success=1");
        exit();
    } else {
        // Registration failed, display error message
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
