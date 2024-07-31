<?php
session_start();
if (!isset($_SESSION['adminId'])) {
    header("Location: ../../client/view/Home.php");
    exit();
}
require "../model/Admin-data-fetch.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/all.css">
    <link rel="stylesheet" href="../Public/styles/Usermanagement.css">
</head>
<body>

<div id="userManagement">

    <?php if (isset($_GET['delete']) && $_GET['delete']  == '1') { ?>
        <div  id="myPopup" style="color: green">Successfully Deleted.</div>
    <?php }?>
    <?php if (isset($_GET['delete']) && $_GET['delete']  == '0') { ?>
        <div  id="myPopup" style="color: red">Failed to delete</div>
    <?php }?>
    <?php if (isset($_GET['edit']) && $_GET['edit']  == '1') { ?>
        <div  id="myPopup" style="color: green">Updated Successfully</div>
    <?php }?>
    <?php if (isset($_GET['edit']) && $_GET['edit']  == '0') { ?>
        <div  id="myPopup" style="color: red">Failed to Update</div>
    <?php }?>
    <?php if (isset($_GET['edit']) && $_GET['add']  == '1') {  echo "hello";?>

        <div  id="myPopup" style="color: green">A user added Successfully</div>
    <?php }?>
    <?php if (isset($_GET['edit']) && $_GET['add']  == '0') { ?>
        <div  id="myPopup" style="color: red">Failed to Add a user</div>
    <?php }?>
    <div class="top">
        <h2>User Management</h2>
        <button class="button" type="submit" name="addUser" onclick="openPopup('addUserPopup')">Add User</button>
    </div>

    <table>
        <thead>
        <tr>
            <th>SN.</th>
            <th>Name</th>
            <th>Blood Group</th>
            <th>Last Donation Date</th>
            <th>Contact Number</th>
            <th>Action</th>

        </tr>
        </thead>
        <tbody>
        <!-- Sample user data -->
        <?php
        if ($userData->num_rows > 0){
            $i=1;
            while ($row=mysqli_fetch_assoc($userData)){
                ?>

                <tr>
                    <td><?php echo $i?></td>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row['bloodtype'] ?></td>
                    <td><?php echo $row['last_donation_date']?></td>
                    <td><?php echo $row['contactNumber']?></td>
                    <td class="btn-group">
                            <button class="button" onclick="openEditUserPopup('editUserPopup', '<?php echo $row['name'] ?>','<?php echo $row['bloodtype'] ?>','<?php echo $row['address'] ?>','<?php echo $row['email'] ?>','<?php echo $row['contactNumber'] ?>','<?php echo $row['last_donation_date'] ?>',<?php echo $row['userId']?>)">Edit</button>
                        <form action="../controller/UserHandel/delete-user.php" method="post">
                            <input type="hidden" name="ID" value="<?php echo $row['userId']?>">
                            <button type="submit" class="button">Delete</button>
                        </form>

                    </td>

                </tr>

                <?php
                $i++;}
        }
        ?>

        <!-- Add more user rows as needed -->
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

    <div class="popup-container" id="addUserPopup">
        <div class="popup-content">
            <div class="add-user-form">
                <h2>Add User</h2>
                <form method="post" action="../controller/UserHandel/add-user.php">
                    <div class="form-group">
                        <label for="newUserName">Full Name:</label>
                        <input type="text" id="newUserName" name="newUserName" required>
                    </div>

                    <div class="form-group">
                        <label for="newBloodType">Blood Type:</label>
                        <select id="newBloodType" name="newBloodType" required>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="newUserAddress">Address:</label>
                        <input type="text" id="newUserAddress" name="newUserAddress" required>
                    </div>

                    <div class="form-group">
                        <label for="newUserEmail">Email:</label>
                        <input type="text" id="newUserEmail" name="newUserEmail" required>
                    </div>

                    <div class="form-group">
                        <label for="newUserPassword">Password:</label>
                        <input type="password" id="newUserPassword" name="newUserPassword" required>
                    </div>

                    <div class="form-group">
                        <label for="newUserContactNumber">Contact Number:</label>
                        <input type="text" id="newUserContactNumber" name="newUserContactNumber" required>
                    </div>

                    <div class="form-group">
                        <label for="newUserLastDonationDate">Last Donation Date:</label>
                        <input type="date" id="newUserLastDonationDate" name="newUserLastDonationDate" required>
                    </div>
                    <button class="button" type="submit" name="addUser">Add User</button>
                    <button class="button" type="button" onclick="closePopup('addUserPopup')" >Cancel</button>
                </form>
            </div>
        </div>
    </div>

    <div class="popup-container" id="editUserPopup">
        <div class="popup-content">
            <div id="editUserModal">
                <h2>Edit User</h2>
                <form action="../controller/UserHandel/edit-user.php" method="post">
                    <input type="hidden" id="editUserId" name="userId">
                    <div class="form-group">
                        <label for="editUserName">Name:</label>
                        <input type="text" id="editUserName" name="updatedName" >
                    </div>

                    <div class="form-group">
                        <label for="editBloodType">Blood Group:</label>
                        <select id="editBloodType" name="newBloodType" >
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="editUserAddress">Address:</label>
                        <input type="text" id="editUserAddress" name="editUserAddress" >
                    </div>

                    <div class="form-group">
                        <label for="editUserEmail">Email:</label>
                        <input type="text" id="editUserEmail" name="editUserEmail" >
                    </div>

                    <div class="form-group">
                        <label for="editUserPassword">Password:</label>
                        <input type="password" id="editUserPassword" name="editUserPassword" >
                    </div>

                    <div class="form-group">
                        <label for="editUserContactNumber">Contact Number:</label>
                        <input type="text" id="editUserContactNumber" name="editUserContactNumber" >
                    </div>

                    <div class="form-group">
                        <label for="editUserLastDonationDate">Last Donation Date:</label>
                        <input type="date" id="editUserLastDonationDate" name="updatedLastDonationDate" >
                    </div>
                    <div class="form-group">

                        <button class="button" type="submit" name="updateUser">Update User</button>
                        <button class="button" type="button" onclick="closePopup('editUserPopup')" >Cancel</button>

                    </div>

                </form>
            </div>
<!--            <i class=" close-btn fa-duotone fa-circle-xmark" onclick="closePopup('editUserPopup')"></i>-->

        </div>
    </div>




</div>

<script>
    function openPopup(mode) {
        // You can customize this function to load specific content for Add User or Edit User mode
        const popup = document.getElementById(mode);
        popup.style.display = 'flex';
    }

    function openEditUserPopup(mode, name, bloodGroup, address, email, contactNumber, lastDonationDate, userId) {
        document.getElementById('editUserName').defaultValue = name;
        document.getElementById('editBloodType').defaultValue = bloodGroup;
        document.getElementById('editUserAddress').defaultValue = address;
        document.getElementById('editUserEmail').defaultValue = email;
        document.getElementById('editUserContactNumber').defaultValue = contactNumber;
        document.getElementById('editUserLastDonationDate').defaultValue = lastDonationDate;
        document.getElementById('editUserId').value = userId;

        const popup = document.getElementById(mode);
        popup.style.display = 'flex';
    }

    function openEditPopup(mode ,name, bloodGroup, address, email,password, contactNumber, lastDonationDate) {
        document.getElementById('editName').value = name
        document.getElementById('editBloodType').value = bloodGroup
        document.getElementById('editUserAddress').value = address
        document.getElementById('editUserEmail').value = email
        document.getElementById('editUserPassword')
        document.getElementById('editUserContactNumber').value = contactNumber
        document.getElementById('editUserLastDonationDate').value = lastDonationDate

        const popup = document.getElementById(mode);
        popup.style.display = 'flex';
    }

    function closePopup(model) {
        const popup = document.getElementById(model);
        popup.style.display = 'none';
    }

    function editUser(id, name, bloodGroup, lastDonationDate) {
        // Example: Open popup with user data pre-filled for editing

        openPopup('editUserPopup');

        // You can fill the form fields with the provided user data
        // Example: document.getElementById('userName').value = name;
    }
</script>

</body>
</html>

