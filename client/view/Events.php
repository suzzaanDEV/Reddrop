<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: ../view/Home.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['next'])){
        echo "HELLO";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donation Events</title>
    <link rel="stylesheet" href="../styles/Events.css">
    <?php require "../view/LoggedNav.php"; ?>
</head>
<body>
<section class="container">


<h1>Blood Donation Events</h1>

<div class="event-container">

    <?php
    require "../model/events-fetch.php";
    if($done->num_rows>0){
        while ($row=$done->fetch_assoc()) {
            ?>
            <div class="event-card">
                <img src="<?php echo $row['E_BANNER']?>" alt="Event Poster" class="event-image">
                <div class="event-details">
                    <h2><?php echo $row['E_TITLE']?></h2>
                    <p class="event-date-time"><?php echo $row['E_DATE']?></p>
                    <p class="event-date-time"><?php echo $row['E_ADDRESS']?></p>
                    <div class="button-container">
                        <a target="_blank" href="<?php echo $row['E_LOCATION']?>"><button class="button">Location</button></a>
                        <button class="button" onclick="showPopup('<?php echo $row['E_BANNER']?>', '<?php echo $row['E_TITLE']?>', '<?php echo $row['E_DATE']?>', '10 AM', '<?php echo $row['E_ADDRESS']?>', '<?php echo $row['E_DESC']?>')">More Details</button>
                    </div>
                </div>
            </div>

            <?php
        }
    }
    ?>
</div>

    <div class="page-info">
        <?php
        if(!isset($_GET['page-nr'])){
            $page = 1;
        }else{
            $page = $_GET['page-nr'];
        }
        ?>
        Showing  <?php echo $page ?> of <?php echo $pages; ?> pages
    </div>

    <div class="pagination">
        <a href="?page-nr=1">First</a>

        <!-- Go to the previous page -->
        <?php
        if(isset($_GET['page-nr']) && $_GET['page-nr'] > 1){
            ?> <a href="?page-nr=<?php echo $_GET['page-nr'] - 1 ?>">Previous</a> <?php
        }else{
            ?> <a>Previous</a>	<?php
        }
        ?>

        <!-- Output the page numbers -->
        <div class="page-numbers">
            <?php
            if(!isset($_GET['page-nr'])){
                ?> <a class="active" href="?page-nr=1">1</a> <?php
                $count_from = 2;
            }else{
                $count_from = 1;
            }
            ?>

            <?php
            for ($num = $count_from; $num <= $pages; $num++) {
                if($num == @$_GET['page-nr']) {
                    ?> <a class="active" href="?page-nr=<?php echo $num ?>"><?php echo $num ?></a> <?php
                }else{
                    ?> <a href="?page-nr=<?php echo $num ?>"><?php echo $num ?></a> <?php
                }
            }
            ?>
        </div>

        <!-- Go to the next page -->
        <?php
        if(isset($_GET['page-nr'])){
            if($_GET['page-nr'] >= $pages){
                ?> <a>Next</a> <?php
            }else{
                ?> <a href="?page-nr=<?php echo $_GET['page-nr'] + 1 ?>">Next</a> <?php
            }
        }else{
            ?> <a href="?page-nr=2">Next</a> <?php
        }
        ?>
        <a href="?page-nr=<?php echo $pages;?>">Last</a>
    </div>
<div class="btn-container">
    <input type="button" class="button-main" value="back" onclick="history.back()" style="width: 130px;" >
</div>
    <!-- Popup for More Details -->
<div id="popup" class="popup">
    <div class="popup-content">
        <div id="bannerImg"></div>
        <h2 id="popup-event-name"></h2>
        <p id="popup-event-time"></p>
        <p id="popup-event-location"></p>
        <p id="popup-event-desc"></p>
        <span class="close-btn" onclick="hidePopup()">&times</span>
    </div>
</div>
</section>
<?php require "../view/Footer.php"?>

<script>
    function showPopup(bannerUrl, name, date, time, location, details) {
        document.getElementById("bannerImg").setAttribute('style', `background-image: url(\'${bannerUrl}\')`);
        // document.getElementById("bannerImg").style.backgroundImage = `url(${bannerUrl})`;
        // document.getElementById("bannerImg").style.backgroundImage = `url(${bannerUrl})`
        // document.getElementById('bannerImg').setAttribute('src', bannerUrl);
        document.getElementById("popup-event-name").textContent = name;
        document.getElementById("popup-event-time").textContent =`Time: ${date}`;
        document.getElementById("popup-event-location").textContent =`Location: ${location}`;
        document.getElementById("popup-event-desc").textContent =`Description: ${details}`;

        //document.getElementById("popup-event-details").textContent = `Date: ${date}\n Time: ${time}\nLocation: ${location}\n\n${details}`;
        document.getElementById("popup").style.display = "flex";
    }

    function hidePopup() {
        document.getElementById("popup").style.display = "none";
    }
</script>

</body>
</html>

<?php
if (isset($_SESSION['userid']) && $_SESSION['userid'] >= 0) {
    echo "<style> 
.profile-img {
        display: inline-block;
    }
    .dropdown{
        display: inline-block;
    }
    .register{
        display: none;
    }<style>";
}
?>
