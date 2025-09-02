 <?php
session_start();

$conn = new mysqli("sql312.infinityfree.com", "if0_39157215", "7a3KRSPAcXd9w0E", "if0_39157215_usersauth");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = trim($_POST['email']);
$password = trim($_POST['password']);

$sql = "SELECT * FROM recyclers WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        $_SESSION['email'] = $user['email'];
        $_SESSION['user_id'] = $user['id'];
        header("Location: dashboardU.php");
        exit();
    }
}
    // Invalid credentials
    $_SESSION['error'] = "Invalid credentials.";
    header("Location: indexU.php"); // redirect to login page
    exit();
?