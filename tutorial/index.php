<?php
require('../connect.php');

if(isset($_POST['submit'])) {
    $score = $_POST['highscore'];
    $token = getToken();

    $sql = 'UPDATE users SET highscore = GREATEST(?, highscore) WHERE token = ?';
    $stmt = $dbh->prepare($sql);
    if($stmt->execute(array($score, $token))) {
        //SUCCESS
    }
}

function getHighScore($conn) {
    $token = getToken();
    $sql = 'SELECT highscore FROM users WHERE token = ?';
    $stmt = $conn->prepare($sql);
    if($stmt->execute(array($token))) {
        $row = $stmt->fetch();
        if($row['highscore'] != null) {
            setcookie('highscore', $row['highscore'], 0, "/");
            return $row['highscore'];
        }
        else {
            return 0;
        }
    }
}

function getToken() {
    if (isset($_COOKIE['token'])) {
        return $_COOKIE['token'];
    }
    else {
        header('location:/StayWoke/login/');
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Stay Woke</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script type="text/javascript" src="..js/engine/Engine.js"></script>
    <script type="text/javascript" src="..js/engine/Vector.js"></script>
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
            <img src="../res/stay_woke_logo.png" height="80px" width="80px">
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><a href="../index.php">Home</a></li>
                <li class="active"><a>How to play</a></li>
                <li><a href="../highscores/">High scores</a></li>
                <li><a href="../shop/">Shop</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="../register/">Register</a></li>
                <li><a href="../login/"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-log-out" >Logout</a></li>
            </ul>
        </div>
    </div>
</nav>
<div style="margin-right: auto; margin-left: auto; -webkit-animation: fadein 0.8s;">
    <h1 style="text-align: center; font-family: 'OCR A Std'">
        Controls
    </h1>
    <div style="margin-left: 30px; margin-right: auto;">
    <h3 style="font-size: 50px; text-align: center" class="glyphicon glyphicon-arrow-left">
        <p style="font-size: 15px; font-family: 'OCR A Std'; background-color: lightsteelblue">
        Use the "A" key to move left.
        </p>
    </h3>

    <h3 style="font-size: 50px; text-align: center; margin-left: 200px" class="glyphicon glyphicon-arrow-right">
        <p style="font-family: 'OCR A Std'; font-size: 15px; background-color: lightsteelblue">
            Use the "D" key to move right.
        </p>
    </h3>

    <h3 style="font-size: 50px; text-align: center; margin-left: 150px;" class="glyphicon glyphicon-arrow-up">
        <p style="font-family: 'OCR A Std'; font-size: 15px; background-color: lightsteelblue">
            Use the "space bar" key to jump.
        </p>
    </h3>

    </div>
</div>
<script src="../js/Game.js"></script>
<footer>
    <p style="background-color: black; color: white; text-align: center; font-family: 'OCR A Std'">
        &copy; Stay Woke 2016
    </p>
</footer>
</body>
</html>
