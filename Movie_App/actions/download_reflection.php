<?php
require_once '../settings/connection.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reflection_id = $_POST['reflection_id'];

    // Query to retrieve reflection data based on ID
    $query = "SELECT * FROM movie_reflections WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $reflection_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $reflection = $result->fetch_assoc();

        // Generate a filename for the downloaded file (e.g., using movie title)
        $filename = $reflection['movie_title'] . ".txt";

        // Set appropriate headers for download
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Type: text/plain');

        // Constructing the content to be downloaded (including reflection, areas to improve, and areas to desist)
        $content = "Movie Title: " . $reflection['movie_title'] . "\n\n";
        $content .= "Reflection: \n" . $reflection['reflection'] . "\n\n";
        $content .= "Areas to Improve: \n" . $reflection['improvement_areas'] . "\n\n";
        $content .= "Areas to Desist: \n" . $reflection['areas_to_desist'];

        // Output content for download
        echo $content;

        // Terminate script execution
        exit();
    } else {
        echo "Reflection not found.";
    }
} else {
    // Redirect or display error if accessed through invalid method
}
