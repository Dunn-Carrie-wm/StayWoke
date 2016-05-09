<?php
//require('connect.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Stay Woke</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="css/style.css">
<script type="text/javascript" src="js/engine/Engine.js"></script>
<script type="text/javascript" src="js/engine/Vector.js"></script>
<script type="text/javascript" src="js/engine/Entity.js"></script>
</head>
<body onload="main()">
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <img src="res/stay_woke_logo.png" height="80px" width="80px"></img>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="active"><a href="">Home</a></li>
                <li><a href="register/">Register</a></li>
                <li><a href="highscores/">High scores</a></li>
                <li><a href="shop/">Store</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="login/"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-log-out" >Logout</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="content">

   <div id="game">

       <div id="blackout">
           <p>You Died</p>
           <br>
           <p onclick="location.reload();">Retry?</p>
       </div>

       <canvas id="canvas"></canvas>

   </div>


</div>

<script src="js/Game.js"></script>
<footer>
    <p style="background-color: black; color: white; text-align: center">
        &copy; Stay Woke 2016
    </p>
</footer>
</body>
</html>
