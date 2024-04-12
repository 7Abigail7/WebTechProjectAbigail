<?php
require_once '../settings/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reflection_id'])) {
    $reflection_id = $_POST['reflection_id'];

    // Prepare and execute the DELETE statement
    $stmt = $conn->prepare("DELETE FROM movie_reflections WHERE id = ?");
    $stmt->bind_param("i", $reflection_id);
    $stmt->execute();

    // Redirect back to index.php after deletion
    header("Location: ../view/index.php");
    exit();
} else {
    // Redirect to index.php if no reflection ID is provided
    header("Location: ../view/index.php");
    exit();
}
