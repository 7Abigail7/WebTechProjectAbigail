<?php
// create_discussion.php

// Include database connection
include '../settings/connection.php';

// Check if form data is received
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize form data
    $title = isset($_POST['discussionTitle']) ? htmlspecialchars($_POST['discussionTitle']) : '';
    $content = isset($_POST['discussionContent']) ? htmlspecialchars($_POST['discussionContent']) : '';

    // Prepare and execute SQL statement to insert discussion
    $sql = "INSERT INTO Discussions (Title, Content, CreatedAt) VALUES (?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $title, $content);

    $response = [];
    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = "Discussion created successfully";
    } else {
        $response['success'] = false;
        $response['error'] = $conn->error;
    }

    // Output JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
}



