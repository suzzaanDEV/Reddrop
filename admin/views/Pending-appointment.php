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
    <title>Pending Donation Appointments</title>
    <link rel="stylesheet" href="../Public/styles/Pending-appointment.css">
</head>
<body>

<div id="appointments">
    <?php if (isset($_GET['delete']) && $_GET['delete']  == '1') { ?>
        <div  id="myPopup" style="color: green">Appointment Deleted Successfully</div>
    <?php }?>

    <h2>Pending Donation Appointments</h2>

    <!-- Appointments Table -->
    <table id="appointmentsTable">
        <thead>
        <tr>
            <th>SN.</th>
            <th>Name</th>
            <th>Blood Type</th>
            <th>Contact Number</th>
            <th>Donation Center</th>
            <th>Appointment Date</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php require "../model/Admin-donation-fetch.php";
            if ($done->num_rows >= 0){
                $i=1;
                while($donationData = $done->fetch_assoc()){?>
                <tr>
                    <td><?php echo $donationData['DONATION_ID'];?></td>
                    <td><?php echo $donationData['name']?></td>
                    <td><?php echo $donationData['bloodtype']?></td>
                    <td><?php echo $donationData['CONTACT_NUMBER']?></td>
                    <td><?php echo $donationData['D_NAME']?></td>
                    <td><?php  echo date($donationData['DONATION_DATE'])?></td>
                    <td>
                        <button class="view-btn" onclick="viewAppointment('<?php echo $donationData['name']?>','<?php echo $donationData['D_NAME']?>','<?php echo $donationData['CONTACT_NUMBER']?>','<?php echo $donationData['bloodtype']?>','<?php  echo date($donationData['DONATION_DATE'])?>')">View</button>
                        <form action="../controller/Appointment/appointment-delete.php" method="post">
                            <input type="hidden" name="deleteId" id="deleteId" value="<?php echo $donationData['DONATION_ID'];?>">
                        <button class="delete-btn" onclick="deleteAppointment(this)">Delete</button>
                        </form>
                    </td>
                </tr>
        <?php
        $i++;}}?>
        </tbody>
    </table>
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

    <div class="popup-container" id="viewPopup">
        <div class="popup-content">
            <p>Name: <span id="viewName"></span></p>
            <p>Donation Center: <span id="viewCenter"></span></p>
            <p>Contact Number: <span id="viewContact"></span></p>
            <p>Blood Group: <span id="viewBlood"></span></p>
            <p>Donation Date and Time: <span id="viewDate"></span></p>
        </div>
        <p class="close" onclick="closeModel()">&times;</p>
    </div>

<script>
    function viewAppointment(name, center, contact, blood, date) {
        document.getElementById('viewPopup').style.display = 'flex';

        document.getElementById('viewName').innerText = name;
        document.getElementById('viewCenter').innerText = center;
        document.getElementById('viewContact').innerText = contact;
        document.getElementById('viewBlood').innerText = blood;
        document.getElementById('viewDate').innerText = date;

    }

    function closeModel(){
        document.getElementById('viewPopup').style.display = 'none';

    }

    function deleteAppointment(button) {
        const row = button.parentNode.parentNode;
        const table = row.parentNode;
        table.deleteRow(row.rowIndex);
    }
</script>

</body>
</html>

