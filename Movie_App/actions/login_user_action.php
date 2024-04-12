<?php
session_start();

include '../settings/connection.php';

// Check if login button was clicked
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Collect form data and store in variables
    $Email = $_POST['email'];
    $Username = $_POST['username']; 
    $Password = $_POST['password'];
    
    // Write a query to SELECT a record from the user table based on email or username
    $sql = "SELECT UserID, Password FROM users WHERE Email = ?";
    
    // Prepare the statement
    $stmt = $conn->prepare($sql);
    
    // Bind parameters
    $stmt->bind_param("s", $Email);
    
    // Execute the query
    $stmt->execute();
    
    // Store the result
    $result = $stmt->get_result();
    
    // Check if any row was returned
    if ($result) 
    {
        // Bind the result variables
        $row = $result->fetch_assoc();
        $hashed = $row['Password'];
        $user_id = $row['UserID'];
        
        // Verify password user provided against database record using password_verify
        if (password_verify($Password, $hashed)) {
            // Password is correct, create session for user id
            $_SESSION['UserID'] = $user_id;
            // Redirect to home page 
            header("Location: ../view/home.php");
            exit(); // Exit after header redirect
        } else {
            // Incorrect password or email/username
            header("Location: ../login/login_view.php?error=password");
            exit();
        }
    } else {
        // No record found, provide appropriate response
        header("Location: ../login/login_view.php?error=user");
        exit();
    }
    
    // Close statement
    $stmt->close();
    
    // Close connection
    $conn->close();
} else {
    // Stop processing and provide appropriate message or direction
    header("Location: ../login/login_view.php");
    exit();
}
?>
