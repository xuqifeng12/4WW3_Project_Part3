<!doctype html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Object submission</title>
    <link rel="stylesheet" type="text/css" href="submission.css">


</head>

<body>

<div id="everything">
    <!-- navi-bar -->
    <div class="navi-bar"></div>
    <!--content-->
    <form action="submission.php" method="post" name="formSubmit" enctype="multipart/form-data">

        <div class="content">

            <!--item 1-->
            <div class="item" id="page-pic">
                <img src="images/upload.jpg" alt="Images can not be displayed" id="submit-img"/>
            </div>

            <!--item 2-->
            <div class="item" id="sign-up-text">
                Object Submission
            </div>

            <!--item 3-->
            <div class="item input-bar">
                <input type="text" name="name" class="subitem" id="name" placeholder="Restaurant Name" value="2323"
                       onblur="CheckEmpty('name')"/>
            </div>

            <!--item 3-->
            <div class="item input-bar">
                <input type="text" name="address" class="subitem" id="address" placeholder="Address"
                       onblur="CheckEmpty('address')"/>
            </div>

            <!--item 3-->
            <div class="item input-bar">
                <input type="text" name="latitude" class="subitem" id="latitude" placeholder="Latitude" value="2323"
                       onblur="CheckEmpty('latitude')"/>
            </div>

            <!--item 4-->
            <div class="item input-bar">
                <input type="text" name="longitude" class="subitem" id="longitude" placeholder="Longitude" value="2323"
                       onblur="CheckEmpty('longitude')"/>
            </div>

            <button id="GetLocation" onclick="getLocation()">Filled by current location</button>

            <!--item 5-->
            <div class="item input-bar">
                <input type="number" name="phonenumber" class="subitem" id="phonenumber" placeholder="Phone number"
                       value="2323"
                       onblur="CheckEmpty('phonenumber'); ValidatePhoneNumber('phonenumber')"/>
            </div>

            <!--item 6-->
            <div class="item input-bar">
                <input type="text" name="description" class="subitem" id="description" placeholder="Description"
                       value="2323"
                       onblur="CheckEmpty('description')"/>
            </div>

            <!--item 7-->
            <div class="upload_pic_box">
                <div class="photo_box" id="photo_box1">
                    <input type="file" name="image[]" id="file_more1" multiple="">
                </div>
            </div>
            <!--item 8-->
            <div id="submit-button" class="item" onclick="document.formSubmit.submit()">
				<span class="subitem" id="submit-button-text">
					Submit
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

<script src="submission.js"></script>


</body>
</html>

<?php
//var_dump($_FILES);
if (isset($_POST["name"]) and !empty($_POST["name"])) {
    require "func/clsApi.php";
    $api = new clsApi();
    $fileArr = array();
    if (isset($_FILES) and !empty($_FILES)) {
        $image = $_FILES['image'];
        $type = array('image/jpeg', 'image/jpg', 'image/png', 'image/gif');
//use loop to upload
        for ($i = 0, $len = count($image['name']); $i < $len; $i++) {
            $file = array(
                'name' => $image['name'][$i],
                'type' => $image['type'][$i],
                'tmp_name' => $image['tmp_name'][$i],
                'error' => $image['error'][$i],
                'size' => $image['size'][$i]
            );
            //to the file to upload the function
            $res = $api->fileUpload($file, 'upload/', $error, $type);

            if ($res) {
                echo 'Upload sucessfully，the corresponding file name is：' . $res . '<br>';
                $ret = $api->fileUploadAws($res);
                var_dump($ret);
                array_push($fileArr, $res);

            } else {
                echo $error;
            }


        }
    }
    $file = implode("|", $fileArr);
    echo $file;
    $sql = "insert into restaurantid(restaurantName,address,phoneNumber,description,latitude,longitude,file) values('" . $_POST["name"] . "','" . $_POST["address"] . "','" . $_POST["phonenumber"] . "','" . $_POST["description"] . "','" . $_POST["latitude"] . "','" . $_POST["longitude"] . "','" . $file . "')";
    $api->mysqlExexuteOne($sql);

}

?>