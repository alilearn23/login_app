<?php
$conn = mysqli_connect('webappdb', '${MYSQL_USER}', '${MYSQL_PASSWORD}', '${MYSQL_DATABASE}');

if($conn == false){
    die("ERROR - Could not connect: " . mysqli_connect_error());
}
?>