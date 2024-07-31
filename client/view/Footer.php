<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Website Title</title>
    <style>
        /* Basic styling for the footer */
        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #f8f9fa;
            text-align: center;
            padding: 10px 0;
        }
        footer p {
            margin: 0;
            font-size: 14px;
            color: #495057;
        }
    </style>
</head>
<body>

    <!-- Your website content goes here -->

    <?php
    $currentYear = date('Y');
    $companyName = 'RedDrop';
    ?>

    <footer>
        <p>&copy; <?php echo $currentYear; ?> <?php echo $companyName; ?>. All Rights Reserved. | Developed by Sujan Ghimire</p>
    </footer>

</body>
</html>
