<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link href="https://fonts.googleapis.com/css?family=Itim|Pridi|Taviraj|Trirong" rel="stylesheet">
        <title>คำขวัญประจำจังหวัด</title>

        <style>
            body {
                background: url(IMG_139311.jpg) no-repeat center fixed; 
                background-size: cover;
            }

            div.container {
                padding-left: 185px;
                width: 70%;
                /*border: 1px solid bisque;*/
            }

            header {
                clear: left;
                padding: 1em;
                background: url(pink-curves-wallpaper-3.jpg) no-repeat center;
                background-size: cover;
                color: darkblue;
                text-align: center;
                /*width: 1000px;*/
                font-family: 'Pridi', serif;
                font-size: 40px;
                letter-spacing: 3px;
            }
           
            h2{
                color: darkblue; 
                font-size: 40px;
            }

            p {
                color: darkblue; 
                font-size: 26px;
            }

            .slogan {
                text-align: center;
                background: url(pinkback.png);  
                margin-top: 0px;
                padding: 20px;
            }

        </style>
    </head>
    <body>
        <?php
        // put your code here
        session_start();
        ?>

        <div class="container">
            <header class="head">
                <h1>คำขวัญประจำจังหวัด</h1>
            </header>

            <div class="slogan">
                <h2 id="provi"><?php echo $_SESSION["province"] ?></h2>
                <img id="provImg" src="<?php echo $_SESSION["picture"] ?>" alt="Picture Slogan" style="width:200px;height:200px;text-align:center;">
                <p id="sloganText"><?php readfile($_SESSION["slogan"]) ?></p>
            </div>
    </body>
</html>
