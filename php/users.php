<?php
session_start();
include_once "config.php";
$sql = mysqli_query($conn, "SELECT * FROM users");
$outgoing_id = $_SESSION['unique_id'];
$output = "";

if(mysqli_num_rows($sql) == 1){
    $output = "No users are available to chat";
}elseif(mysqli_num_rows($sql) > 0){
    include "data.php";
}
echo $output;