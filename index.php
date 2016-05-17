<?php
require('connect.php');

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

    <link rel="stylesheet" type="text/css" href="css/style.css">
<script type="text/javascript" src="js/engine/Engine.js"></script>
<script type="text/javascript" src="js/engine/Vector.js"></script>
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
            <img src="res/stay_woke_logo.png" height="80px" width="80px">
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="active"><a href="">Home</a></li>
                <li><a href="tutorial/">How to play</a></li>
                <li><a href="highscores/">High scores</a></li>
                <li><a href="shop/">Shop</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="register/">Register</a></li>
                <li><a href="login/"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-log-out" >Logout</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="content">
   <div id="game">
       <div id="blackout">
           <p>Game Over</p>
           <p id="score">Score: 0</p>
           <p>Highscore: <?php echo getHighScore($dbh);?></p>
           <form id="scoreform" method="post" action="" style="display: none">
               <input type="hidden" id="highscore" name="highscore">
               <input style="width: 500px" type="submit" name="submit" value="Post Highscore">
           </form>
           <input style="width: 500px" type="button" onclick="location.reload();" value="Retry?">
       </div>

       <canvas id="canvas"></canvas>
   </div>
</div>
<script src="js/Game.js"></script>
<footer>
    <p style="background-color: black; color: white; text-align: center; font-family: 'OCR A Std'">
        &copy; Stay Woke 2016
    </p>
</footer>
</body>
</html>
