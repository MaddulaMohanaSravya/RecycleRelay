<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: indexU.php");
    exit();
}

$host = "sql312.infinityfree.com";
$dbname = "if0_39157215_usersauth";
$username = "if0_39157215";
$password = "7a3KRSPAcXd9w0E";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_SESSION['email'];
$query = $conn->prepare("SELECT name, phone, address FROM recyclers WHERE email = ?");
$query->bind_param("s", $email);
$query->execute();
$query->bind_result($name, $phone, $address);
$query->fetch();
$query->close();

// Handle nulls safely
$name = $name ?? '';
$phone = $phone ?? '';
$address = $address ?? '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $updatedName = $_POST['name'] ?? '';
    $updatedPhone = $_POST['phone'] ?? '';
    $updatedAddress = $_POST['address'] ?? '';

    $stmt = $conn->prepare("UPDATE recyclers SET name = ?, phone = ?, address = ? WHERE email = ?");
    $stmt->bind_param("ssss", $updatedName, $updatedPhone, $updatedAddress, $email);

    if ($stmt->execute()) {
        header("Location: dashboardU.php");
        exit();
    } else {
        echo "Error updating profile: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
    <style>
    /* Reset and Base Styles */
body {
  margin: 0;
  padding: 0;
  font-family: 'Segoe UI', sans-serif;
  background-color: #f9f9f9;
  color: #333;
}

/* Container for Profile Editing */
.profile-container {
  max-width: 500px;
  margin: 60px auto;
  padding: 30px 40px;
  background-color: #ffffff;
  border-radius: 12px;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

/* Heading */
.profile-container h2 {
  text-align: center;
  margin-bottom: 25px;
  font-size: 24px;
  font-weight: bold;
  color: #2d8f3f;
}

/* Form Group */
.form-group {
  margin-bottom: 20px;
}

/* Label Styling */
.form-group label {
  display: block;
  font-weight: 500;
  margin-bottom: 6px;
  color: #333;
}

/* Input and Textarea Fields */
.form-group input,
.form-group textarea {
  width: 100%;
  padding: 10px 12px;
  font-size: 15px;
  border: 1px solid #ccc;
  border-radius: 6px;
  transition: border-color 0.3s;
  background-color: #fff;
  color: #333;
}

.form-group input:focus,
.form-group textarea:focus {
  border-color: #28a745;
  outline: none;
}

/* Textarea Specific */
.form-group textarea {
  resize: vertical;
  min-height: 100px;
}

/* Submit Button */
button[type="submit"] {
  width: 100%;
  padding: 12px 18px;
  font-size: 16px;
  background-color: #2d8f3f;
  color: white;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
  background-color: #256f31;
}
</style>
</head>
<body>
<div class="profile-container">
    <h2>Edit Your Profile</h2>
    <form method="POST">
        <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" required />
        </div>
        <div class="form-group">
            <label>Phone</label>
            <input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>" />
        </div>
        <div class="form-group">
            <label>Address</label>
            <textarea name="address"><?php echo htmlspecialchars($address); ?></textarea>
        </div>
        <button type="submit">Update Profile</button>
    </form>
</div>
</body>
</html>
