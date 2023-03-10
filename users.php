<?php 
session_start();
if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            text-decoration: none;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: #f7f7f7;
        }

        .wrapper {
            background: #fff;
            width: 450px;
            box-shadow: 0 0 128px 0 rgba(0, 0, 0, 0.1),
                0 32px 64px -48px rgba(0, 0, 0, 0.5);
            border-radius: 16px;

        }

        .users {
            padding: 25px 30px;
        }

        .users header ,.users-list a{
            display: flex;
            align-items: center;
            padding-bottom: 20px;
            justify-content: space-between;
            border-bottom: 1px solid #e6e6e6;
        }

        .wrapper img {
            object-fit: cover;
            border-radius: 50%;
        }

        :is(.users, .users-list) .content{
            display: flex;
            align-items: center;
        }

        .users header .content img {
            height: 50px;
            width: 50px;
        }

        :is(.users, .users-list)  .details {
            color: #000;
            margin-left: 15px;
        }

        :is(.users, .users-list)  .details span {
            font-size: 18px;
            font-weight: 500;
        }

        .users header .logout {
            color: #fff;
            font-size: 17px;
            padding: 7px 15px;
            background: #333;
            border-radius: 5px;
        }

        .users .search {
            margin: 20px 0;
            display: flex;
            position: relative;
            align-items: center;
            justify-content: space-between;
          
        }

        .users .search .text {
            font-size: 18px;
        }

        .users .search input {
            position: absolute;
            height: 42px;
            width: calc(100% - 50px);
            border: 1px solid #ccc;
            padding: 0 13px;
            font-size: 16px;
            border-radius: 5px 0 0 5px;
            outline: none;
            opacity: 0;
            pointer-events: none;
            transition: all 0.3s ease;
        }
        .users .search input.active{
            opacity: 1;
            pointer-events: auto;
        }

        .users .search button {
            width: 47px;
            height: 42px;
            border: none;
            outline: none;
            color: #333;
            background: #fff;
            cursor: pointer;
            font-size: 17px;
            border-radius: 0 5px 5px 0;
        }
        .users .search button.active {
            color: #fff;
            background: #333;
        }
        .users .search button.active i::before{
            content: "\f00d";
        }
        .users-list{
            max-height: 350px;
            overflow-y: auto;
        }
        .users-list::-webkit-scrollbar{
            width: 0px;
        }
        .users-list a .content img{
            height: 40px;
            width: 40px;
        }
        .users-list a .status-dot{
            font-size: 12px;
            color: #468669;
        }
        /* we use this class name in php to show offline status */
        .users-list a .status-dot.offline{
            color: #ccc;
        }
        .users-list a{
            margin-bottom: 15px;
            page-break-after: 10px;
            padding-right: 15px;
            border-bottom-color: #f1f1f1;
        }
        .users-list a .content p{
            color: #67676a;
        }
        .users-list a:last-child{
            border: none;
            margin-bottom: 0px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <section class="users">
            <header>
                <?php 
                   include_once "php/config.php";
                   $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
                   if(mysqli_num_rows($sql) > 0){
                       $row = mysqli_fetch_assoc($sql);
                   }
                ?>
                <div class="content">
                    <img src="php/images/<?php echo $row['image']?>" alt="">
                    <div class="details">
                        <span><?php echo $row['fname'] . " " . $row['lname'] ?></span>
                        <p><?php echo $row['status'] ?></p>
                    </div>
                </div>
                <a href="#" class="logout">Logout</a>
            </header>
            <div class="search">
                <span class="text">Select an user to start chat</span>
                <input type="text" placeholder="Enter name to search...">
                <button><i class="fa fa-search"></i></button>
            </div>
            <div class="users-list">
               
                
            </div>
        </section>
    </div>
    
    <script>
        const searchBar = document.querySelector(".users .search input");
        const searchBtn = document.querySelector(".users .search button");
        usersList = document.querySelector(".users .users-list");

        searchBtn.onclick = ()=>{
            searchBar.classList.toggle("active");
            searchBar.focus();
            searchBtn.classList.toggle("active");
        }

        searchBar.onkeyup = ()=>{
           
            
            let searchTerm = searchBar.value;
             
            if(searchTerm != ""){
                searchBar.classList.add("active");
            }else{
                searchbar.classList.remove("active");
            }

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "php/search.php", true);
            xhr.onload = ()=>{
                if(xhr.readyState === XMLHttpRequest.DONE){
                    if(xhr.status === 200){
                        let data = xhr.response;
                        //console.log(data);
                        usersList.innerHTML = data;
                    }
                }
            }
            //we have to send form data through ajax to php

            xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            xhr.send("searchTerm=" + searchTerm); 
        }

        setInterval(() => {
        
            let xhr = new XMLHttpRequest();
            xhr.open("GET", "php/users.php", true);
            xhr.onload = ()=>{
                if(xhr.readyState === XMLHttpRequest.DONE){
                    if(xhr.status === 200){
                        let data = xhr.response;
                        //console.log(data);
                        if(!searchBar.classList.contains("active")){ //if active not conatins in search bar class then add this
                            usersList.innerHTML = data;
                        }

                    }
                }
            }
            //we have to send form data through ajax to php

           
            xhr.send(); // sending the form data to php

        }, 500);
    </script>
</body>

</html>