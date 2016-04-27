<?php
require('../connect.php');

function register($conn) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $continue = true;
    $form = '<form class="" action="" method="post">
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
            echo '<form class="account" action="" method="post">
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
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
<div class="content">
    <?php
    if(isset($_POST['submit'])) {
        register($dbh);
    }
    else {
        echo '<form class="" action="" method="post">
                <input name="username" maxlength="16" placeholder="Username"/><br>
                <input name="email" maxlength="40" placeholder="Email"/><br>
                <input type="password" name="password" maxlength="40" placeholder="Password"/><br>
                <input class="submit" type="submit" name="submit" value="Register"/><br>
                </form>';
    }
    ?>
</div>
</body>
</html>