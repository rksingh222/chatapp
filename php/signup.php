<?php
session_start();
include_once "config.php";

$fname = mysqli_real_escape_string($conn, $_POST['fname']);
$lname = mysqli_real_escape_string($conn, $_POST['lname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

global $conn;
if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        //lets check that email already exist in the database or no
        $sql = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'");
        if(mysqli_num_rows($sql) > 0){
            echo "$email - this email already exist";
        }else{
            //lets check user upload file or not
            if(isset($_FILES['image'])){
                $img_name = $_FILES['image']['name'];
                $img_type = $_FILES['image']['type'];
                $tmp_name = $_FILES['image']['tmp_name'];

                //let's explode image and get the last extension like jpg and png
                $img_explode = explode('.', $img_name);
                $img_ext = end($img_explode);
                $extensions = ['png', 'jpeg', 'jpg']; //these are some valid extensions
                if(in_array($img_ext, $extensions) === true){ // if user uploaded image satisfies the exxtensions
                    $time = time(); // this will return us current time
                    
                    $new_img_name = $time . $img_name;
                   
                    if( move_uploaded_file($tmp_name, "images/".$new_img_name)){ //if user upload img move to our folder successfully
                        $status = "Active now"; //once user signed up then his status will be active now
                        $random_id = rand(time(), 10000000);
                        //echo "$random_id - unique id, $lname - lname, $fname - fname, $email - email, $password - password, $new_img_name - img, $status - status";
                        $sql2 = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, image, status)
                                                   VALUES ({$random_id},'{$fname}','{$lname}','{$email}','{$password}', '{$new_img_name}','{$status}')");
                        if($sql2){ // if these data inserted
                            $sql3 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                            if(mysqli_num_rows($sql3) > 0){
                                $row = mysqli_fetch_assoc($sql3);
                                $_SESSION['unique_id'] = $row['unique_id']; //using this session we used unique_id in other php file
                                echo "success";   
                         }

                        }else{
                            echo("Error description: " . $conn -> error);
                            //echo "Something went wrong";
                        }
                    }
                    
                }else{
                    echo "Please select an image file - jpeg, jpg, png";
                }
            }
        }

    }else{
        echo "$email - this is not a valid email";
    }
}else{
    echo "All input field are required!";
}