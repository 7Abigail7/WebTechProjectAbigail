<?php
// Include database connection
include '../settings/connection.php';

// Start session to access session variables
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // If the request method is POST, handle inserting new discussions

    // Get data from POST request
    $discussionTitle = $_POST['discussionTitle'] ?? '';
    $discussionBody = $_POST['discussionBody'] ?? '';

    // Insert discussion into the database
    $sql = "INSERT INTO Discussions (UserID, Title, Content, CreatedAt) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);

    // Get the user ID of the logged-in user from the session
    $loggedInUserID = $_SESSION['userID'];

    // Bind parameters and execute the statement
    $stmt->bind_param("iss", $loggedInUserID, $discussionTitle, $discussionBody);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Discussion created successfully"]);
    } else {
        echo json_encode(["error" => $stmt->error]);
    }

    $stmt->close();
} else {
    // Fetch all discussions from the database
    $sql = "SELECT DiscussionID, Title, Content, CreatedAt FROM Discussions";
    $result = $conn->query($sql);

    $discussions = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $discussions[] = $row;
        }
    }

    echo json_encode($discussions);
}

// Close database connection
$conn->close();
