<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donation Eligibility Form</title>
    <link rel="stylesheet" href="../styles/SurveeyForm.css">
</head>
<body>
    <div class="container">
        <h2>Blood Donation Eligibility Form</h2>
        <form action="../controller/process_survey.php" method="POST">
            <div class="form-group">
                <label for="medications">Current Medications:</label><br>
                <input type="checkbox" name="medications[]" value="Blood Thinners"> Blood Thinners<br>
                <input type="checkbox" name="medications[]" value="Steroids"> Steroids<br>
                <input type="checkbox" name="medications[]" value="Immunosuppressants"> Immunosuppressants<br>
            </div>

            <div class="form-group">
                <label for="health_issues">Current Health Issues:</label><br>
                <textarea name="health_issues" rows="4" cols="50"></textarea><br>
            </div>

            <div class="form-group">
                <label for="previous_donation_date">Last Donation Date:</label><br>
                <input type="date" name="previous_donation_date"><br>
            </div>

            <div class="form-group">
                <label for="weight">Weight (in kg):</label><br>
                <input type="number" name="weight" min="0" step="any"><br>
            </div>

            <div class="form-group">
                <label for="diseases">Chronic Diseases (if any, select all that apply):</label><br>
                <input type="checkbox" name="diseases[]" value="Hypertension"> Hypertension<br>
                <input type="checkbox" name="diseases[]" value="Diabetes"> Diabetes<br>
                <input type="checkbox" name="diseases[]" value="Heart Disease"> Heart Disease<br>
            </div>

            <button type="submit" class="submit-button">Submit</button>
        </form>
    </div>
</body>
</html>
