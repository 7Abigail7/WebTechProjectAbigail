<?php
require_once '../settings/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['r_id'])&& isset($_POST['edit'])){
    $ref_id = $_POST['r_id'];
    $reflection = $_POST['reflection'];
    $movie_title = $_POST['movie_title'];
    $improvement_areas = $_POST['improvement_areas'];
    $areas_to_desist = $_POST['areas_to_desist'];

    $query = "UPDATE movie_reflections SET reflection = ?, movie_title = ?, improvement_areas = ?,areas_to_desist = ? WHERE id = ?";
    $stmt=$conn->prepare($query);
    $stmt->bind_param('issss',$ref_id,$reflection,$movie_title,$improvement_areas,$areas_to_desist);
    $stmt->execute();
    if($stmt){
        $_SESSION['success'] = "reflection updated";
        header ('Location: ../view/reflect.php');
    }
    // elseif ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['r_id'])){
    //     $ref_id = $_POST['r_id'];
    //     $query = "SELECT * FROM movie_reflections WHERE id = ?";
    //     $stmt = $conn->prepare($query);
    //     $stmt->bind_param('i', $ref_id);                                           
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     var_dump($result);
    // }
    //     if ($result->num_rows==1) {
    //     $reflection = $result->fetch_assoc();
    //     var_dump($reflection);
    //         // $_SESSION['relection'] = $reflection;
    //         //  $reflection =  $_SESSION['movie_title'] ;
    //         //  $reflection =  $_SESSION['improvement_areas'];
    //         //  $reflection = $_SESSION['areas_to_desist'];

    //         header('Location: ../view/update.php');
    //     } else {
    //         $_SESSION['message']='No reflection';
    //     }


}
?>

