 <?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Recycler Dashboard - Recycle Relay</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #f0f9f0;
      color: #333;
    }

    header {
      background-color: #28a745;
      color: white;
      padding: 20px 40px;
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

    .container {
      padding: 40px;
      text-align: center;
    }

    h2 {
      color: #28a745;
      margin-bottom: 20px;
    }

    p {
      font-size: 1.1rem;
    }

    .actions {
      margin-top: 30px;
      display: flex;
      justify-content: center;
      gap: 30px;
      flex-wrap: wrap;
    }

    .action-card {
      background-color: white;
      border-radius: 10px;
      padding: 25px;
      width: 280px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      transition: transform 0.2s;
    }

    .action-card:hover {
      transform: translateY(-5px);
    }

    .action-card h3 {
      margin-top: 0;
      color: #28a745;
    }

    .action-card a {
      text-decoration: none;
      color: #fff;
      background-color: #28a745;
      padding: 10px 20px;
      border-radius: 5px;
      display: inline-block;
      margin-top: 15px;
    }

    .action-card a:hover {
      background-color: #218838;
    }
  </style>
</head>
<body>

<header>
  <h1>Welcome, Recycler!</h1>
  <form action="logout.php" method="POST">
    <button type="submit" class="logout-btn">Logout</button>
  </form>
</header>

<div class="container">
  <h2>Hello, 👋</h2>
  <p>What would you like to do today?</p>

  <div class="actions">
    <div class="action-card">
      <h3>Upload Recyclable Item</h3>
      <p>Submit a new item to be recycled by vendors.</p>
      <a href="upload_item.php">Upload</a>
    </div>

    <div class="action-card">
      <h3>Track Item Status</h3>
      <p>Check if vendors accepted or picked up your items.</p>
      <a href="track_items.php">Track</a>
    </div>

    <div class="action-card">
      <h3>View Recycling History</h3>
      <p>See your previous recycling activity.</p>
      <a href="history.php">History</a>
    </div>
    
  </div>
</div>

</body>
</html>