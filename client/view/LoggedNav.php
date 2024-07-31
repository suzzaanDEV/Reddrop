<?php require "../controller/dashboard-fetch.php"; ?>

<!doctype html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/sharp-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/sharp-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/sharp-light.css">

    <link rel="stylesheet" href="../styles/loggedNav.css">
    <title></title>

</head>

<body>
    <div class="main">
        <nav>
            <a href="Home.php">
                <div class="logo"><img src="../assets/logo.webp" alt=""></div>
            </a>
            <div class="profile">
                <?php
                if ($result) {
                    $row = $result->fetch_assoc();
                    echo "<p id='admin-name'>" . $row['name'] . "</p>";
                }
                ?>
                <div class="profile-img"></div>
                <div class="dropdown" onclick="dropDownHandler()">
                    <i class="fa-sharp fa-solid fa-caret-up" id="drop-icon"></i>
                </div>
                <div class="drop-profile" id="my-dropdown" hidden>
                    <ul>
                        <a href="Dashboard.php?successful=1">
                            <li><i class="fa-duotone fa-house"></i> Home</li>
                        </a>
                        <a href="Dashboard-board.php">

                            <li><i class="fa-duotone fa-gauge"></i> Dashboard</li>
                        </a>
                        <a href="./Setting.php">
                            <li><i class="fa-duotone fa-gear"></i> Setting</li>
                        </a>
                        <a href="../controller/logout.php">

                            <li> <i class="fa-duotone fa-arrow-right-from-bracket"></i> Logout</li>
                        </a>
                    </ul>
                </div>
            </div>
        </nav>
        <?php
            if($row['healthStatus'] === null){
                ?>
                <div class="form-eligible">
                    <p>You are need take a survey before starting donation <a href="../view/SurveyForm.php">Take eligibility survey form</a> </p>
                </div>
                <?php
            }
        ?>

    </div>


    <script>
        const dropDownHandler = () => {
            const myElement = document.getElementById('my-dropdown');
            const dropIcon = document.getElementById('drop-icon');
            myElement.toggleAttribute("hidden");
            // console.log(myElement.getAttribute("hidden"));
            if (myElement.getAttribute("hidden") != null) {
                dropIcon.classList.add("fa-caret-up");
                dropIcon.classList.remove("fa-caret-down");
            } else {
                dropIcon.classList.remove("fa-caret-up");
                dropIcon.classList.add("fa-caret-down");
            }
        }
    </script>
</body>

</html>