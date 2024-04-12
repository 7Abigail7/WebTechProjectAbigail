<?php
$host ='localhost';
$username ='root';
$password = '';
$database ='movie_db';
    
//Establish database connection
$conn = new mysqli($host, $username, $password, $database);

//Check if connection was successful
if($conn->connect_error){
    die("Connection failed: ".$conn->connect_error);
}

?>
