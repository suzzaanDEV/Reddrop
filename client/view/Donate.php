<?php
session_start();
require "../model/donation-fetch.php";

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
                    <p>Your health status does not allow you to donate blood. Fill the survey form or Please contact your administrator for more
                        information.</p>
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
                        <!--                    <label for="blood_group">Blood Group:</label>-->
                        <!--                    <div class="box">-->
                        <!--                        <select id="blood_group" name="blood_group" required>-->
                        <!--                            <option value="A+">A+</option>-->
                        <!--                            <option value="A-">A-</option>-->
                        <!--                            <option value="B+">B+</option>-->
                        <!--                            <option value="B-">B-</option>-->
                        <!--                            <option value="O+">O+</option>-->
                        <!--                            <option value="O-">O-</option>-->
                        <!--                            <option value="AB+">AB+</option>-->
                        <!--                            <option value="AB-">AB-</option>-->
                        <!--                        </select>-->
                        <!--                    </div>-->


                        <p>Health Conditions (check all that apply):</p>

                        <div class="checkbox-group checkbox-wrapper-1">
                            <div class="check-items">
                                <input type="checkbox" class="substituted" id="health_condition1" name="health_conditions[]"
                                    value="nausea">
                                <label for="health_condition1">Nausea</label>
                            </div>
                            <div class="check-items">
                                <input type="checkbox" class="substituted" id="health_condition2" name="health_conditions[]"
                                    value="headache">
                                <label for="health_condition2">Headache</label>
                            </div>
                            <div class="check-items">
                                <input type="checkbox" class="substituted" id="health_condition3" name="health_conditions[]"
                                    value="fever">
                                <label for="health_condition3">Fever</label>
                            </div>
                            <div class="check-items">
                                <input type="checkbox" class="substituted" id="health_condition4" name="health_conditions[]"
                                    value="fatigue">
                                <label for="health_condition4">Fatigue</label>
                            </div>
                            <div class="check-items">
                                <input type="checkbox" class="substituted" id="health_condition5" name="health_conditions[]"
                                    value="dizziness">
                                <label for="health_condition5">Dizziness</label>

                            </div>
                            <div class="check-items">
                                <input type="checkbox" class="substituted" id="health_condition6" name="health_conditions[]"
                                    value="shortness_of_breath">
                                <label for="health_condition6">Shortness of Breath</label>

                            </div>
                            <div class="check-items">
                                <input type="checkbox" class="substituted" id="health_condition7" name="health_conditions[]"
                                    value="pain">
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
                </form>
                <form action="../controller/process_donation.php" method="post">

                    <div id="donate-first">
                        <!--                    <label for="blood_group">Blood Group:</label>-->
                        <!--                    <div class="box">-->
                        <!--                        <select id="blood_group" name="blood_group" required>-->
                        <!--                            <option value="A+">A+</option>-->
                        <!--                            <option value="A-">A-</option>-->
                        <!--                            <option value="B+">B+</option>-->
                        <!--                            <option value="B-">B-</option>-->
                        <!--                            <option value="O+">O+</option>-->
                        <!--                            <option value="O-">O-</option>-->
                        <!--                            <option value="AB+">AB+</option>-->
                        <!--                            <option value="AB-">AB-</option>-->
                        <!--                        </select>-->
                        <!--                    </div>-->


                        <p>Health Conditions (check all that apply):</p>

                        <div class="checkbox-group checkbox-wrapper-1">
                            <div class="check-items">
                                <input type="checkbox" class="substituted" id="health_condition1" name="health_conditions[]"
                                    value="nausea">
                                <label for="health_condition1">Nausea</label>
                            </div>
                            <div class="check-items">
                                <input type="checkbox" class="substituted" id="health_condition2" name="health_conditions[]"
                                    value="headache">
                                <label for="health_condition2">Headache</label>
                            </div>
                            <div class="check-items">
                                <input type="checkbox" class="substituted" id="health_condition3" name="health_conditions[]"
                                    value="fever">
                                <label for="health_condition3">Fever</label>
                            </div>
                            <div class="check-items">
                                <input type="checkbox" class="substituted" id="health_condition4" name="health_conditions[]"
                                    value="fatigue">
                                <label for="health_condition4">Fatigue</label>
                            </div>
                            <div class="check-items">
                                <input type="checkbox" class="substituted" id="health_condition5" name="health_conditions[]"
                                    value="dizziness">
                                <label for="health_condition5">Dizziness</label>

                            </div>
                            <div class="check-items">
                                <input type="checkbox" class="substituted" id="health_condition6" name="health_conditions[]"
                                    value="shortness_of_breath">
                                <label for="health_condition6">Shortness of Breath</label>

                            </div>
                            <div class="check-items">
                                <input type="checkbox" class="substituted" id="health_condition7" name="health_conditions[]"
                                    value="pain">
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

  