<?php
session_start();
if (!isset($_SESSION['adminId'])) {
    header("Location: ../../client/view/Home.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donation Events</title>
    <link rel="stylesheet" href="../Public/styles/Events.css">
</head>
<body>

<div id="events">
    <?php if (isset($_GET['type']) && $_GET['type']  == '0') { ?>

        <div  id="myPopup" style="color: red">Accepts only type "jpg", "jpeg", "png", "gif" </div>
    <?php }?>
    <?php if (isset($_GET['fake']) && $_GET['fake']  == '0') { ?>

        <div  id="myPopup" style="color: red">Failed to check image (please, select another image)</div>
    <?php }?>
    <?php if (isset($_GET['size']) && $_GET['size']  == '0') {  ?>

        <div  id="myPopup" style="color: red">image size must be smaller than 2mb </div>
    <?php }?>
    <?php if (isset($_GET['done']) && $_GET['done']  == '0') { ?>
        <div  id="myPopup" style="color: red">Failed to Add a Event</div>
    <?php }?>
    <?php if (isset($_GET['done']) && $_GET['done']  == '1') { ?>
        <div  id="myPopup" style="color: green">Event added Successfully</div>
    <?php }?>
    <?php if (isset($_GET['edit']) && $_GET['edit']  == '1') { ?>
        <div  id="myPopup" style="color: green">Event Updated Successfully</div>
    <?php }?>
    <?php if (isset($_GET['delete']) && $_GET['delete']  == '1') { ?>
        <div  id="myPopup" style="color: green">Event Deleted Successfully</div>
    <?php }?>

    <h2>Blood Donation Events</h2>
    <button class="add-events-btn" onclick="addEventPopup()">Add Events</button>

    <div class="event-cards" id="eventCards">
        <!-- event card -->
        <?php
        require "../model/Admin-events-fetch.php";
        if($done->num_rows>0){
            while ($row=$done->fetch_assoc()) {
                ?>                      <div class="event-card">
                    <img src="<?php echo $row['E_BANNER']?>" alt="Event Banner">
                    <div class="event-details">
                        <div class="event-title"><?php echo $row['E_TITLE']?></div>
                        <div class="event-date"><?php echo $row['E_DATE']?></div>
                        <div class="event-date"><?php echo $row['E_ADDRESS']?></div>
                        <div class="form-btn-container">
                            <button class="edit-btn" onclick="editEvent('<?php echo $row['E_TITLE']?>','<?php echo $row['E_DATE']?>','<?php echo $row['E_LOCATION']?>', '<?php echo $row['E_ADDRESS']?>','<?php echo $row['E_BANNER']?>', '<?php echo $row['E_DESC']?>','<?php echo $row['E_ID']?>')">Edit</button>
                            <form action="../controller/delete-event.php" method="post">
                                <input type="hidden" name="deleteEventId" value="<?php echo $row['E_ID']?>">
                                <input type="hidden" name="deleteEventImg" value="<?php echo $row['E_BANNER']?>">
                                <button type="submit" class="delete-btn">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>

                <?php
            }
        }
        ?>
        <!-- Add more event cards here -->
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

        <!-- Event Popup -->
        <div class="popup" id="eventPopup">
            <div class="popup-content">
                <form action="../controller/edit-event.php" method="post" enctype="multipart/form-data">
                    <h3>Event Details</h3>
                    <label for="eventEditTitle">Title:</label>
                    <input type="text" id="eventEditTitle" name="eventTitle" required>

                    <img id="eventEditBannerImg" src="" alt="Banner" >

                    <label for="eventEditBanner">Select New Banner Image:</label>
                    <input type="file" id="eventEditBanner" name="eventBanner" accept="image/*">

                    <label for="eventEditDate">Date:</label>
                    <input type="date" id="eventEditDate" name="eventDate" required>

                    <label for="eventEditLocation">Google Location:</label>
                    <input type="text" id="eventEditLocation" name="googleMapLink" required>

                    <label for="eventEditAddress">Address:</label>
                    <input type="text" id="eventEditAddress" name="eventAddress" required>

                    <label for="eventEditDesc">Descriptions:</label>
                    <input type="text" id="eventEditDesc" name="eventDesc" required>

                    <input type="hidden" id="eventId" name="eventId">

                    <button onclick="saveEvent()">Save</button>
                    <button type="button" class="delete-btn" onclick="closeEventPopup()">Cancel</button>

                </form>
            </div>
        </div>

        <!-- Add Event Popup -->
        <div class="popup" id="addEventPopup">
            <div class="popup-content">
                <form action="../controller/add-event.php" method="post" enctype="multipart/form-data">
                    <h3>Event Details</h3>
                    <label for="eventTitle">Title:</label>
                    <input type="text" id="eventTitle" name="eventTitle">

                    <label for="eventBanner">Banner Image:</label>
                    <input type="file" id="eventBanner" name="eventBanner" accept="image/*">


                    <label for="eventDate">Date:</label>
                    <input type="date" id="eventDate" name="eventDate" >

                    <label for="eventLocation">Google Location:</label>
                    <input type="text" id="eventLocation" name="googleMapLink">

                    <label for="eventAddress">Address:</label>
                    <input type="text" id="eventAddress" name="eventAddress" >

                    <label for="eventDesc">Descriptions:</label>
                    <textarea  id="eventDesc" name="eventDesc" ></textarea>


                    <button type="submit">Save</button>
                    <button type="button" class="delete-btn" onclick="closeEventPopup()">Cancel</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        let editingEvent;

        function editEvent(title, date, location, address, banner, desc, id) {
            document.getElementById('eventEditTitle').defaultValue = title;
            document.getElementById('eventEditDate').defaultValue = date;
            document.getElementById('eventEditBannerImg').setAttribute('src', `${banner}`);
            document.getElementById('eventEditLocation').defaultValue = location;
            document.getElementById('eventEditAddress').defaultValue = address;
            document.getElementById('eventEditDesc').defaultValue = desc;
            document.getElementById('eventId').value = id;

            console.log(title, date, location, address, banner, desc, id);


            openEventPopup();
        }

        function deleteEvent(button) {

        }
        function addEventPopup(){
            document.getElementById('addEventPopup').style.display = 'flex';
        }

        function openEventPopup() {
            const popup = document.getElementById('eventPopup');
            popup.style.display = 'flex';
        }

        function closeEventPopup() {
            const popup = document.getElementById('eventPopup');
            const eventPopup = document.getElementById('addEventPopup');
            popup.style.display = 'none';
            eventPopup.style.display = 'none';
        }

        function saveEvent() {

        }
    </script>
</body>
</html>
