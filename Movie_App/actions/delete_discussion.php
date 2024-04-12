<?php
// Include database connection
include '../settings/connection.php';

// Check if the ID parameter is provided in the URL
if (isset($_GET['id'])) {
    // Get the discussion ID from the URL parameter
    $discussionId = $_GET['id'];

    // Prepare SQL statement to delete the discussion
    $sql = "DELETE FROM discussions WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $discussionId);

    // Execute the SQL statement
    if ($stmt->execute()) {
        // Return JSON response with success message
        echo json_encode(["message" => "Discussion deleted successfully"]);
    } else {
        // Return JSON response with error message
        echo json_encode(["error" => "Failed to delete discussion"]);
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
} else {
    // Return JSON response with error message if ID parameter is not provided
    echo json_encode(["error" => "Discussion ID not provided"]);
}
?>
