<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include '../database/db_connect.php';

// Fetch user data based on email
$user_id = $_SESSION['user_id'];
$sql = "SELECT first_name, last_name, email, phone, age, gender, height, weight FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($first_name, $last_name, $email, $phone, $age, $gender, $height, $weight);
$stmt->fetch();
$stmt->close();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];

    // Update user data in the database
    $sql = "UPDATE users SET first_name = ?, last_name = ?, email = ?, phone = ?, age = ?, gender = ?, height = ?, weight = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssi", $first_name, $last_name, $email, $phone, $age, $gender, $height, $weight, $user_id);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    // Redirect to profile page after saving changes
    header("Location: profile.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="../static/css/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right,#f0d2ef, #dfe4f8, #ace2e8, #dfe4f8,#e2cfed);

            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
        }

        .top-bar {
            background: linear-gradient(to right, #20126d, #a772c6);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 0px;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);

        }

        .logo {
    display: flex;
    align-items: center; /* Vertically centers logo and title */
}

.logo-img {
    width: 60px; /* Adjust logo size */
    height: auto;
}

.logo-title {
    color: white;
    font-size: 22px;
    margin-left: 10px; /* Adds space between logo and title */
    font-weight: bold;
    font-family: 'Georgia', serif;
    background-color: linear-gradient(to right, #1b0d6bf4, #a772c6);
    padding: 5px 10px;
    border-radius: 5px; /* Rounded corners */
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* Text shadow */
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.3); /* Box shadow */
}

        .nav-links a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-size: 18px;
            padding: 1px 5px; /* Added padding */
            border-radius: 5px;
        }

        .nav-links a:hover {
            text-decoration: underline;
        }

        .profile-container {
            background:linear-gradient(to bottom,rgba(225, 155, 233, 0.96),rgba(101, 118, 178, 0.96), #a772c6);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
            max-width: 100%;
            margin-top: 50px;
            /* Increased margin to avoid cut-off */
            
        }

        .profile-container h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
            text-align: center;
            text-shadow: 2px 2px 4px rgb(184, 123, 234); 
        }

        .profile-container label {
            display: block;
            margin-bottom: 5px;
            color: black;
            text-shadow: 2px 2px 4px rgb(160, 202, 227);  
        }

        .profile-container input,
        .profile-container select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .profile-container button {
            width: 100%;
            padding: 10px;
            background-color:rgb(65, 54, 138);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            text-shadow: 2px 2px 4px rgb(22, 0, 36); /* Text shadow */
            box-shadow: 2px 2px 10px rgba(13, 0, 30, 1);

        }

        .profile-container button:hover {
            background-color: #5a4acd;
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
        <h1>Edit Profile</h1>
        <form method="POST" action="edit_profile.php">
            <label for="first_name">First Name</label>
            <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($first_name); ?>" required>

            <label for="last_name">Last Name</label>
            <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($last_name); ?>" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>

            <label for="phone">Phone</label>
            <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($phone); ?>" required>

            <label for="age">Age</label>
            <input type="number" id="age" name="age" value="<?php echo htmlspecialchars($age); ?>" required>

            <label for="gender">Gender</label>
            <select id="gender" name="gender" required>
                <option value="Male" <?php echo ($gender == 'Male') ? 'selected' : ''; ?>>Male</option>
                <option value="Female" <?php echo ($gender == 'Female') ? 'selected' : ''; ?>>Female</option>
                <option value="Other" <?php echo ($gender == 'Other') ? 'selected' : ''; ?>>Other</option>
            </select>

            <label for="height">Height</label>
            <input type="text" id="height" name="height" value="<?php echo htmlspecialchars($height); ?>" required>

            <label for="weight">Weight</label>
            <input type="text" id="weight" name="weight" value="<?php echo htmlspecialchars($weight); ?>" required>

            <button type="submit">Save Changes</button>
        </form>
    </div>
</body>
</html>