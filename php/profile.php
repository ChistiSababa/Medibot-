<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include '../database/db_connect.php';

$user_id = $_SESSION['user_id'];
$sql = "SELECT first_name, last_name, email, phone, age, gender, height, `weight` FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($first_name, $last_name, $email,$phone, $age,$gender, $height, $weight);
$stmt->fetch();
$stmt->close();
$conn->close();
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="../static/css/styles.css">
    <style>
        
        body {
            background-image: linear-gradient(-225deg, rgb(224, 240, 244) 0%, #FFE6FA 100%);
            background-attachment: fixed;
            
        }


        .profile-container {
            background: linear-gradient(to top,rgb(190, 220, 238),rgb(221, 242, 244), rgb(215, 203, 220),rgb(229, 194, 233), rgb(99, 55, 119));
            
            padding: 30px;
            margin: 20px auto;
            max-width: 900px; 
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(39, 31, 43, 0.63);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-direction: column; 
        }

        .profile-container h1 {
            font-size: 30px;
            color: #333;
            margin-bottom: 20px;
        }

        .profile-info p {
            font-size: 18px;
            color: #666;
            margin: 10px 0;
        }

        
        .profile-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            margin-bottom: 20px;
        }

        
        .profile-info {
            flex: 1; 
        }

       
        .medicine-img {
            width: 300px; 
            height: auto;
            object-fit: cover;
            border-radius: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* Text shadow */
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.3); /* Box shadow */
            background:  linear-gradient(to bottom,rgb(249, 249, 249),rgb(215, 221, 255));;
        }

        
        .button-container {
            display: flex;
            gap: 10px; 
            justify-content: center; 
            width: 100%;
        }

        
        .go-back-btn, .update-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #6a5acd;
            color: white;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            text-align: center;
            transition: background 0.3s ease;
            margin-top: 20px;
            border-radius: 5px; 
           text-shadow: 2px 2px 4px rgb(5, 1, 24); 
           box-shadow: 2px 2px 10px rgba(20, 2, 39, 0.77);
           
           
           
        }

        .go-back-btn:hover, .update-btn:hover {
            background-color: #00bfff;
        }


        
    </style>
</head>
<body>
       <div class="top-bar">
           <div class="logo">
                <img src="../static/images/logo.jpg" alt="Logo" class="logo-img">
                <span class="logo-title">MediBot - Medicine Recommender</span>
            </div>
            <div class="nav-links">
            <a href="../templates/index.html">Home</a> 
            <a href="../php/symptoms.php">Symptoms</a> 
            <a href="../php/logout.php">Logout</a> 
        </div>
        
        </div>

   
    <div class="profile-container">
        
        <div class="profile-content">
           
            <div class="profile-info">
            <h1><?php echo htmlspecialchars($first_name . ' ' . $last_name); ?></h1>
                <p>Email: <?php echo htmlspecialchars($email); ?></p>
                <p>Phone: <?php echo htmlspecialchars($phone); ?></p>
                <p>Age: <?php echo htmlspecialchars($age); ?></p>
                <p>Gender: <?php echo htmlspecialchars($gender); ?></p>
                <p>Height: <?php echo htmlspecialchars($height); ?></p>
                <p>Weight: <?php echo htmlspecialchars($weight); ?></p>
                
            
            </div>

           
            <img src="../static/images/profileimage.jpg" alt="Medicine Image" class="medicine-img">
        </div>

        
        <div class="button-container">
           
            <a href="../php/index.php" class="go-back-btn">Go Back</a>

            
            <a href="../php/edit_profile.php" class="update-btn">Edit Profile</a>
        </div>
    </div>
</body>
</html>
