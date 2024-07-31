<?php require "../view/LoggedNav.php";
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
    <title>Donate</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Bootstrap DateTimePicker CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css">

    <link rel="stylesheet" href="../styles/Donate.css">
</head>

<body>
    <div class="container">
        <div class="title">
            <i class="fa-duotone fa-droplet"></i>
            <p>Donate</p>
        </div>
        <div>
            <span class="last-donation-date">Last Donation Date : 2020/01/01</span>
            <span class="last-donation-date">Eligible Donation Date : 2020/01/01</span>
        </div>
        <form action="../controller/process_donation.php" method="post">
            <div>
                <div class="container">
                    <h2 class="mb-4">Select Donation Date and Time</h2>

                    <div class="form-group">
                        <label for="datepicker">Choose Date:</label>
                        <input type="text" class="form-control" id="datepicker" name="donation-date">
                    </div>

                    <div class="form-group">
                        <label for="timepicker">Choose Time:</label>
                        <input type="text" class="form-control" id="timepicker" name="donation-time">
                    </div>
                </div>

                <label for="donation_center">Select Donation Center:</label>
                <div class="box">
                    <select id="donation_center" name="donation_center" required>
                        <option value="center1">Donation Center 1</option>
                        <option value="center2">Donation Center 2</option>
                        <option value="center3">Donation Center 3</option>

                    </select>
                </div>
                <input type="submit" value="submit">
            </div>
        </form>

    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Bootstrap DateTimePicker JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>

    <script>
        $('#datepicker').datepicker({
            format: 'mm/dd/yyyy',
            autoclose: true
        });

        // Time Picker
        $('#timepicker').timepicker({
            showMeridian: false,
            defaultTime: 'current'
        });
    </script>
</body>

</html>
<?php require "../Modules/Footer.php" ?>

<?php
if (isset($_SESSION['userid']) && $_SESSION['userid'] >= 0 && isset($_GET['successful']) && $_GET['successful'] == 1) {
    echo "<style>.profile-img {
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