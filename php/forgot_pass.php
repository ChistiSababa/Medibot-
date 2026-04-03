<?php
session_start();
include '../database/db_connect.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['user_email'];

    // Check if the email exists in the database
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Email exists, redirect to reset password page
        $_SESSION['reset_email'] = $email; // Store email in session for verification
        header("Location: reset_password.php");
        exit();
    } else {
        // Email does not exist
        echo "<script>alert('Email not found!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Israt Jerin Prome">
    <meta name="description" content="Forgot Password Page Using HTML and CSS">
    <meta name="keywords" content="forgot password page,reset pass">
    <title>Forgot Password Page - HTML + CSS</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Segoe UI", Verdana, Helvetica, Arial, sans-serif;
        }

        body {
            background:linear-gradient(to bottom,rgba(240, 165, 239, 0.97),rgba(130, 242, 254, 0.59));
            
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff;
        }

        .row {
            background: linear-gradient(135deg,rgb(8, 46, 112),rgb(204, 162, 243));
            padding: 2em;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 90%;
            max-width: 400px;
        }

        h1 {
            font-size: 2em;
            margin-bottom: 0.5em;
        }

        .information-text {
            color: #ddd;
            margin-bottom: 1.5em;
        }

        .form-group {
            margin-bottom: 1.5em;
        }

        .form-group input {
            width: 100%;
            padding: 0.75em;
            border: none;
            border-radius: 5px;
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            font-size: 1em;
            margin-bottom: 1em;
        }

        .form-group input::placeholder {
            color: #ccc;
        }

        .form-group button {
            width: 100%;
            padding: 0.75em;
            border: none;
            border-radius: 5px;
            background: #fff;
            color: #2575fc;
            font-size: 1em;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .form-group button:hover {
            background: #f0f0f0;
        }

        .footer {
            margin-top: 1.5em;
        }

        .footer a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="row">
        <h1>Forgot Password</h1>
        <h6 class="information-text">Enter your registered email to reset your password.</h6>
        <form method="POST">
            <div class="form-group">
                <input type="email" name="user_email" placeholder="Email" required>
                <button type="submit">Reset Password</button>
            </div>
        </form>
        <div class="footer">
            <h5>New here? <a href="../php/signup.php">Sign Up.</a></h5>
            <h5>Already have an account? <a href="../php/login.php">Sign In.</a></h5>
        </div>
    </div>
</body>
</html>