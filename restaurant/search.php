<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Search for Restaurant</title>
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:site" content="@Qifeng"/>
    <meta name="twitter:creator" content="@Qifeng Xu"/>
    <meta property="og:title" content="Restaurant Searcher"/>
    <meta property="og:type" content="Website"/>
    <meta property="og:url" content="cystal0429.com"/>

    <link rel="stylesheet" type="text/css" href="search.css">
    <link rel="shortcut icon" href="images/restaurant_logo3.jpg"/>
</head>

<body>
<header>
    <div class="container">
        <div id="branding">
            <h1><span class="highlight">Restaurant</span> Searcher</h1>
        </div>
        <nav>

            <div class="submit_button" onclick="window.open('submission.php')" id="submit">
                <div class="account-content">Submit your restaurant</div>
            </div>
            <?php
            session_start();
//            var_dump($_SESSION);
            if (isset($_SESSION["name"]) and !empty($_SESSION["name"])) {
                ?>
                <div class="submit_button"  id="log-in">
                    <div class="account-content" >Welcome,<?php echo $_SESSION["name"];?></div>
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


        </nav>
    </div>
</header>

<!-- showcase -->

<section id="showcase">
    <form action="results_sample.php" method="post" name="formSearch">
        <div class="container">

            <div class="item" id="page-pic">
                <a href="search.php">
                    <img src="images/restaurant_logo3.jpg" width="100" height="95" alt="Images can not be displayed"
                         id="restaurant-img"/>
                </a>
            </div>

            <div class="item" id="search-bar">
                <input type="text" name="storeName" id="search-input" class="subitem"
                       placeholder="Search the restaurant..."/>
            </div>

            <!--search button-->
            <div id="search-button" class="item" onclick="document.formSearch.submit()">
				<span class="subitem" id="search-button-text">
					Search
				</span>
                <img src="images/search-icon2.png" class="subitem" alt="Images can not be displayed" id="search-icon"/>
            </div>
        </div>
    </form>
</section>

<!-- Map -->
<section id="location">
    <div class="Holder">
        <div class="Container">
            <input name="get_location" type="submit" class="item" id="get_location" value="Get Current Location">
            <div id="search-button2" class="item" onclick="location='results_sample.php'">
				<span class="subitem" id="search-button-text2">
					Search By Current Location
				</span>
                <img src="images/search-icon2.png" class="subitem" alt="Images can not be displayed" id="search-icon2"/>
            </div>

        </div>
        <div class="Element">
            <div id="map">
                <iframe id="google_map" height="350" src="https://maps.google.co.uk?output=embed">
                </iframe>
            </div>
        </div>
    </div>
    <script src="search.js"></script>
</section>

<!-- Rate -->
<section id="Rate">
    <div class="container">
        <div id="search-by-rate" class="item">
            <div id="rate-search-title">Search By Rate</div>
            <div id="rate-5-4" class="rate" onclick="location='results_sample.php'">
                <div class="inner-number">5</div>
            </div>
            <div id="rate-4-3" class="rate" onclick="location='results_sample.php'">
                <div class="inner-number">4</div>
            </div>
            <div id="rate-3-2" class="rate" onclick="location='results_sample.php'">
                <div class="inner-number">3</div>
            </div>
            <div id="rate-2-1" class="rate" onclick="location='results_sample.php'">
                <div class="inner-number">2</div>
            </div>
            <div id="rate-1-0" class="rate" onclick="location='results_sample.php'">
                <div class="inner-number">1</div>
            </div>
        </div>
    </div>
</section>

<!-- footer -->
<footer>
    <p> This site is created by Qifeng. </p>
</footer>
</body>

</html>
