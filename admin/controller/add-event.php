<?php
require "../php-config/connection.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $title = $_REQUEST['eventTitle'];
    $date = $_REQUEST['eventDate'];
    $location = $_REQUEST['googleMapLink'];
    $address = $_REQUEST['eventAddress'];
    $desc = strval($_REQUEST['eventDesc']);
//    $banner = $_REQUEST['eventBanner'];

    try {
        $targetDir = "../../uploads/events/"; // Directory
        $targetFile = $targetDir .uniqid(). basename($_FILES["eventBanner"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["eventBanner"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        header("Location: ../views/Events.php?fake=0");
        exit();
        }


// Check file size
        if ($_FILES["eventBanner"]["size"] > 5000000) {
            $uploadOk = 0;
        header("Location: ../views/Events.php?size=0");
        exit();
        }

// Allow certain file formats
        $allowedExtensions = array("jpg", "jpeg", "png", "gif", "webp");
        if(!in_array($imageFileType, $allowedExtensions)) {
            $uploadOk = 0;
        header("Location: ../views/Events.php?type=0");
        exit();
        }

// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
        header("Location: ../views/Events.php?done=0");
        exit();

// if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["eventBanner"]["tmp_name"], $targetFile)) {
           echo "The file ". htmlspecialchars(basename($_FILES["eventBanner"]["name"])). " has been uploaded as " . basename($targetFile);
            } else {
            header("Location: ../views/Events.php?done=0");
            exit();
            }
        }

    $sql = "INSERT INTO events(E_TITLE, E_DATE, E_LOCATION, E_ADDRESS, E_DESC, E_BANNER) VALUES ('$title', '$date', '$location', '$address', '$desc', '$targetFile')";
    $done = $conn->query($sql);
    if ($done){
        header("Location: ../views/Events.php?done=1");
        exit();
    }


    } catch (Exception $err){
        header("Location: ../views/Events.php?done=0");
        exit();
    }

}





