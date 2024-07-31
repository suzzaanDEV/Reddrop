<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer Query Form</title>
    <style>
    
        .any-query label {
            display: block;
            margin-top: 10px;
            margin-bottom: 5px;
        }
        .any-query input, .any-query textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        .button-main {
            background-color: #B91216;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }
        .button-main:hover {
            background-color: #a01014;
        }
    </style>
</head>
<body>
    <footer>
        <div class="any-query">
            <form id="queryForm">
                <label for="Qname">Name:</label>
                <input type="text" id="Qname" name="Qname">
                <label for="Qemail">Email:</label>
                <input type="text" id="Qemail" name="Qemail">
                <label for="subject">Subject:</label>
                <input type="text" id="subject" name="subject">
                <label for="Query">Message:</label>
                <textarea name="Query" id="Query" cols="60" rows="10" placeholder="Message here...."></textarea>
                <button type="submit" class="button-main">Send <i class="fa-duotone fa-paper-plane-top"></i></button>
            </form>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#queryForm').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: '../controller/queryController.php',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function (response) {
                        alert(response.message);
                        if (response.status === 'success') {
                            $('#queryForm')[0].reset();
                            alert("submitted successfully")
                        }
                    },
                    error: function () {
                        alert('Error submitting query');
                    }
                });
            });
        });
    </script>
</body>
</html>
