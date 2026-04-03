<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include '../database/db_connect.php';

$user_id = $_SESSION['user_id'];
$sql = "SELECT first_name FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($first_name);
$stmt->fetch();
$stmt->close();
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine Recommendation System</title>
    <link rel="stylesheet" href="/Medi_recom/static/css/styles.css">
    </head>
<body>
    
    <div class="top-bar">
        <div class="logo">
        <img src="/Medi_recom/static/images/logo.jpg" alt="Logo" class="logo-img">
            <span class="logo-title">MediBot - Medicine Recommender</span>
        </div>
        <div class="nav-links">
        <a href="../templates/index.html">Home</a>
        <a href="http://127.0.0.1:5000/">Symptoms</a>
        <a href="../php/logout.php">Logout</a> 
        </div>
    </div>

   
    <div class="welcome-container">
        <div class="user-info">
        <h1>Welcome, <?php echo htmlspecialchars($first_name); ?>!</h1>
        </div>
        <div class="profile-pic">
        <img src="/Medi_recom/static/images/pp.jpg" alt="Profile Picture">
        </div>
    </div>

    
    <div class="option-buttons">
        <button onclick="window.location.href='../php/profile.php'">User Profile</button>
        <button onclick="window.location.href='../php/history.php'">View History</button>
        <button onclick="window.location.href='../php/health_data.php'">View Health Data</button>
    </div>

    <!-- Bottom Image -->
    <div class="bottom-image">
        <img src="../static/images/imageB.jpg" alt="Bottom Image">
    </div> 

</body>
</html>
