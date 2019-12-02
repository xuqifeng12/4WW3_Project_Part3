<?php
@session_start();
require "./func/clsApi.php";
$api = new clsApi();

if (isset($_GET["id"]) and !empty($_GET["id"])) {
    $_SESSION["rid"] = $_GET["id"];
}
if (isset($_SESSION["rid"]) and !empty($_SESSION["rid"]) and isset($_POST["comment"]) and !empty($_POST["comment"])) {
    $sql = "insert into comment(uid,rid,nr,rq) VALUES (" . $_SESSION["id"] . "," . $_SESSION["rid"] . ",'" . $_POST["comment"] . "',now())";

    $api->mysqlExexuteOne($sql);
    header("Location:individual_sample.php?id=" . $_SESSION['rid']);
    exit();
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>View Restaurant</title>
    <link rel="stylesheet" type="text/css" href="individual_sample.css">
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
</head>

<body>
<!--navi and body-->
<div id="everything">
    <!-- navi-bar -->
    <div class="navi-bar">
        <?php if (isset($_SESSION["name"]) and !empty($_SESSION["name"])){
            ?>
            <div class="account" style="color: black;padding-right: 100px">
                Welcome,<?php echo $_SESSION["name"]; ?></div>
            <?php

        } else{
        ?>
        <div class="navi-bar">
            <div class="account" onclick="window.open('login.php')" id="log-in">
                <div class="account-content">Log in</div>
            </div>
            <div class="account" onclick="window.open('registration.php')" id="sign-up">
                <div class="account-content">Sign Up</div>
            </div>

            <?php
            } ?>


        </div>
    </div>
    <!--content-->
    <div class="content">
        <div id="info" class="item">
            <!--            <div id="imgs" class="subitem">-->
            <!--                <div id="img-list" class="subitem">-->
            <!--                    <div class="img-in-list">-->
            <!--                        <img src="images/a8.jpg" alt="Images can not be displayed" height="80">-->
            <!--                    </div>-->
            <!--                    <div class="img-in-list">-->
            <!--                        <img src="images/a8_2.jpg" alt="Images can not be displayed" height="80">-->
            <!--                    </div>-->
            <!--                    <div class="img-in-list">-->
            <!--                        <img src="images/a8_3.jpg" alt="Images can not be displayed" height="80">-->
            <!--                    </div>-->
            <!--                    <div class="img-in-list">-->
            <!--                        <img src="images/a8_5.jpg" alt="Images can not be displayed" height="80">-->
            <!--                    </div>-->
            <!--                    <div class="img-in-list">-->
            <!--                        <img src="images/a8_6.jpg" alt="Images can not be displayed" height="80">-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--                <div id="main-img" class="subitem">-->
            <!--                    <img src="images/a8_4.jpg" alt="Images can not be displayed" height="420">-->
            <!--                </div>-->
            <!--            </div>-->
            <?php
            $sql = "select * from restaurantid where restaurantID=" . $_GET['id'];
//            echo $sql;
            $ret = $api->mysqlQuery($sql);
//            var_dump($ret);
            ?>
            <div id="text-info1" class="subitem">
                <div id="text-info-title">
                    <?php echo $ret[0]["restaurantName"];?>
                </div>
                <div id="text-info-desc" style="width: 100%">
                    <?php echo $ret[0]["description"];?>
                </div>
            </div>


        </div>

        <div id="map"></div>

        <script>
            function initMap() {
                // Map options
                var options = {
                    zoom: 16,
                    center: {lat: 43.259341, lng: -79.866684}
                }

                // New map
                var map = new google.maps.Map(document.getElementById('map'), options);

                google.maps.event.addListener(map, 'click', function (event) {
                    // Add marker
                    addMarker({coords: event.latLng});
                });


                // Array of markers
                var markers = [
                    {
                        coords: {lat: 43.259341, lng: -79.866684},
                        title: 'August 8',
                        content: '<h1>Address:1 Wilson St</h1>'
                    }
                ];


                var contentString = '<div id="content">' +
                    '<div id="siteNotice">' +
                    '</div>' +
                    '<h1 id="firstHeading" class="firstHeading">August 8</h1>' +
                    '<div style="float:right; width:100%;margin-top: -19px;"><p>August 8 was originally established in 2008 where its first location opened in downtown Hamilton, Ontario.  As a new concept of dining, it was recognized as the first restaurant of its kind in the area to bring the finest aspects of both Cantonese-style dim sum and Japanese cuisine.The address is 1 Wilson St,Hamilton,ON. The contact number is (905)-524-3838.<p> </p></div>' +
                    '</div>' +
                    '</div>';

                // Loop through markers
                for (var i = 0; i < markers.length; i++) {
                    addMarker(markers[i]);
                }

                // Add Marker Function
                function addMarker(props) {
                    var marker = new google.maps.Marker({
                        position: props.coords,
                        map: map,
                    });

                    if (props.iconImage) {
                        // Set icon image
                        marker.setIcon(props.iconImage);
                    }

                    // Check content
                    if (props.content) {
                        var infoWindow = new google.maps.InfoWindow({
                            content: contentString
                        });

                        marker.addListener('click', function () {
                            infoWindow.open(map, marker);
                        });
                    }
                }
            }
        </script>

        <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDE5oUUoV0nH6yZqsX0CMuG2EJAdJycONQ&callback=initMap">
        </script>

        <div id="comments" class="item">
            <div id="comments-title">Comments</div>
            <div id="insert-comment">

                <?php if (isset($_SESSION["name"]) and !empty($_SESSION["name"])) { ?>
                <form action="individual_sample.php" method="post" name="formComment">
                    <?php
                    } else {
                    ?>
                    <form action="login.php" method="post" name="formComment">
                        <?php
                        }

                        ?>
                        <span id="insert-comment-title">Write your review here. ;-)</span>
                        <textarea id="insert-comment-input" name="comment"></textarea>
                        <a href="javascript:document.formComment.submit()" id="insert-comment-button"
                        >Post</a>
                    </form>
            </div>
            <?php
            $sql = "select c.*,u.name from comment c join user u on c.uid=u.id where rid=" . $_SESSION["rid"] . " order by c.rq desc ";
            //                echo $sql;
            $ret = $api->mysqlQuery($sql);
            foreach ($ret as $v) {
                ?>


                <div class="comment-item">
                    <div class="comment-item-head">
                        <div class="comment-item-head-portrait subitem">
                            <img src="images/man1.jpg" alt="Images can not be displayed" height="80">
                        </div>
                        <div class="comment-item-head-info subitem">
                            <div class="comment-item-head-info-name subitem">
                                <?php echo $v["name"]; ?>
                            </div>
                            <div class="comment-item-head-info-date subitem">
                                <?php echo $v["rq"]; ?>
                            </div>
                            <div class="comment-item-head-info-rate">
                                <img src="images/star.png" alt="Images can not be displayed" height="20"
                                     class="subitem">
                                <img src="images/star.png" alt="Images can not be displayed" height="20"
                                     class="subitem">
                                <img src="images/star.png" alt="Images can not be displayed" height="20"
                                     class="subitem">
                                <img src="images/star.png" alt="Images can not be displayed" height="20"
                                     class="subitem">
                                <img src="images/star.png" alt="Images can not be displayed" height="20"
                                     class="subitem">
                            </div>
                        </div>
                    </div>
                    <div class="comment-item-body">
                        <?php echo $v["nr"]; ?>
                    </div>
                </div>
                <?php
            }
            ?>

        </div>

    </div>

</div>

<!--footer-->
<div class="footer">
    <div id="footer-info">
			<span>
				This site is created by Qifeng.
			</span>
    </div>
</div>

</body>

</html>

