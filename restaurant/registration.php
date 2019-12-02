<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="registration.css">
    <link rel="shortcut icon" href="images/sign_in.png"/>
</head>

<body>
<!--navi and body-->
<div id="everything">
    <!-- navi-bar -->
    <div class="navi-bar"></div>
    <!--content-->
    <form action="registration.php" method="post" name="formRegister">
        <div class="content">

            <!--item 1-->
            <div class="item" id="page-pic">
                <img src="images/sign_in.png" alt="Images can not be displayed" id="sign-up-img"/>
            </div>

            <!--item 2-->
            <div class="item" id="sign-up-text">
                Sign Up
            </div>

            <!--item 3-->
            <div class="item input-bar">
                <input type="email" id="email" name="email" class="subitem" placeholder="Email"
                       onblur="CheckEmpty('email'); ValidateEmail('email')"/>
            </div>

            <!--item 3-->
            <div class="item input-bar">
                <input type="text" id="name" name="name" class="subitem" placeholder="Name"
                       onblur="CheckEmpty('name')"/>
            </div>

            <!--item 4-->
            <div class="item input-bar">
                <input type="password" id="pass1" name="pass1" class="subitem" placeholder="Password"
                       onblur="CheckEmpty('pass1'); ValidatePassword('pass1')"/>
            </div>

            <!--item 5-->
            <div class="item input-bar">
                <input type="password" id="pass2" name="pass2" class="subitem" placeholder="Verify password"
                       onblur="CheckEmpty('pass2'); ConfirmPassword('pass1','pass2')"/>
            </div>

            <!--item 6-->
            <div id="sign-up-button" class="item" onclick="document.formRegister.submit()">
				<span class="subitem" id="sign-up-button-text">
					Sign Up
				</span>
            </div>
        </div>
    </form>
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
if (isset($_POST["name"]) and !empty($_POST["name"])) {
    $sql = "insert into user(email,name,password,rq) values('" . $_POST["email"] . "','" . $_POST["name"] . "','" . $_POST["pass1"] . "',now())";
    require './func/clsApi.php';
    $api = new clsApi();
    $api->mysqlExexuteOne($sql);
//    echo "Registration sucessfully!!!";
//    sleep(2);
    header("Location:search.php");
}
?>