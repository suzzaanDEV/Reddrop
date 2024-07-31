<?php
session_start();
require "../model/Fulfill-blood-request-fetch.php";
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
    <title>Blood Request Management</title>
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/all.css">
    <link rel="stylesheet" href="../Public/styles/BloodRequest.css">
    <link rel="stylesheet" href="../Public/styles/fulfillBloodRequest.css">
</head>
<body>



<div id="BloodRequest">
    <?php if (isset($_GET['delete']) && $_GET['delete']  == '1') { ?>
        <div  id="myPopup" style="color: green">Successfully Deleted.</div>
    <?php }?>
    <?php if (isset($_GET['delete']) && $_GET['delete']  == '0') { ?>
        <div  id="myPopup" style="color: red">Failed to delete</div>
    <?php }?>
    <?php if (isset($_GET['done']) && $_GET['done']  == '1') { ?>
        <div  id="myPopup" style="color: green">Updated Successfully</div>
    <?php }?>
    <?php if (isset($_GET['done']) && $_GET['done']  == '0') { ?>
        <div  id="myPopup" style="color: red">Failed to Update</div>
    <?php }?>

    <h2>Blood Request Management</h2>


    <div class="search-container">
        <input type="text" id="searchFilter" placeholder="Search">
    </div>

    <table id="requestTable">
        <thead>
        <tr>
            <th>SN</th>
            <th>Name</th>
            <th>Address</th>
            <th>Phone Number</th>
            <th>Hospital Name</th>
            <th>Hospital Address</th>
            <th>Hospital Contact</th>
            <th>Patient Name</th>
            <th>Patient Contact</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>

        <?php require "../model/Fulfill-blood-request-fetch.php";
        if ($done->num_rows >= 0){
            $i = 1;

            while($requestData = $done->fetch_assoc()){ ?>
                <tr>
                    <td><?php echo $i?></td>
                    <td><?php echo $requestData['name']?></td>
                    <td><?php echo $requestData['address']?></td>
                    <td><?php echo $requestData['contactNumber']?></td>
                    <td><?php echo $requestData['HOSPITAL_NAME']?></td>
                    <td><?php echo $requestData['HOSPITAL_ADDRESS']?></td>
                    <td><?php echo $requestData['HOSPITAL_CONTACT']?></td>
                    <td><?php echo $requestData['PATIENT_NAME']?></td>
                    <td><?php echo $requestData['HOSPITAL_CONTACT']?></td>
                    <td><?php  echo '<i style=" color: green; font-size: 20px;"<i class="fa-duotone fa-badge-check"></i>'?> </td>
                </tr>
                <?php $i++;
            }}?>
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

        <div class="popup-container" id="cancellationPopup">
            <div class="popup-content">
                <h3>Provide Remarks for Cancellation</h3>
                <textarea id="remarks" rows="4" cols="50" placeholder="Enter remarks"></textarea>
                <button class="close-btn" onclick="closeCancellationPopup()">Submit</button>
            </div>
        </div>

    </div>
    <br>
    <button class="button-main" onclick="history.back()">Back</button>

    <script>
        function markAsDone(name) {
            // Implement logic to mark the request as done
            alert(`Marking ${name}'s request as done`);
        }

        function openCancellationPopup(name) {
            // Implement logic to open the cancellation popup
            const popup = document.getElementById('cancellationPopup');
            popup.style.display = 'flex';
        }

        function closeCancellationPopup() {
            // Implement logic to close the cancellation popup
            const popup = document.getElementById('cancellationPopup');
            popup.style.display = 'none';
            // You can also submit the remarks data here
        }

        function searchRequests() {
            // Implement logic to filter the table based on search criteria
            const searchFilter = document.getElementById('searchFilter').value.toLowerCase();

            const table = document.getElementById('requestTable');
            const rows = table.getElementsByTagName('tr');

            for (let i = 1; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName('td');
                let matchFound = false;

                for (let j = 0; j < cells.length; j++) {
                    const cellContent = cells[j].textContent.toLowerCase();
                    if (cellContent.includes(searchFilter)) {
                        matchFound = true;
                        break;
                    }
                }

                if (matchFound) {
                    rows[i].style.display = '';
                } else {
                    rows[i].style.display = 'none';
                }
            }
        }

        // Real-time search on input change
        document.getElementById('searchFilter').addEventListener('input', searchRequests);
    </script>

</body>
</html>

