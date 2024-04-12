<?php
include('../settings/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userID = $_SESSION['userID']; // Assuming you have the user ID in the session
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];

    $sql = "SELECT * FROM users WHERE UserID = '$userID' AND current_password = '$currentPassword'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $sql_update = "UPDATE users SET new_password = '$newPassword' WHERE UserID = '$userID'";
        if ($conn->query($sql_update) === TRUE) {
            echo "success"; // Send success message back to JavaScript
        } else {
            echo "Error updating password: " . $conn->error;
        }
    } else {
        echo "Incorrect current password.";
    }
}

$conn->close();
?>
