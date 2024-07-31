<?php
session_start();
require "../model/donation-fetch.php";
require "../model/donation-center-fetch.php";

// Redirect to Home page if user is not logged in
if (!isset($_SESSION['userid'])) {
    header("Location: ../view/Home.php");
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['next'])) {
        echo "HELLO";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donate</title>
    <link rel="stylesheet" href="../styles/Donate.css">
    <?php require "../view/LoggedNav.php"; ?>
</head>

<body>
    <div class="container">
        <?php
        // Check if user is eligible for donation
        if ($donationData['LAST_BOOKED_TIME'] !== '') {
            $lastDonationDate = isset($donationData['LAST_BOOKED_TIME']) ? $donationData['LAST_BOOKED_TIME'] : 0;
            $currentDate = date('Y-m-d');
            $eligibleDonationDate = isset($lastDonationDate) ? date('Y-m-d', strtotime($lastDonationDate . ' + 3 months')) : 0;

            // Check health status before allowing donation scheduling
            if ($donationData['healthStatus'] == 0) {
                // User is not eligible due to health status
                ?>
                <div class="not-eligible">
                    <h1>Not eligible for donation</h1>
                    <p>Your health status does not allow you to donate blood. Fill the survey form or please contact your administrator for more information.</p>
                    <input type="button" value="Back" onclick="history.back()" style="width: 100px; margin-top: 20px;">
                </div>
                <?php } else if ($donationData['healthStatus'] === null) { ?>
                    <!-- User needs to fill out survey -->
                    <div class="fill-survey">
                        <p>You need to take a survey before starting donation</p>
                        <a href="../view/SurveyForm.php"><button>Take a survey</button></a>
                        <input type="button" value="back" onclick="history.back()" style="width: 130px;">
                    </div>
            <?php } elseif (strtotime($currentDate) > strtotime($eligibleDonationDate)) { ?>
                <!-- Donation form -->
                <form action="../controller/process_donation.php" method="post">

                    <div id="donate-first">
                        <p>Health Conditions (check all that apply):</p>

                        <div class="checkbox-group checkbox-wrapper-1">
                            <div class="check-items">
                                <input type="checkbox" class="substituted" id="health_condition1" name="health_conditions[]" value="nausea">
                                <label for="health_condition1">Nausea</label>
                            </div>
                            <div class="check-items">
                                <input type="checkbox" class="substituted" id="health_condition2" name="health_conditions[]" value="headache">
                                <label for="health_condition2">Headache</label>
                            </div>
                            <div class="check-items">
                                <input type="checkbox" class="substituted" id="health_condition3" name="health_conditions[]" value="fever">
                                <label for="health_condition3">Fever</label>
                            </div>
                            <div class="check-items">
                                <input type="checkbox" class="substituted" id="health_condition4" name="health_conditions[]" value="fatigue">
                                <label for="health_condition4">Fatigue</label>
                            </div>
                            <div class="check-items">
                                <input type="checkbox" class="substituted" id="health_condition5" name="health_conditions[]" value="dizziness">
                                <label for="health_condition5">Dizziness</label>
                            </div>
                            <div class="check-items">
                                <input type="checkbox" class="substituted" id="health_condition6" name="health_conditions[]" value="shortness_of_breath">
                                <label for="health_condition6">Shortness of Breath</label>
                            </div>
                            <div class="check-items">
                                <input type="checkbox" class="substituted" id="health_condition7" name="health_conditions[]" value="pain">
                                <label for="health_condition7">Pain (Specify):</label>
                                <input type="text" id="pain_condition" name="pain_condition">
                            </div>
                        </div>

                        <p>Other Health Information:</p>

                        <label for="drugs_taken">Any Drugs Taken?</label>
                        <input type="text" id="drugs_taken" name="drugs_taken">

                        <label for="existing_diseases">Any Existing Diseases?</label>
                        <input type="text" id="existing_diseases" name="existing_diseases">

                        <div class="continue">
                            <input type="button" value="back" onclick="history.back()">
                            <input type="button" value="next" onclick="nextTo()">
                        </div>
                    </div>

                    <div id="donate-second" hidden>
                        <div class="container">
                            <h2 class="mb-4">Select Donation Date and Time</h2>
                            <div class="form-group">
                                <label for="datepicker">Choose Date:</label>
                                <input type="date" id="datepicker" name="date" required>
                            </div>

                            <div class="form-group">
                                <label for="timepicker">Choose Time:</label>
                                <select name="time" id="timepicker" required>
                                    <option value="">Select your option</option>
                                    <option value="10 A.M - 11 A.M">10 A.M - 11 A.M</option>
                                    <option value="11 A.M - 12 P.M">11 A.M - 12 P.M</option>
                                    <option value="12 P.M - 1 P.M">12 P.M - 1 P.M</option>
                                    <option value="1 P.M - 2 P.M">1 P.M - 2 P.M</option>
                                    <option value="2 P.M - 3 P.M">2 P.M - 3 P.M</option>
                                    <option value="3 P.M - 4 P.M">3 P.M - 4 P.M</option>
                                    <option value="4 P.M - 5 P.M">4 P.M - 5 P.M</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="quantity">Quantity (Pints):</label>
                                <input type="number" id="quantity" name="quantity" min="1" max="10" required>
                            </div>
                        </div>

                        <label for="donation_center">Select Donation Center:</label>
                        <div class="box">
                            <select id="donation_center" name="donation_center_id" required>
                                <?php
                                if($resultDonationCenter){
                                    while($row = $resultDonationCenter->fetch_assoc()){
                                        ?>
                                        <option value="<?php echo $row['D_ID']?>"><?php echo $row['D_NAME']?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="continue">
                            <input type="button" value="back" onclick="backToFirst()">
                            <input type="submit" value="Book">
                        </div>
                    </div>
                </form>
            <?php } else { ?>
                <!-- User is not eligible yet -->
                <div class="not-eligible">
                    <h1>Not eligible for donation until</h1>
                    <span><?php echo $eligibleDonationDate ?></span>
                    <p>You must wait until your next eligible donation date.</p>
                    <input type="button" value="Back" onclick="history.back()" style="width: 100px; margin-top: 20px;">
                </div>
            <?php } ?>
        <?php } ?>
    </div>
    <script>
        const backToFirst = () => {
            document.getElementById('donate-second').setAttribute("hidden", "");
            document.getElementById('donate-first').removeAttribute("hidden");
        }
        const nextTo = () => {
            document.getElementById('donate-first').setAttribute("hidden", "");
            document.getElementById('donate-second').removeAttribute("hidden");
        }
    </script>
</body>
</html>
