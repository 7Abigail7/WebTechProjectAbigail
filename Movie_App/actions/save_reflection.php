<?php
include '../settings/connection.php';

// Echo or log the request method
echo "Request method: " . $_SERVER["REQUEST_METHOD"];

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission
    $movieTitle = isset($_POST['movie_title']) ? $_POST['movie_title'] : '';
    $reflection = isset($_POST['reflection']) ? $_POST['reflection'] : '';
    $improvementAreas = isset($_POST['improvement_areas']) ? $_POST['improvement_areas'] : '';
    $areasToDesist = isset($_POST['areas_to_desist']) ? $_POST['areas_to_desist'] : '';

    // Prepare and execute SQL statement
    $sql = "INSERT INTO movie_reflections (movie_title, reflection, improvement_areas, areas_to_desist) VALUES ('$movieTitle', '$reflection', '$improvementAreas', '$areasToDesist')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    // If the request method is not POST, display an error message
    echo "Form submission method not allowed";
}

// Close connection
$conn->close();
