 <?php
$host = "sql312.infinityfree.com";
$dbname = "if0_39157215_usersauth";
$username = "if0_39157215";
$password = "7a3KRSPAcXd9w0E";
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch items from the database
$sql = "SELECT * FROM recycle_items ORDER BY uploaded_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vendor Dashboard - Recycle Relay</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef6f1;
            margin: 0;
            padding: 0;
        }
        header {
      background-color: #28a745;
      color: white;
      padding: 20px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    header h1 {
      margin: 0;
    }
    .logout-btn {
      background-color: #fff;
      color: #28a745;
      border: none;
      padding: 10px 20px;
      font-size: 1rem;
      border-radius: 5px;
      cursor: pointer;
    }

    .logout-btn:hover {
      background-color: #f1f1f1;
    }
        h1 {
            background-color: #28a745;
            color: white;
            padding: 20px;
            text-align: center;
        }

.item-wrapper {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    background: #e6f5eb;
    padding: 15px;
    margin: 15px;
    border-radius: 10px;
}

.item-details {
    flex: 2;
    margin-right: 20px;
}

.item-action {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.item-action img {
    max-width: 200px;
    margin-bottom: 10px;
}

button.accept {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 10px 18px;
    font-size: 16px;
    border-radius: 6px;
    cursor: pointer;
}

button.accept:hover {
    background-color: #45a049;
}


.buttons form {
    display: inline-block;
    margin-left: 5px;
}


button.accept {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 10px 18px;
    font-size: 16px;
    border-radius: 6px;
    cursor: pointer;
}


button.accept:hover {
    background-color: #45a049;
}



    </style>
</head>
<body>
<header>
    <h1>Vendor Dashboard</h1>
    <form action="logout.php" method="POST">
        <button type="submit" class="logout-btn">Logout</button>
    </form>
</header>
<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='item-wrapper'>";

echo "<div class='item-details'>";
echo "<h2>" . htmlspecialchars($row['title']) . "</h2>";
echo "<p><strong>Description:</strong> " . htmlspecialchars($row['description']) . "</p>";
echo "<p><strong>Category:</strong> " . htmlspecialchars($row['category']) . "</p>";
$status = htmlspecialchars($row['status']);
$statusColor = ($status === 'Pending' || $status === 'Accepted') ? 'blue' : 'black';
echo "<p><strong>Status:</strong> <span style='color: $statusColor;'>$status</span></p>";
echo "<p><strong>Uploaded:</strong> " . $row['uploaded_at'] . "</p>";
echo '<p><strong>Phone:</strong> ' . htmlspecialchars($row["phone"]) . '</p>';
echo "</div>"; // item-details

echo "<div class='item-action'>";
if (!empty($row['image_path'])) {
    echo "<img src='" . htmlspecialchars($row['image_path']) . "' alt='Image' />";
}
if ($row['status'] === 'Pending') {
    echo "<form method='post' action='handle_prop.php'>
            <input type='hidden' name='id' value='" . $row['id'] . "'>
            <input type='hidden' name='action' value='accept'>
            <button class='accept'>Accept</button>
          </form>";
}
echo "</div>"; // item-action

echo "</div>"; // item-wrapper
    }
}
?>

</body>
</html>