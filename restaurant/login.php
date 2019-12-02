<?php
//start session
session_start();
?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>Log in</title>
        <link rel="stylesheet" type="text/css" href="login.css">
        <link rel="shortcut icon" href="images/sign_in.png"/>
    </head>

    <body>
    <!--navi and body-->
    <div id="everything">
        <!-- navi-bar -->
        <div class="navi-bar"></div>
        <!--content-->
        <div class="content">
            <form action="login.php" method="post" name="formLogin">
                <!--item 1-->
                <div class="item" id="page-pic">
                    <img src="images/sign_in.png" alt="Images can not be displayed" id="sign-up-img"/>
                </div>

                <!--item 2-->
                <div class="item" id="sign-up-text">
                    Log in
                </div>

                <!--item 3-->
                <div class="item input-bar">
                    <input type="email" id="email" name="email" class="subitem" placeholder="Email"
                           onblur="CheckEmpty('email'); ValidateEmail('email')"/>
                </div>


                <!--item 4-->
                <div class="item input-bar">
                    <input type="password" id="pass1" name="pass1" class="subitem" placeholder="Password"
                           onblur="CheckEmpty('pass1'); ValidatePassword('pass1')"/>
                </div>


                <!--item 6-->
                <div id="sign-up-button" class="item" onclick="document.formLogin.submit()">
				<span class="subitem" id="sign-up-button-text">
					Log in
				</span>
                </div>
            </form>
        </div>

    </div>

    <!--footer-->
    <div class="footer">
        <div id="info">
			<span id="information">
				This site is created by Qifeng.
			</span>
        </div>
    </div>

    <script src="registration.js"></script>

    </body>

    </html>


<?php
require "func/clsApi.php";
$api = new clsApi();
var_dump($_POST);
if (isset($_POST["email"]) and !empty($_POST["email"])) {
    $sql = "select id,name from user where email='" . $_POST["email"] . "' and password='" . $_POST["pass1"] . "'";
//    echo $sql;
    $ret = $api->mysqlQuery($sql);
    if (count($ret) == 1) {
//        register session
        $_SESSION["id"] = $ret[0]["id"];
        $_SESSION["name"] = $ret[0]["name"];
        $api->prompt("Log in sucessfully,is about to jump...");
        header("Location:search.php");
        exit();
    } else {
        $api->prompt("Log in failed，please reenter!!!");
    }
}

?>