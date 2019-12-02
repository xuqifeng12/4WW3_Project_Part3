<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Results</title>
    <link rel="stylesheet" type="text/css" href="results_sample.css">
    <link rel="shortcut icon" href="images/star.png"/>
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
        <form action="results_sample.php" method="post" name="formSearch">
            <div id="search-bar">
                <input type="text" name="storeName" id="search-bar-input"
                       value="<?php if (isset($_POST["storeName"]) and !empty($_POST["storeName"])) {
                           echo $_POST["storeName"];
                       } else {
                           echo "Hamilton";
                       } ?>">
            </div>
            <div id="search-button" onclick="document.formSearch.submit()">
                <span id="search-button-text">Search</span>
            </div>
        </form>
        <?php
        session_start();
        if (isset($_SESSION["name"]) and !empty($_SESSION["name"])) {
            ?>
            <div class="account" style="width: 120px" id="log-in">
                <div class="account-content">Welcome,<?php echo $_SESSION["name"]; ?></div>
            </div>
            <?php
        } else {
            ?>
            <div class="account" onclick="window.open('login.php')" id="log-in">
                <div class="account-content">Log in</div>
            </div>
            <div class="account" onclick="window.open('registration.php')" id="sign-up">
                <div class="account-content">Sign Up</div>
            </div>

            <?php
        }
        ?>


    </div>
    <div class="showcase" id="map"></div>


    <script>
        function initMap() {
            // Map options
            var options = {
                zoom: 15,
                center: {lat: 43.254871, lng: -79.866707}
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
                },
                {
                    coords: {lat: 43.254037, lng: -79.865072},
                    content: '<h1>Teahut</h1>'
                },
                {
                    coords: {lat: 43.254871, lng: -79.866707},
                    content: '<h1>Saigon House</h1>'
                },
                {
                    coords: {lat: 43.250311, lng: -79.871673},
                    content: '<h1>Wass Ethiopian</h1>'
                }
            ];


            var contentString = '<div id="content">' +
                '<div id="siteNotice">' +
                '</div>' +
                '<h1 id="firstHeading" class="firstHeading">August 8</h1>' +
                '<div style="float:right; width:100%;margin-top: -19px;"><p>August 8 was originally established in 2008 where its first location opened in downtown Hamilton, Ontario.  As a new concept of dining, it was recognized as the first restaurant of its kind in the area to bring the finest aspects of both Cantonese-style dim sum and Japanese cuisine. The address is 1 Wilson St,Hamilton,ON. The contact number is (905)-524-3838.<p> Individual object: August 8, <a href="http://cystal0429.com/individual_sample.php">' +
                'http://cystal0429.com/individual_sample.php' +
                '.</p></div>' +
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


    <!--content-->
    <div class="content">
        <?php if (isset($_POST["storeName"]) and !empty($_POST["storeName"])) {
            require 'func/clsApi.php';
            $api = new clsApi();
            $sql = "select * from restaurantid where restaurantName like '%" . $_POST["storeName"] . "%'";
//            echo $sql;
            $ret = $api->mysqlQuery($sql);

            if (count($ret) > 0) {
                foreach ($ret as $k => $v) {

                    ?>

                    <div class="item"
                         onclick="window.open('individual_sample.php?id=<?php echo $v["restaurantID"] ?>')">
                        <div class="subitem store-info">
                            <div class="title-and-rate">
                                <div class="title"><span><?php echo $v["restaurantName"]; ?></span></div>
                                <div class="rate">
                                    <img src="images/star.png" alt="Images can not be displayed" class="star">
                                    <img src="images/star.png" alt="Images can not be displayed" class="star">
                                    <img src="images/star.png" alt="Images can not be displayed" class="star">
                                    <img src="images/star.png" alt="Images can not be displayed" class="star">
                                    <img src="images/star.png" alt="Images can not be displayed" class="star">

                                </div>
                            </div>
                            <div class="address"><?php echo $v["address"]; ?></div>
                            <div class="description">One of the best places to eat in Hamilton, enjoy a wicked
                                experience
                                and a
                                friendly staff. TEA HUT Bubble Tea is the perfect place for families to experience
                                appetizing
                                asian
                                food, like specialty chicken.
                            </div>
                        </div>
                    </div>


                    <?php
                }
            }
        } else {
        ?>
    </div>
<!--    <div class="content">-->
<!---->
<!--    </div>-->
    <?php
    } ?>


</div>

<!--footer-->
<div class="footer">
    <div id="info">
			<span id="information">
				This site is created by Qifeng.
			</span>
    </div>
</div>

</body>

</html>
