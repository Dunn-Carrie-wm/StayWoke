<?php
require('../connect.php');

function login($conn) {
    setcookie('token', "", 0, "/");
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = 'SELECT * FROM users WHERE username = ? AND password = SHA(?)';
    $stmt = $conn->prepare($sql);
    if ($stmt->execute(array($username, $password))) {
        $accountExists = false;
        while ($row = $stmt->fetch()) {
            $accountExists = true;
            $token = generateToken();
            $sql = 'UPDATE users SET token = ? WHERE username = ?';
            $stmt1 = $conn->prepare($sql);
            if ($stmt1->execute(array($token, $username))) {
                setcookie('token', $token, 0, "/");
                header('location:/StayWoke/');
            }
        }
        if(!$accountExists) {
            echo '<form class="account" action="" method="post" style="text-align: center">
                <span>Incorrect Username or Password</span><br>
                <input name="username" maxlength="16" placeholder="Username"/><br>
                <input type="password" name="password" maxlength="40" placeholder="Password"/><br>
                <input class="submit" type="submit" name="submit" value="Log In" style="color: black"/><br>
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;

                </form>';
        }
    }
}

function generateToken() {
    $date = date(DATE_RFC2822);
    $rand = rand();
    return sha1($date.$rand);
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
</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <img src="../res/stay_woke_logo.png" height="80px" width="80px"></img>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><a href="../index.php">Home</a></li>
                <li><a href="../tutorial/">How to play</a></li>
                <li><a href="../highscores">High scores</a></li>
                <li><a href="../shop">Shop</a></li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="../register">Register</a></li>
                <li class="active"><a href="index.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-log-out" >Logout</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="content">
    <?php
    if(isset($_POST['submit'])) {
        login($dbh);
    }
    else {
        echo '<form class="account" action="" method="post" style="text-align: center">
                <input name="username" maxlength="16" placeholder="Username"/><br>
                <input type="password" name="password" maxlength="40" placeholder="Password"/><br>
                <input class="submit" type="submit" name="submit" value="Log In" style="color: black"/><br>
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;

                </form>';
    }
    ?>
</div>

<footer>
    <p style="background-color: black; color: white; text-align: center; font-family: 'OCR A Std'">
        &copy; Stay Woke 2016
    </p>
</footer>
</body>
</html>