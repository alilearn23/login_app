<?php
$conn = mysqli_connect('webappdb', getenv('MYSQL_USER'), getenv('MYSQL_PASSWORD'), getenv('MYSQL_DATABASE'));

if($conn == false){
    die("ERROR - Could not connect: " . mysqli_connect_error());
}
?>