 <?php
session_start();

$conn = new mysqli("sql312.infinityfree.com", "if0_39157215", "7a3KRSPAcXd9w0E", "if0_39157215_usersauth");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$shopname = trim($_POST['shopname']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);

$check = $conn->prepare("SELECT id FROM vendors WHERE email = ?");
$check->bind_param("s", $email);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    $_SESSION['error'] = "Email already exists.";
    header("Location: indexV.php");
    exit();
}

$hashed = password_hash($password, PASSWORD_DEFAULT);
$stmt = $conn->prepare("INSERT INTO vendors (shopname, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $shopname, $email, $hashed);

if ($stmt->execute()) {
    $_SESSION['email'] = $email;
    $_SESSION['user_id'] = $stmt->insert_id;
    header("Location: dashboardV.php");
    exit();
} else {
    $_SESSION['error'] = "Registration failed.";
    header("Location: indexV.php");
    exit();
}
?