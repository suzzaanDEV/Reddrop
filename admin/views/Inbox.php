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
    <title>Inbox</title>
    <link rel="stylesheet" href="../Public/styles/Inbox.css">
</head>
<body>

<div id="inbox">

    <h2>Inbox</h2>

    <input type="text" class="search-bar" placeholder="Search..." oninput="searchMessages(this.value)">

    <!-- Messages Table -->
    <table id="messagesTable">
        <thead>
        <tr>
            <th>Sender</th>
            <th>Subject</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <!-- Sample message data -->
        <tr>
            <td>John Doe</td>
            <td>Meeting Tomorrow</td>
            <td>2024-02-22</td>
            <td>
                <button class="view-btn" onclick="viewMessage(this)">View</button>
                <button class="delete-btn" onclick="deleteMessage(this)">Delete</button>
            </td>
        </tr>
        <!-- Add more rows as needed -->
        </tbody>
    </table>

    <!-- View Message Popup -->
    <div class="popup" id="viewMessagePopup">
        <div class="popup-content">
            <h3>Message Details</h3>
            <p><strong>Sender:</strong> <span id="messageSender"></span></p>
            <p><strong>Subject:</strong> <span id="messageSubject"></span></p>
            <p><strong>Date:</strong> <span id="messageDate"></span></p>
            <p><strong>Message:</strong></p>
            <p id="messageContent"></p>
            <button onclick="closeViewPopup()">Close</button>
        </div>
    </div>

</div>

<script>
    let viewingRow;

    function viewMessage(button) {
        const row = button.parentNode.parentNode;
        viewingRow = row;

        const sender = row.cells[0].innerText;
        const subject = row.cells[1].innerText;
        const date = row.cells[2].innerText;
        const messageContent = "This is a sample message content.";

        document.getElementById('messageSender').innerText = sender;
        document.getElementById('messageSubject').innerText = subject;
        document.getElementById('messageDate').innerText = date;
        document.getElementById('messageContent').innerText = messageContent;

        openViewPopup();
    }

    function closeViewPopup() {
        const popup = document.getElementById('viewMessagePopup');
        popup.style.display = 'none';
    }

    function deleteMessage(button) {
        const row = button.parentNode.parentNode;
        const table = row.parentNode;
        table.deleteRow(row.rowIndex);
    }

    function openViewPopup() {
        const popup = document.getElementById('viewMessagePopup');
        popup.style.display = 'flex';
    }

    function searchMessages(query) {
        const table = document.getElementById('messagesTable');
        const rows = table.getElementsByTagName('tr');

        for (let i = 1; i < rows.length; i++) {
            const sender = rows[i].cells[0].innerText.toLowerCase();
            const subject = rows[i].cells[1].innerText.toLowerCase();
            const date = rows[i].cells[2].innerText.toLowerCase();

            if (sender.includes(query) || subject.includes(query) || date.includes(query)) {
                rows[i].style.display = '';
            } else {
                rows[i].style.display = 'none';
            }
        }
    }
</script>

</body>
</html>
