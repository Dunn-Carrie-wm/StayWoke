<?php

?>
<!DOCTYPE html>
<html>
<head>
    <title>Stay Woke</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
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
            <a class="navbar-brand" href="#">Stay Woke</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><a href="../index.php">Home</a></li>
                <li class="active"><a href="#">Register</a></li>
                <li><a href="#">Store</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="../login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-log-out" >Logout</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="content">
    <?php
    if(isset($_POST['submit'])) {
    }
    else {
        echo '<form class="" action="" method="post" style="text-align: center">
                <input name="username" maxlength="16" placeholder="Username"/><br>
                <input name="email" maxlength="40" placeholder="Email"/><br>
                <input type="password" name="password" maxlength="40" placeholder="Password"/><br>
                <input class="submit" type="submit" name="submit" value="Register"/><br>
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;

                </form>';
    }
    ?>
</div>
<footer>
    <p style="background-color: black; color: white; text-align: center">
        &copy; Stay Woke 2016
    </p>
</footer>
</body>
</html>