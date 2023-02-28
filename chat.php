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
        .chat-area header{
            display: flex;
            align-items: center;
            padding: 18px 30px;
        }
        .chat-area header img{
            height: 45px;
            width: 45px;
            margin: 0 15px;
        }
        .chat-area header span{
            font-size: 17px;
            font-weight: 500;
        }
         .chat-area header .back-icon{
             font-size: 18px;
             color: #333;
         }
         .chat-box{
             height: 500px;
             overflow-y: auto;
             background: #f7f7f7;
             padding: 10px 30px 20px 30px;
             box-shadow:  inset 0 32px 32px -32px rgb(0 0 0 / 5%),
                         inset 0 -32px 32px -32px rgb(0 0 0 / 5%);
         }
         .chat-box::-webkit-scrollbar{
             width: 0px;
         }
         .chat-box .outgoing{
             display: flex;
         }
         .outgoing .details p{
             background: #333;
             color: #fff;
             border-radius: 18px 18px 0 18px;
         }
         .outgoing .details {
             margin-left: auto;
             max-width: calc(100% - 130px);
         }
         .chat-box .chat{
             margin: 15px 0;
         }
         .chat-box .chat p{
             word-wrap: break-word;
             padding: 8px 16px;
             box-shadow: 0 0 32px rgb(0 0 0 / 8%),
                         0 16px 16px -16px rgb(0 0 0 / 10%); 
         }

         .chat-box .incoming{
             display: flex;
             align-items: flex-end;
         }
         .chat-box .incoming img{
             height: 35px;
             width: 35px;
         }
         .incoming .details{
             background: #fff;
             color: #333;
             border-radius: 18px 18px 0 18px;
         }
         .incoming .details{
             margin-left: 10px;
             margin-right: auto;
             max-width: calc(100% - 130px);
         }
         .chat-area .typing-area{
             padding: 18px 30px;
             display: flex;
             justify-content: space-between;
         }
         .typing-area input{
             height: 45px;
             width: calc(100% - 58px);
             font-size: 17px;
             border: 1px solid #ccc;
             padding: 0 13px;
             border-radius: 5px;
             outline: none;
         }
         .typing-area button{
             width: 55px;
             border: none;
             outline: none;
             background: #333;
             color: #fff;
             font-size: 19px;
             cursor: pointer;
             border-radius: 0 5px 5px 0;
         }
    </style>
</head>

<body>
    <div class="wrapper">
        <section class="chat-area">
            <header>
                <a href="#" class="back-icon"><i class="fa fa-arrow-left"></i></a>
                <img src="dog.gif" alt="">
                <div class="details">
                    <span>Coding Nepal</span>
                    <p>Active Now</p>
                </div>
            </header>
            <div class="chat-box">
                <div class="chat outgoing">
                    <div class="details">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>
                    </div>
                </div>
                <div class="chat incoming">
                    <img src="dog.gif" alt="">
                    <div class="details">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                </div>
            </div>
            <form action="#" class="typing-area">
                <input type="text" placeholder="Type a message heree...">
                <button><i class="fa fa-telegram-plane"></i></button>
            </form>
        </section>
    </div>
</body>

</html>