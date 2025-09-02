 <?php
session_start();

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: indexU.php");
    exit();
}

$host = "sql312.infinityfree.com";
$dbname = "if0_39157215_usersauth";
$username = "if0_39157215";
$password = "7a3KRSPAcXd9w0E";

$conn = new mysqli($host, $username, $password, $dbname);

// Check DB connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

// Fetch items
$sql = "SELECT title, description, category,  image_path, status, uploaded_at FROM recycle_items WHERE user_id=? ORDER BY uploaded_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Track Your Items - Recycle Relay</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f8fdf8;
      padding: 30px;
    }

    h2 {
      color: #28a745;
      text-align: center;
      margin-bottom: 30px;
    }

    .item {
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      padding: 20px;
      margin-bottom: 20px;
      display: flex;
      gap: 20px;
      align-items: center;
    }

    .item img {
      width: 120px;
      height: 120px;
      object-fit: cover;
      border-radius: 8px;
      border: 1px solid #ccc;
    }

    .info {
      flex-grow: 1;
    }

    .info h3 {
      margin: 0 0 5px;
      color: #333;
    }

    .info p {
      margin: 4px 0;
      font-size: 0.95rem;
    }

    .status {
      font-weight: bold;
      color: #007bff;
    }
  </style>
</head>
<body>
  <h2>Track Your Uploaded Items</h2>

  <?php
  if ($result && $result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
          // $imagePath = 'uploads/' . htmlspecialchars($row["image_path"]);

          echo '<div class="item" style="border:1px solid #ccc; margin:10px; padding:10px; display:flex;">';
          if (!empty($row['image_path'])) {
            echo "<img src='" . htmlspecialchars($row['image_path']) . "' alt='Image' />";
        }
          echo '<div class="info" style="margin-left:15px;">';
          echo '<h3>' . htmlspecialchars($row["title"]) . '</h3>';
          echo '<p><strong>Category:</strong> ' . htmlspecialchars($row["category"]) . '</p>';
          echo '<p><strong>Description:</strong> ' . htmlspecialchars($row["description"]) . '</p>';
          echo '<p><strong>Status:</strong> <span class="status">' . htmlspecialchars($row["status"]) . '</span></p>';
          
          echo '<p><strong>Uploaded At:</strong> ' . htmlspecialchars($row["uploaded_at"]) . '</p>';
          echo '</div></div>';
      }
  } else {
      echo "<p style='text-align:center;'>No items uploaded yet.</p>";
  }

  $conn->close();
  ?>
</body>

</html>