 <?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Recycle Relay</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #f9f9f9;
      color: #333;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    /* Header */
    header {
      background-color: #e6f5ea;
      display: flex;
      align-items: center;
      padding: 20px 40px;
      border-bottom: 2px solid #28a745;
    }

    .logo {
      width: 80px;
      height: 80px;
      margin-right: 25px;
    }

    .header-text {
      display: flex;
      flex-direction: column;
    }

    .header-text h1 {
      margin: 0;
      font-size: 2.5rem;
      color: #28a745;
      font-weight: bold;
    }

    .header-text p {
      margin: 8px 0 0;
      font-size: 1.2rem;
      color: #555;
    }

    /* Main Section */
    .main-section {
      text-align: center;
      padding: 80px 20px 60px;
      flex: 1;
    }

    .main-section h2 {
      font-size: 2rem;
      margin-bottom: 110px;
    }

    .cta-buttons {
      display: flex;
      justify-content: center;
      gap: 40px;
      flex-wrap: wrap;
    }

    .cta-buttons a {
      margin-bottom: 60px;
      text-decoration: none;
      background-color: #28a745;
      color: white;
      padding: 23px 60px;
      border-radius: 10px;
      font-size: 1.3rem;
      min-width: 220px;
      transition: background-color 0.3s ease;
    }

    .cta-buttons a:hover {
      background-color: #218838;
    }

    /* Footer */
    footer {
      background-color: #28a745;
      color: white;
      text-align: center;
      padding: 20px 10px;
      font-size: 1rem;
    }

    @media (max-width: 600px) {
      .header-text h1 {
        font-size: 2rem;
      }

      .cta-buttons a {
        font-size: 1.1rem;
        padding: 18px 40px;
      }
    }
  </style>
</head>
<body>

  <!-- Header -->
  <header>
    <img src="icon.jpg" alt="Recycle Icon" class="logo" />
    <div class="header-text">
      <h1>Recycle Relay</h1>
      <p>Connecting people to recycle and earn responsibly</p>
    </div>
  </header>

  <!-- Main Section -->
  <div class="main-section">
    <h2>Who are you?</h2>
    <div class="cta-buttons">
      <a href="indexU.php">I'm a Recycler</a>
      <a href="indexV.php">I'm a Vendor</a>
    </div>
  </div>

  <!-- Footer -->
  <footer>
    <p>&copy; 2025 Recycle Relay. All rights reserved.</p>
  </footer>

</body>
</html>
