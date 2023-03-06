<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            text-decoration: none;
        }
        body{
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: #f7f7f7;
        }
        .wrapper{
            background: #fff;
            width: 450px;
            box-shadow: 0 0 128px 0 rgba(0, 0, 0, 0.1),
                        0 32px 64px -48px rgba(0,0,0,0.5);
            border-radius: 16px;

        }
        .form{
            padding: 25px 30px;
        }
        .form header{
            font-size: 25px;
            font-weight: 600;
            padding-bottom: 10px;
            border-bottom: 1px solid #e6e6e6;
        }
        .form form{
            margin: 20px 0;
        }
        .form form .error-txt{
            color: #721c24;
            background: #f8d7da;
            padding: 8px 10px;
            text-align: center;
            border-radius: 5px;
            margin-bottom: 10px;
            border: 1px solid #f5c6cb;
            display: none;
        }
        .form form .field{
            display: flex;
            flex-direction: column;
            margin-bottom: 10px;
            position: relative;
        }
        .form form .field label{
            margin-bottom: 2px;
        }
        .form form .field input{
            outline: none;
        }
        .form form .input input {
            height: 40px;
            width: 100%;
            font-size: 16px;
            padding: 0 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form form .image input{
            font-size: 17px;
        }
        .form form .button input{
            margin-top: 13px;
            height: 45px;
            border: none;
            font-size: 17px;
            font-weight: 400;
            background: #333;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
        }
        .form form .field i{
            position: absolute;
            right: 15px;
            color: #ccc;
            top: 70%;
            transform: translateY(-50%);
            cursor: pointer;
        }
        .form form .field i.active::before{
            content: "\f070";
            color: #333;
        }
        .form .link{
            text-align: center;
            margin: 10px 0;
            font-size: 17px;
        }
        .form .link a{
            color: #333;
        }
        .form .link a:hover{
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <section class="form signup">
            <header>Realtime Chat App</header>
            <form action="#">
            <div class="error-txt">This is an error message!</div>
            <div class="name-details">
                <div class="field input">
                    <label>First Name</label>
                    <input type="text" name="fname" placeholder="First Name" required>
                </div>
                <div class="field input">
                    <label>Last Name</label>
                    <input type="text" name="lname" placeholder="Last Name" required>
                </div>
                <div class="field input">
                    <label>Email Address</label>
                    <input type="text" name="email" placeholder="Enter your email" required>
                </div>
                <div class="field input">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter new password" required>
                    <i class="fa fa-eye"></i>
                </div>
                <div class="field image">
                    <label>Select Image</label>
                    <input type="file" name="image" required>
                </div>
                <div class="field button">
                    <input type="submit" value="Continue to Chat">
                </div>
                <div class="link">Already signed up ?<a href="login.php">Login Now</a></div>
            </div>
           </form>
        </section>
    </div>
    <script>
       /* const pswrdField = document.querySelector(".form input[type='password']");
        const toggleBtn = document.querySelector(".form .field i");
        toggleBtn.onclick = ()=>{
            if(pswrdField == "password"){
                pswrdField.type = "text";
                toggleBtn.classList.add("active");
            }else{
                pswrdField.type = "password";
                toggleBtn.classList.remove("active");
            }
        }*/

        const form = document.querySelector(".signup form");
        const continueBtn = form.querySelector(".button input");
        const errorText = form.querySelector(".error-txt");
        
        form.onsubmit = (e)=>{
            e.preventDefault(); //preventing form from submitting
        }

        continueBtn.onclick = ()=>{
            console.log("hello");
            //let's start Ajax
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "php/signup.php", true);
            xhr.onload = ()=>{
                if(xhr.readyState === XMLHttpRequest.DONE){
                    if(xhr.status === 200){
                        let data = xhr.response;
                        console.log(data);
                        if(data == "success"){
                            location.href = "users.php";
                        }else{
                            errorText.textContent = data;
                            errorText.style.display = "block";
                        }
                    }
                }
            }
            //we have to send form data through ajax to php

            let formData = new FormData(form); //create new FormData object
            xhr.send(formData); // sending the form data to php
        }

    </script>
</body>
</html>