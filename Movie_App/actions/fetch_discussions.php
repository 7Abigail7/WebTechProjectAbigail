<?php
// fetch_discussions.php

// Include database connection
include '../settings/connection.php';

// Fetch discussions from the database including Title and Content columns
$sql = "SELECT DiscussionID, Title, Content, CreatedAt FROM Discussions ORDER BY CreatedAt DESC"; // Adjusted SQL query
$result = $conn->query($sql);

$discussions = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $discussions[] = $row;
    }
}

// Return discussions as JSON response
echo json_encode($discussions);

// Close database connection
$conn->close();
