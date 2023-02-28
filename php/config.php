<?php
$conn = mysqli_connect("127.0.0.1", "root","Rahul22-2-85", "chat");
if(!$conn){
    echo "Database connected" . mysqli_connect_error();
}