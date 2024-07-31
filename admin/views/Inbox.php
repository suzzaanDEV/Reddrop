<?php
session_start();
if (!isset($_SESSION['adminId'])) {
    header("Location: ../../client/view/Home.php");
    exit();
}

include '../php-config/connection.php';

// Handle deletion of a message
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM queries WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

// Fetch messages from the database
$sql = "SELECT * FROM queries ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inbox</title>
    <link rel="stylesheet" href="../Public/styles/Inbox.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        #inbox {
            padding: 20px;
            box-sizing: border-box;
            width: 100%;
            max-width: 900px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #B91216;
            margin-bottom: 20px;
            text-align: center;
        }

        .search-bar {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #B91216;
            color: white;
        }

        .view-btn, .delete-btn {
            padding: 6px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            color: white;
        }

        .view-btn {
            background-color: #4CAF50;
        }

        .delete-btn {
            background-color: #f44336;
        }

        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
            z-index: 1000;
        }

        .popup-content {
            text-align: left;
        }

        .popup-content h3 {
            margin-top: 0;
            color: #B91216;
        }

        .popup-content p {
            margin: 10px 0;
        }

        button {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            color: white;
            background-color: #B91216;
        }

        button:hover {
            background-color: #a20e15;
        }
    </style>
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
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['subject']); ?></td>
                <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                <td>
                    <button class="view-btn" onclick="viewMessage('<?php echo htmlspecialchars(addslashes($row['name'])); ?>', '<?php echo htmlspecialchars(addslashes($row['subject'])); ?>', '<?php echo htmlspecialchars(addslashes($row['created_at'])); ?>', '<?php echo htmlspecialchars(addslashes($row['message'])); ?>')">View</button>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="delete" class="delete-btn">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
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
    function viewMessage(name, subject, date, message) {
        document.getElementById('messageSender').innerText = name;
        document.getElementById('messageSubject').innerText = subject;
        document.getElementById('messageDate').innerText = date;
        document.getElementById('messageContent').innerText = message;

        openViewPopup();
    }

    function closeViewPopup() {
        const popup = document.getElementById('viewMessagePopup');
        popup.style.display = 'none';
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

            if (sender.includes(query.toLowerCase()) || subject.includes(query.toLowerCase()) || date.includes(query.toLowerCase())) {
                rows[i].style.display = '';
            } else {
                rows[i].style.display = 'none';
            }
        }
    }
</script>

</body>
</html>
