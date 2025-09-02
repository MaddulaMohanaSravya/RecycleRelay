 <?php
session_start();
if (isset($_SESSION['email'])) {
    header("Location: dashboardU.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Recycle Relay - Recycler Auth</title>
    <style>
        body {
  margin: 0;
  font-family: 'Segoe UI', sans-serif;
  background-color: #f9f9f9;
  color: #333;
}

/* Header */
header {
background-color: #e6f5ea;
display: flex;
align-items: center;
padding: 20px 40px;
border-bottom: 2px solid #28a745;
}

/* Add this inside your <style> tag or CSS file */
.recycler-heading {
  text-align: center;
  font-size: 2.2rem;
  color: #28a745;
  font-weight: bold;
  margin-top: 40px;
  margin-bottom: 20px;
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
.page-title {
      text-align: center;
      margin-top: 50px;
      font-size: 2rem;
      color: #28a745;
      font-weight: bold;
    }
    .auth-container {
      display: flex;
      justify-content: space-around;
      flex-wrap: wrap;
      padding: 40px 20px 60px;
      max-width: 1200px;
      margin: auto;
    }

    
/* Main Content */
.main-content {
  display: flex;
      justify-content: space-around;
      flex-wrap: wrap;
      padding: 40px 20px 60px;
      max-width: 1200px;
      margin: auto;
}

/* Container for Forms */
.container {
background-color: #fff;
padding: 30px 40px;
border-radius: 10px;
box-shadow: 0 0 10px rgba(0,0,0,0.1);
width: 100%;
max-width: 400px;
margin: 30px auto;
}

/* Toggle Buttons */
.switch-buttons {
display: flex;
justify-content: space-between;
margin-bottom: 20px;
gap: 10px;
}

.switch-buttons button {
flex: 1;
padding: 10px;
border: none;
background-color: #e0e0e0;
cursor: pointer;
transition: background-color 0.3s;
font-weight: bold;
border-radius: 5px 5px 0 0;
}

.switch-buttons button.active {
background-color: #4CAF50;
color: white;
}

/* Form Styling */
.auth-box {
display: none;
      background-color: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
      margin-bottom: 40px;
}

.auth-box h2 {
text-align: center;
color: #28a745;
margin-bottom: 20px;
}

.form-group {
margin-bottom: 18px;
}

.form-group label {
display: block;
margin-bottom: 6px;
font-weight: 500;
color: #333;
}

.form-group input,
.form-group textarea {
width: 100%;
padding: 10px 12px;
border-radius: 6px;
border: 1px solid #ccc;
font-size: 15px;
}

.form-group textarea {
resize: vertical;
height: 100px;
}

button[type="submit"] {
width: 100%;
padding: 10px 18px;
background-color: #2d8f3f;
color: white;
font-size: 16px;
border: none;
border-radius: 8px;
cursor: pointer;
transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
background-color: #256f31;
}


/* Footer */
footer {
background-color: #28a745;
color: white;
text-align: center;
padding: 30px;
margin-top: auto;
}
    </style>
</head>
<body>
  
<header>
    <img src="icon.jpg" alt="Recycle Icon" class="logo" />
    <div class="header-text">
      <h1>Recycle Relay</h1>
      <p>Connecting people to recycle and earn responsibly</p>
    </div>
  </header>

  <!-- Recycler Heading -->
<h2 class="recycler-heading">Recycler</h2>
  <div class="container">
      

        <div class="switch-buttons">
            <button id="show-signin" class="active">Sign In</button>
            <button id="show-signup">Sign Up</button>
        </div>
          <?php
            if (isset($_SESSION['error'])) {
                echo "<p style='color:red;'>" . $_SESSION['error'] . "</p>";
                unset($_SESSION['error']);
            }
            ?>
        <form class="auth-box signin" method="POST" action="Usignin.php">
            <h2>Sign In</h2>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" required />
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" required />
            </div>
            <button type="submit">Login</button>
        </form>

   
        <form class="auth-box signup" method="POST" action="Usignup.php" style="display: none;">
            <h2>Sign Up</h2>
            <div class="form-group">
                <label>Name:</label>
                <input type="text" name="name" required />
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" required />
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" required />
            </div>
            
            <button type="submit">Register</button>
        </form>
        
    </div>

  <!-- Footer -->
  <footer>
    <p>&copy; 2025 Recycle Relay. All rights reserved.</p>
  </footer>
  <script src="script.js"></script>
</body>
</html>