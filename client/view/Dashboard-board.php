<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: ../view/Home.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../styles/Dashboard-board.css">
    <?php require "../view/LoggedNav.php";?>

</head>

<body>
<?php if (isset($_GET['booked']) && $_GET['booked']  == '1') { ?>
    <div class="popup" id="popup">
        <div class="message" id="popup-message">
            <i class="fa-duotone fa-badge-check"></i>

            <div class="popuptext" id="myPopup">Appointment booked successfully.</div>
            <div class="btn" onclick="hidePopup();">Done</div>
        </div>
    </div>
<?php }?>
<?php if (isset($_GET['booked']) && $_GET['booked']  == '0') { ?>
    <div class="popup2 popup" id="popup">
        <div class="message" id="popup-message">
            <i class="fa-duotone fa-circle-exclamation"></i>
            <div class="popuptext" id="myPopup">Failed to book appointment</div>
            <div class="btn" onclick="hidePopup();">Done</div>
        </div>
    </div>
<?php }?>

    <?php if (isset($_GET['request']) && $_GET['request']  == '1') { ?>
    <div class="popup" id="popup">
        <div class="message" id="popup-message">
            <i class="fa-duotone fa-badge-check"></i>

            <div class="popuptext" id="myPopup">Blood requested successful.</div>
            <div class="btn" onclick="hidePopup();">Done</div>
        </div>
    </div>

<?php }?>
<?php if (isset($_GET['request']) && $_GET['request']  == '0') { ?>
    <div class="popup" id="popup">
        <div class="message" id="popup-message">
            <i class="fa-duotone fa-circle-exclamation"></i>

            <div class="popuptext" id="myPopup">Sorry, Failed to request.</div>
            <div class="btn" onclick="hidePopup();">Done</div>
        </div>
    </div>

<?php }?>
<?php if (isset($_GET['eligible']) && $_GET['eligible']  == '0') { ?>
    <div class="popup2 popup" id="popup">
        <div class="message" id="popup-message">
            <i class="fa-duotone fa-circle-exclamation"></i>
            <div class="popuptext" id="myPopup">Sorry You're is not eligible this time.</div>
            <div class="btn" onclick="hidePopup();">Done</div>
        </div>
    </div>
<?php }?>

<?php if (isset($_GET['eligible']) && $_GET['eligible']  == '1') { ?>
    <div class="popup" id="popup">
        <div class="message" id="popup-message">
            <i class="fa-duotone fa-badge-check"></i>

            <div class="popuptext" id="myPopup">Eligible for donation</div>
            <div class="btn" onclick="hidePopup();">Done</div>
        </div>
    </div>

<?php }?>

    <div class="hero flex-item-center">
        <div class="action-cards flex-item-center">
            <div class="donate cards">
                <i class="fa-duotone fa-droplet"></i>
                <a href="Donate.php?successful=1"><button class="button-main">Donate</button></a>
            </div>
            <div class="request cards">
                <i class="fa-duotone fa-truck-droplet"></i>
                <a href="Request.php"><button class="button-main">Request</button></a>
            </div>
            <div class="compatibality-table cards">
                <i class="fa-duotone fa-table"></i>
                <a href="Compatibality.php"><button class="button-main">Compatibility</button></a>
            </div>
            <div class="records cards">
                <i class="fa-duotone fa-books"></i>
                <a href="Records.php"><button class="button-main">Records</button></a>
            </div>
            <div class="events cards">
                <i class="fa-duotone fa-calendar-days"></i>
                <a href="Events.php"><button class="button-main">Events</button></a>
            </div>
        </div>
    </div>
<?php require "../view/Footer.php"?>
<script>
   const hidePopup = () =>{
       let popup = document.getElementById('popup');
       popup.style.display = "none";
       document.location.href='Dashboard-board.php';
   }

</script>

</body>

</html>

<?php
if (isset($_SESSION['userid']) && $_SESSION['userid'] >= 0) {
    echo "<style>.profile-img {
            display: inline-block;
        }
        .dropdown{
            display: inline-block;
        }
        .register{
            display: none;
        }
        
        <style>";
}
?>