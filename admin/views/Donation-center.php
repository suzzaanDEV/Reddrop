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
    <title>Donation Centers</title>
    <link rel="stylesheet" href="../Public/styles/Donation-center.css">
</head>

<body>

    <div id="donationCenters">
        <h2>Donation Centers</h2>

        <input type="text" class="search-bar" placeholder="Search..." oninput="searchDonationCenters(this.value)">
        <?php if (isset($_GET['done']) && $_GET['done'] == '1') { ?>
            <div class="entered">
                <p>Added a Donation Center Successfully.</p>
            </div>
        <?php } ?>
        <?php if (isset($_GET['done']) && $_GET['done'] == '0') { ?>
            <div class="failed">
                <p>Something went wrong</p>
            </div>
        <?php } ?>
        <?php if (isset($_GET['delete']) && $_GET['delete']  == '1') { ?>
            <div id="myPopup" style="color: green">A Donation Center Deleted Successfully</div>
        <?php } ?>
        <?php if (isset($_GET['delete']) && $_GET['delete']  == '0') { ?>
            <div id="myPopup" style="color: green">Something went wrong</div>
        <?php } ?>
        <?php if (isset($_GET['update']) && $_GET['update']  == '1') { ?>
            <div id="myPopup" style="color: green">Updated Successfully</div>
        <?php } ?>
        <?php if (isset($_GET['update']) && $_GET['update']  == '0') { ?>
            <div id="myPopup" style="color: green">Something went wrong</div>
        <?php } ?>

        <button class="add-donation-center-btn" onclick="openPopup()">Add Donation Center</button>

        <!-- Donation Centers Table -->
        <table id="donationCenterTable">
            <thead>
                <tr>
                    <th>SN.</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Google Maps Link</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Sample donation center data -->
                <?php
                require "../model/Admin-donationCenter-fetch.php";
                if ($done->num_rows > 0) {
                    $i = 1;
                    while ($donationCenterData = $done->fetch_assoc()) {
                ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $donationCenterData['D_NAME'] ?></td>
                            <td><?php echo $donationCenterData['D_ADDRESS'] ?></td>
                            <td><?php echo $donationCenterData['D_CONTACT'] ?></td>
                            <td><?php echo $donationCenterData['D_EMAIL'] ?></td>
                            <td><a href="<?php echo $donationCenterData['D_LOCATION'] ?>" target="_blank">Google Maps Link</a></td>
                            <td>
                                <button class="edit-btn" onclick="editDonationCenter('<?php echo $donationCenterData['D_NAME'] ?>','<?php echo $donationCenterData['D_ADDRESS'] ?>','<?php echo $donationCenterData['D_LOCATION'] ?>','<?php echo $donationCenterData['D_CONTACT'] ?>','<?php echo $donationCenterData['D_EMAIL'] ?>','<?php echo $donationCenterData['D_ID'] ?>')">Edit</button>
                                <form action="../controller/DonationCenter/delete-donation-center.php" method="post">
                                    <input type="hidden" name="deleteId" id="deleteId" value="<?php echo $donationCenterData['D_ID'] ?>">
                                    <button type="submit" class="delete-btn">Delete</button>
                                </form>

                            </td>
                        </tr>

                <?php
                        $i++;
                    }
                }
                ?>
            </tbody>
        </table>
        <div class="page-info">
            <?php
            if (!isset($_GET['page-nr'])) {
                $page = 1;
            } else {
                $page = $_GET['page-nr'];
            }
            ?>
            Showing <?php echo $page ?> of <?php echo $pages; ?> pages
        </div>

        <div class="pagination">
            <a href="?page-nr=1">First</a>

            <!-- Go to the previous page -->
            <?php
            if (isset($_GET['page-nr']) && $_GET['page-nr'] > 1) {
            ?> <a href="?page-nr=<?php echo $_GET['page-nr'] - 1 ?>">Previous</a> <?php
                                                                                } else {
                                                                                    ?> <a>Previous</a> <?php
                                                                                                    }
                                                                                                        ?>

            <!-- Output the page numbers -->
            <div class="page-numbers">
                <?php
                if (!isset($_GET['page-nr'])) {
                ?> <a class="active" href="?page-nr=1">1</a> <?php
                                                                $count_from = 2;
                                                            } else {
                                                                $count_from = 1;
                                                            }
                                                                ?>

                <?php
                for ($num = $count_from; $num <= $pages; $num++) {
                    if ($num == @$_GET['page-nr']) {
                ?> <a class="active" href="?page-nr=<?php echo $num ?>"><?php echo $num ?></a> <?php
                                                                                            } else {
                                                                                                ?> <a href="?page-nr=<?php echo $num ?>"><?php echo $num ?></a> <?php
                                                                                                                                                            }
                                                                                                                                                        }
                                                                                                                                                                ?>
            </div>

            <!-- Go to the next page -->
            <?php
            if (isset($_GET['page-nr'])) {
                if ($_GET['page-nr'] >= $pages) {
            ?> <a>Next</a> <?php
                        } else {
                            ?> <a href="?page-nr=<?php echo $_GET['page-nr'] + 1 ?>">Next</a> <?php
                                                                                            }
                                                                                        } else {
                                                                                                ?> <a href="?page-nr=2">Next</a> <?php
                                                                                                                                }
                                                                                                                                    ?>
            <a href="?page-nr=<?php echo $pages; ?>">Last</a>
        </div>

        <!-- Edit Donation Center Popup -->
        <div class="popup" id="editDonationCenterPopup">
            <div class="popup-content">
                <form action="../controller/DonationCenter/update-donation-center.php" method="post">
                    <h3>Edit Donation Center</h3>
                    <label for="editName">Name:</label>
                    <input type="text" id="editName" name="editName">

                    <label for="editAddress">Address:</label>
                    <textarea id="editAddress" name="editAddress" rows="2"></textarea>

                    <label for="editContact">Contact:</label>
                    <input type="text" id="editContact" name="editContact" >

                    <label for="editGoogleMapLink">Google Maps Link:</label>
                    <input type="text" id="editGoogleMapLink" name="editGoogleMapLink" placeholder="Paste Google Maps link">

                    <label for="editEmail">Email:</label>
                    <input type="text" id="editEmail" name="editEmail" >

                    <label for="editPass">Password:</label>
                    <input type="password" id="editPass" name="editPass" >
                    <input type="hidden" name="updateId" id="updateId">
                    <button type="submit">Save Changes</button>
                    <button type="button" class="delete-btn" onclick="closeEditPopup()">Cancel</button>
                </form>

            </div>
        </div>

        <!-- Add Donation Center Popup -->
        <div class="popup" id="addDonationCenterPopup">
            <div class="popup-content">
                <form action="../controller/DonationCenter/add-donation-center.php" method="post">
                    <h3>Add Donation Center</h3>
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>

                    <label for="address">Address:</label>
                    <textarea id="address" name="address" rows="2" required></textarea>

                    <label for="contact">Contact:</label>
                    <input type="text" id="contact" name="contact" required>

                    <label for="googleMapLink">Google Maps Link:</label>
                    <input type="text" id="googleMapLink" name="googleMapLink" placeholder="Paste Google Maps link">

                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" required>

                    <label for="editPass">Password:</label>
                    <input type="password" id="pass" name="pass" required>

                    <button type="submit">Submit</button>
                    <button class="delete-btn" onclick="closePopup()">Cancel</button>
                </form>
            </div>
        </div>

    </div>

    <script>
        let editingRow;

        function openPopup() {
            const popup = document.getElementById('addDonationCenterPopup');
            popup.style.display = 'flex';
        }

        function closePopup() {
            const popup = document.getElementById('addDonationCenterPopup');
            popup.style.display = 'none';
        }

        function openEditPopup() {
            const popup = document.getElementById('editDonationCenterPopup');
            popup.style.display = 'flex';
        }

        function closeEditPopup() {
            const popup = document.getElementById('editDonationCenterPopup');
            popup.style.display = 'none';
        }

        function addDonationCenter() {
            const name = document.getElementById('name').value;
            const address = document.getElementById('address').value;
            const contact = document.getElementById('contact').value;
            const googleMapLink = document.getElementById('googleMapLink').value;

            // Add the new donation center to the table



            // Clear the form fields
            document.getElementById('name').value = '';
            document.getElementById('address').value = '';
            document.getElementById('contact').value = '';
            document.getElementById('googleMapLink').value = '';

            // Close the popup after submission
            closePopup();
        }

        function editDonationCenter(name, address, location, contact, email, id) {
            document.getElementById('editDonationCenterPopup').style.display = 'flex';
            document.getElementById('editName').defaultValue = name;
            document.getElementById('editAddress').defaultValue = address;
            document.getElementById('editContact').defaultValue = contact;
            document.getElementById('editGoogleMapLink').defaultValue = location;
            document.getElementById('editEmail').defaultValue = email;
            document.getElementById('updateId').defaultValue = id;
        }

        function saveEditedDonationCenter() {

        }

        function deleteDonationCenter() {

        }

        function searchDonationCenters(query) {
            const table = document.getElementById('donationCenterTable');
            const rows = table.getElementsByTagName('tr');

            for (let i = 1; i < rows.length; i++) {
                const name = rows[i].cells[0].innerText.toLowerCase();
                const address = rows[i].cells[1].innerText.toLowerCase();
                const contact = rows[i].cells[2].innerText.toLowerCase();

                if (name.includes(query) || address.includes(query) || contact.includes(query)) {
                    rows[i].style.display = '';
                } else {
                    rows[i].style.display = 'none';
                }
            }
        }

        window.addEventListener('beforeunload', function(event) {
            // Remove query parameters from the URL
            var urlWithoutParams = window.location.href.split('?')[0];
            // Change the URL without query parameters
            history.replaceState({}, document.title, urlWithoutParams);
        });
    </script>

</body>

</html>