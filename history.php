 <?php
// history.php
$host = "sql312.infinityfree.com";
$dbname = "if0_39157215_usersauth";
$username = "if0_39157215";
$password = "7a3KRSPAcXd9w0E";

$conn = new mysqli($host, $username, $password, $dbname);

// Check DB connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch completed items
$sql = "SELECT title, description, category, image_path, status, uploaded_at FROM recycle_items WHERE status='Completed' ORDER BY uploaded_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Recycling History - Recycle Relay</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f5fcf5;
      padding: 30px;
    }

    h2 {
      text-align: center;
      color: #28a745;
      margin-bottom: 30px;
    }

    .history-item {
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
      padding: 20px;
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .history-item img {
      width: 100px;
      height: 100px;
      border-radius: 8px;
      object-fit: cover;
      border: 1px solid #ccc;
    }

    .details {
      flex: 1;
    }

    .details h3 {
      margin: 0 0 5px;
      color: #333;
    }

    .details p {
      margin: 4px 0;
      font-size: 0.95rem;
    }

    .completed {
      color: green;
      font-weight: bold;
    }
  </style>
</head>
<body>

  <h2>Your Recycling History ♻️</h2>

  <?php
  if ($result && $result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
          echo '<div class="history-item">';
          echo '<img src="uploads/' . htmlspecialchars($row["image_path"]) . '" alt="Item Image">';
          echo '<div class="details">';
          echo '<h3>' . htmlspecialchars($row["title"]) . '</h3>';
          echo '<p><strong>Category:</strong> ' . htmlspecialchars($row["category"]) . '</p>';
          echo '<p><strong>Description:</strong> ' . htmlspecialchars($row["description"]) . '</p>';
          echo '<p><strong>Status:</strong> <span class="completed">' . htmlspecialchars($row["status"]) . '</span></p>';
          echo '<p><strong>Date:</strong> ' . $row["uploaded_at"] . '</p>';
          echo '</div></div>';
      }
  } else {
      echo "<p style='text-align:center;'>No completed items yet.</p>";
  }

  $conn->close();
  ?>

</body>
</html>