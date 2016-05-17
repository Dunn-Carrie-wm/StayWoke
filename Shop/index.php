<?php require('../connect.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Stay Woke</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="../css/style.css">
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
                <li><a href="../tutorial/">How to play</a></li>
                <li><a href="../highscores">High scores</a></li>
                <li class="active"><a href="../shop">Shop</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="../register">Register</a></li>
                <li><a href="../login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-log-out" >Logout</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="content">
    <form method="post" style="color: black">
        <center>
            <table border="1px">
                <tr>
                    <td width="150px"><center>Extra Lives:$1 4 lives</center></td><td>
                        <p>Play the game 1 more time before needing to recharge</p><p><?php
                            //checks to see if $_POST['qtyLives'] has been set yet, if not sets to null
                            //This is to avoid the error in the next line when the computer doesn't know what $_POST['qtyLives'] is
                            if(!isset($_POST['qtyLives'])){$_POST['qtyLives'] = null;}
                            //sets $qtyLives to $_POST['qtyLives'], $_POST varriables can;t be used as values in inputs
                            $qtyLives = $_POST['qtyLives'];
                            //if the user has not added anything to the cart yet
                            if($qtyLives == null) {
                                //make the button to add to cart
                                echo "<input type='number' name='qtyLives' min='0' value='$qtyLives'><button>Add to Cart</button>";
                            }else{
                                //if the user HAS added to cart, allow the user to update and show the user how much it costs
                                echo "<input type='number' name='qtyLives' min='0' value='$qtyLives'><button>Update Cart</button>
                            <a style='background-color: white; color: lawngreen'>$".number_format($qtyLives*1, 2)."</a>";
                            }
                            ?></p></td><td width="150px"><center>Skin Tickets:$0.50</center></td>
                    <td><p>Use them to buy skins in-game to change your character's skin</p><p><?php
                            //Copy/paste of Lives, changed to Skins
                            if(!isset($_POST['qtySkins'])){$_POST['qtySkins'] = null;}
                            $qtySkins = $_POST['qtySkins'];
                            if($qtySkins == null) {
                                echo "<input type='number' name='qtySkins' min='0' value='$qtySkins'><button>Add to Cart</button>";
                            }else{
                                echo "<input type='number' name='qtySkins' min='0' value='$qtySkins'><button>Update Cart</button>
                            <a style='background-color: white; color: lawngreen'>$".number_format($qtySkins*0.5, 2)."</a>";
                            }
                            ?></p></td>
                </tr>
                <tr>
                    <td width="150px"><center>Mugs:$3.80</center></td><td>
                        <p>Drink your beverage in a mug with the StayWoke logo</p><p><?php
                            //Copy/paste of Lives, changed to Mugs
                            if(!isset($_POST['qtyMugs'])){$_POST['qtyMugs'] = null;}
                            $qtyMugs = $_POST['qtyMugs'];
                            if($qtyMugs == null) {
                                echo "<input type='number' name='qtyMugs' min='0' value='$qtyMugs'><button>Add to Cart</button>";
                            }else{
                                echo "<input type='number' name='qtyMugs' min='0' value='$qtyMugs'><button>Update Cart</button>
                            <a style='background-color: white; color: lawngreen'>$".number_format($qtyMugs*3.8, 2)."</a>";
                            }
                            ?></p></td><td width="150px"><center>T-Shirt:$26.00</center></td>
                    <td><p>Get a T-Shirt with the StayWoke Logo on it</p><p><?php
                            //Copy/paste of Lives, changed to TShirts
                            if(!isset($_POST['qtyTShirts'])){$_POST['qtyTShirts'] = null;}
                            $qtyTShirts = $_POST['qtyTShirts'];
                            if($qtyTShirts == null) {
                                echo "<input type='number' name='qtyTShirts' min='0' value='$qtyTShirts'><button>Add to Cart</button>";
                            }else{
                                echo "<input type='number' name='qtyTShirts' min='0' value='$qtyTShirts'><button>Update Cart</button>
                            <a style='background-color: white; color: lawngreen'>$".number_format($qtyTShirts*26, 2)."</a>";
                            }
                            ?></p></td>
                </tr>
                <tr><td colspan="4"><div id="credit card">
                        <b>Credit Card:</b>
                        <p>Cardholder Name <input type="text" name="CCname">
                            Card Number (no dashes): <input type="number" value="0000000000000000" maxlength="16" name="CCnumber"></p>
                        <p>City: <input type="text" name="CCcity">
                            State/Province <input type="text" name="CCS/P">
                            Postal/ZIP code: <input maxlength="9" type="text"  name="CCP/Z">
                            Country <input name="CCcountry" type="text"></p>
                        <p>Billing address 1: <input type="text" name="CCBA1">
                            Billing address 2: <input type="text" name="CCBA2"></p>
                        <p>Expiration Date: <input type="text" placeholder="MM/YYYY" name="CCED"></p>
                    </div></td></tr>
            </table>
        </center>
        <?php
        echo "<button name='submit'>Submit</button>";
        if(isset($_POST['submit'])){

            if($qtyLives > 0 && $qtyLives != null){
                $sql = 'INSERT INTO purchases (id, item_id, amount, total_cost) VALUES (NULL,?,?,?)';
                $stmt = $dbh->prepare($sql);
                $stmt->execute(array(
                    1, $qtyLives, number_format($_POST['qtyLives'] * 1, 2)
                ));
                $sql = 'INSERT INTO creditCards (id, CardholderName, CardNumber, City, StateProvince, PostalZIP_code, Country, BillingAddress1, BillingAddress2, ExspirarionDate)VALUES (NULL,?,?,?,?,?,?,?,?,?)';
                $stmt = $dbh->prepare($sql);
                $stmt->execute(array(
                    $_POST['CCname'], $_POST['CCnumber'], $_POST['CCcity'], $_POST['CCS/P'], $_POST['CCP/Z'], $_POST['CCcountry'], $_POST['CCBA1'], $_POST['CCBA2'], $_POST['CCED']
                ));
            }
            if($qtySkins > 0 && $qtySkins != null){
                $sql = 'INSERT INTO purchases (id, item_id, amount, total_cost) VALUES (NULL,?,?,?)';
                $stmt = $dbh->prepare($sql);
                $stmt->execute(array(
                    2, $qtySkins, number_format($_POST['qtySkins'] * 0.5, 2)
                ));
                $sql = 'INSERT INTO creditCards (id, CardholderName, CardNumber, City, StateProvince, PostalZIP_code, Country, BillingAddress1, BillingAddress2, ExspirarionDate)VALUES (NULL,?,?,?,?,?,?,?,?,?)';
                $stmt = $dbh->prepare($sql);
                $stmt->execute(array(
                    $_POST['CCname'], $_POST['CCnumber'], $_POST['CCcity'], $_POST['CCS/P'], $_POST['CCP/Z'], $_POST['CCcountry'], $_POST['CCBA1'], $_POST['CCBA2'], $_POST['CCED']
                ));
            }
            if($qtyMugs > 0 && $qtyMugs != null){
                $sql = 'INSERT INTO purchases (id, item_id, amount, total_cost) VALUES (NULL,?,?,?)';
                $stmt = $dbh->prepare($sql);
                $stmt->execute(array(
                    3, $qtyMugs, number_format($_POST['qtyMugs'] * 3.8, 2)
                ));
                $sql = 'INSERT INTO creditCards (id, CardholderName, CardNumber, City, StateProvince, PostalZIP_code, Country, BillingAddress1, BillingAddress2, ExspirarionDate)VALUES (NULL,?,?,?,?,?,?,?,?,?)';
                $stmt = $dbh->prepare($sql);
                $stmt->execute(array(
                    $_POST['CCname'], $_POST['CCnumber'], $_POST['CCcity'], $_POST['CCS/P'], $_POST['CCP/Z'], $_POST['CCcountry'], $_POST['CCBA1'], $_POST['CCBA2'], $_POST['CCED']
                ));
            }
            if($qtyTShirts > 0 && $qtyTShirts != null){
                $sql = 'INSERT INTO purchases (id, item_id, amount, total_cost) VALUES (NULL,?,?,?)';
                $stmt = $dbh->prepare($sql);
                $stmt->execute(array(
                    4, $qtyTShirts, number_format($_POST['qtyTShirts'] * 26, 2)
                ));
                $sql = 'INSERT INTO creditCards (id, CardholderName, CardNumber, City, StateProvince, PostalZIP_code, Country, BillingAddress1, BillingAddress2, ExspirarionDate)VALUES (NULL,?,?,?,?,?,?,?,?,?)';
                $stmt = $dbh->prepare($sql);
                $stmt->execute(array(
                    $_POST['CCname'], $_POST['CCnumber'], $_POST['CCcity'], $_POST['CCS/P'], $_POST['CCP/Z'], $_POST['CCcountry'], $_POST['CCBA1'], $_POST['CCBA2'], $_POST['CCED']
                ));
            }
            echo "<script>
                    alert('Thank you for your purchases');
                 </script>";
            $url = 'http://localhost:8090/StayWoke/shop/submit_button.php';
            header('location: '.$url);
        }
        ?>
    </form>
</div>
<footer>
    <p style="background-color: black; color: white; text-align: center; font-family: 'OCR A Std'">
        &copy; Stay Woke 2016
    </p>
</footer>
</body>
</html>