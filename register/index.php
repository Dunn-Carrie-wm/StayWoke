<?php
require('../connect.php');

function register($conn) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $continue = true;
    $form = '<form class="account" action="" method="post" style="text-align: center;">
                <span>Missing Required Fields.</span><br><br>';
    if(!isset($username) || trim($username) == '') {
        $form .= '<input class="required" name="username" maxlength="16" placeholder="Username"/><br>';
        $continue = false;
    }
    else {
        $form .= '<input name="username" maxlength="16" placeholder="Username" value="'.$username.'"/><br>';
    }
    if(!isset($email) || trim($email) == '') {
        $form .= '<input class="required" name="email" maxlength="128" placeholder="Email"/><br>';
        $continue = false;
    }
    else {
        $form .= '<input name="email" maxlength="128" placeholder="Email" value="'.$email.'"/><br>';
    }
    if(!isset($password) || trim($password) == '') {
        $form .= '<input class="required" type="password" name="password" maxlength="128" placeholder="Password"/><br>';
        $continue = false;
    }
    else {
        $form .= '<input type="password" name="password" maxlength="128" placeholder="Password" value=""/><br>';
    }
    $form .= '<input class="submit" type="submit" name="submit" value="Register"/>
                </form>';

    if($continue) {
        $token = generateToken();
        $sql = 'INSERT INTO users (username, email, password, token) VALUES (?, ?, SHA(?), ?)';
        $stmt = $conn->prepare($sql);
        try {
            if ($stmt->execute(array($username, $email, $password, $token))) {
                setcookie('token', $token, 0, "/");
                header('location:/StayWoke/');
            }
        }
        catch (PDOException $e) {
            echo '<form class="account" action="" method="post" style="text-align: center">
                    <span>Username or Email Already Registered. Try Again.</span><br>
                    <input name="username" maxlength="16" placeholder="Username"/><br>
                    <input name="email" maxlength="128" placeholder="Email"/><br>
                    <input type="password" name="password" maxlength="128" placeholder="Password"/><br>
                    <input class="submit" type="submit" name="submit" value="Register"/>
                  </form>';
        }
    }
    else {
        echo $form;
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
                <li class="active"><a href="#">Register</a></li>
                <li><a href="../login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-log-out" >Logout</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="content">
    <?php
    if(isset($_POST['submit'])) {
        register($dbh);
    }
    else {
        echo '<form class="account" action="" method="post" style="text-align: center">
                <input name="username" maxlength="16" placeholder="Username"/><br>
                <input name="email" maxlength="40" placeholder="Email"/><br>
                <input type="password" name="password" maxlength="40" placeholder="Password"/><br>
                <input class="submit" type="submit" name="submit" value="Register" style="color: black;"/><br>
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