<?php
session_start();
if (!isset($_SESSION['adminId'])) {
    header("Location: ../../client/view/Home.php");
    exit();
}
require "../controller/AdminHandel/All-Admin-data.php";

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
    <?php if (isset($_GET['add']) && $_GET['add']  == '1') {?>

        <div  id="myPopup" style="color: green">A Admin added Successfully</div>
    <?php }?>
    <?php if (isset($_GET['add']) && $_GET['add']  == '0') { ?>
        <div  id="myPopup" style="color: red">Failed to Add a admin</div>
    <?php }?>
    <div class="top">
        <h2>Admin Management</h2>
        <button class="button" type="submit" name="addUser" onclick="openPopup('addAdminPopup')">Add Admin</button>
    </div>

    <table>
        <thead>
        <tr>
            <th>SN.</th>
            <th>Name</th>
            <th>Email</th>
            <th>Contact Number</th>
            <th>Action</th>

        </tr>
        </thead>
        <tbody>
        <!-- Sample user data -->
        <?php
        if ($done->num_rows > 0){
            $i=1;
            while ($row=mysqli_fetch_assoc($done)){
                ?>

                <tr>
                    <td><?php echo $i?></td>
                    <td><?php echo $row['A_NAME'] ?></td>
                    <td><?php echo $row['A_EMAIL']?></td>
                    <td><?php echo $row['A_CONTACT']?></td>
                    <td class="btn-group">
                            <button class="button" onclick="openEditAdminPopup('editAdminPopup', '<?php echo $row['A_NAME'] ?>','<?php echo $row['A_ADDRESS'] ?>','<?php echo $row['A_CONTACT'] ?>','<?php echo $row['A_EMAIL'] ?>','<?php echo $row['A_ID'] ?>')">Edit</button>
                        <form action="../controller/UserHandel/delete-user.php" method="post">
                            <input type="hidden" name="ID" value="<?php echo $row['A_ID']?>">
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

    <div class="popup-container" id="addAdminPopup">
        <div class="popup-content">
            <div class="add-user-form">
                <h2>Add Admin</h2>
                <form method="post" action="../controller/AdminHandel/add-admin.php">
                    <div class="form-group">
                        <label for="newAdminName">Full Name:</label>
                        <input type="text" id="newAdminName" name="newAdminName" required>
                    </div>

                    <div class="form-group">
                        <label for="newAdminAddress">Address:</label>
                        <input type="text" id="newAdminAddress" name="newAdminAddress" required>
                    </div>

                    <div class="form-group">
                        <label for="newAdminEmail">Email:</label>
                        <input type="text" id="newAdminEmail" name="newAdminEmail" required>
                    </div>

                    <div class="form-group">
                        <label for="newAdminPassword">Password:</label>
                        <input type="password" id="newAdminPassword" name="newAdminPassword" required>
                    </div>

                    <div class="form-group">
                        <label for="newAdminContactNumber">Contact Number:</label>
                        <input type="text" id="newAdminContactNumber" name="newAdminContactNumber" required>
                    </div>

                    <button class="button" type="submit" name="addAdmin">Add Admin</button>
                    <button class="button" type="button" onclick="closePopup('addAdminPopup')" >Cancel</button>
                </form>
            </div>
        </div>
    </div>

    <div class="popup-container" id="editAdminPopup">
        <div class="popup-content">
            <div id="editAdminModal">
                <h2>Edit Admin</h2>
                <form action="../controller/AdminHandel/edit-Admin.php" method="post">
                    <div class="form-group">
                        <label for="editUserName">Full Name:</label>
                        <input type="text" id="editAdminName" name="updatedName" >
                    </div>

                    <div class="form-group">
                        <label for="editUserAddress">Address:</label>
                        <input type="text" id="editAdminAddress" name="editAdminAddress" >
                    </div>

                    <div class="form-group">
                        <label for="editAdminEmail">Email:</label>
                        <input type="text" id="editAdminEmail" name="editAdminEmail" >
                    </div>

                    <div class="form-group">
                        <label for="editAdminPassword">Password:</label>
                        <input type="password" id="editAdminPassword" name="editAdminPassword" >
                    </div>

                    <div class="form-group">
                        <label for="editAdminContactNumber">Contact Number:</label>
                        <input type="text" id="editAdminContactNumber" name="editAdminContactNumber" >
                    </div>

                    <div class="form-group">
                        <input type="hidden" name="adminId" id="editAdminId">
                        <button class="button" type="submit" name="updateUser">Update Admin</button>
                        <button class="button" type="button" onclick="closePopup('editAdminPopup')" >Cancel</button>

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

    function openEditAdminPopup(mode, name, address,contactNumber, email,  adminId) {
        document.getElementById('editAdminName').defaultValue = name;
        document.getElementById('editAdminAddress').defaultValue = address;
        document.getElementById('editAdminEmail').defaultValue = email;
        document.getElementById('editAdminContactNumber').defaultValue = contactNumber;
        document.getElementById('editAdminId').value = adminId;

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

