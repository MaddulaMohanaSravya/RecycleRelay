 <?php
session_start();
$conn = new mysqli("sql312.infinityfree.com", "if0_39157215", "7a3KRSPAcXd9w0E", "if0_39157215_usersauth");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$msg = "";

if (isset($_POST['submit'])) {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $category = trim($_POST['category']);
    $phone = trim($_POST['phone']);
    $user_id = $_SESSION['user_id'] ?? null; // get logged-in user id

    // validate session
    if (!$user_id) {
        $msg = "⚠️ You must be logged in to upload.";
    } else {
        // handle image upload
        $image = $_FILES['image']['name'];
        $targetDir = "uploads/";
        $targetFile = $targetDir . uniqid() . "_" . basename($image); // unique filename

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            // insert into DB using prepared statement
            $sql = "INSERT INTO recycle_items (user_id, title, description, category, phone, image_path, status) VALUES (?, ?, ?, ?, ?, ?, 'Pending')";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("isssss", $user_id, $title, $description, $category, $phone, $targetFile);

            if ($stmt->execute()) {
                $msg = "✅ Item uploaded successfully!";
            } else {
                $msg = "❌ Database error: " . $stmt->error;
                unlink($targetFile); // delete file if DB fails
            }
            $stmt->close();
        } else {
            $msg = "⚠️ Failed to upload image.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Upload Recyclable Item</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4fbf4;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 500px;
      background: #fff;
      margin: 60px auto;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      color: #28a745;
      margin-bottom: 30px;
    }

    label {
      display: block;
      margin-bottom: 6px;
      font-weight: bold;
      color: #333;
    }

    input[type="text"],
    textarea,
    input[type="file"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 1rem;
    }

    textarea {
      resize: vertical;
      height: 100px;
    }

    button {
      width: 100%;
      padding: 12px;
      background-color: #28a745;
      color: white;
      font-size: 1rem;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }

    button:hover {
      background-color: #218838;
    }

    .msg {
      text-align: center;
      font-weight: bold;
      margin-top: 20px;
      color: #155724;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>Upload Recyclable Item</h2>
  <form action="upload_item.php" method="POST" enctype="multipart/form-data">
    <label for="title">Title:</label>
    <input type="text" name="title" id="title" required>

    <label for="description">Description:</label>
    <textarea name="description" id="description" required></textarea>

    <label for="category">Category:</label>
    <input type="text" name="category" id="category" required>

    <label for="phone">Phone Number:</label>
    <input type="tel" name="phone" pattern="[0-9]{10}" required>

    <label for="image">Upload Image:</label>
    <input type="file" name="image" id="image" accept="image/*" required>

    <button type="submit" name="submit">Upload Item</button>
  </form>

  <?php if ($msg): ?>
    <div class="msg"><?php echo $msg; ?></div>
  <?php endif; ?>
</div>

</body>
</html