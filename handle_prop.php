 <?php
$host = "sql312.infinityfree.com";
$dbname = "if0_39157215_usersauth";
$username = "if0_39157215";
$password = "7a3KRSPAcXd9w0E";
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = intval($_POST['id']);
    $action = $_POST['action'];

    if ($action === "accept") {
        $status = "Accepted";
    } elseif ($action === "reject") {
        $status = "Rejected";
    } else {
        die("Invalid action.");
    }

    $stmt = $conn->prepare("UPDATE recycle_items SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $id);
    if ($stmt->execute()) {
        header("Location: dashboardV.php");
        exit();
    } else {
        echo "Error updating proposal: " . $conn->error;
    }
    $stmt->close();
}

$conn->close();
?>