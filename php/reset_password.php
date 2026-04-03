<?php
session_start();
include '../database/db_connect.php'; // Include your database connection file

if (!isset($_SESSION['reset_email'])) {
    // Redirect if the email is not set in the session
    header("Location: forgot_pass.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $email = $_SESSION['reset_email'];

    // Check if passwords match
    if ($new_password === $confirm_password) {
        // Hash the new password (for security)
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update the password in the database
        $sql = "UPDATE users SET password='$hashed_password' WHERE email='$email'";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Password updated successfully!');</script>";
            header("Location: login.php"); // Redirect to login page
            exit();
        } else {
            echo "<script>alert('Error updating password!');</script>";
        }
    } else {
        echo "<script>alert('Please write password correctly!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Israt Jerin Prome">
    <meta name="description" content="Reset Password Page">
    <meta name="keywords" content="reset password page, Update passward">
    <title>Reset Password</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Segoe UI", Verdana, Helvetica, Arial, sans-serif;
        }

        body {
            background: linear-gradient(135deg,rgb(143, 191, 245),rgb(234, 121, 198));
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff;
        }

        .row {
            background: rgb(67, 20, 118);
            padding: 2em;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.84);
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
            position: relative;
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
            padding-right: 40px;
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
            color:rgb(6, 20, 43);
            font-size: 1em;
            cursor: pointer;
           transition: 0.3s ease;
        }

        .form-group button:hover {
            background: #f0f0f0;
        }
        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #fff;
            z-index: 2;
        }
    </style>

</head>
<body>
    <div class="row">
        <h1>Reset Password</h1>
        <h6 class="information-text">Enter your new password.</h6>
        <form method="POST">
             <div class="form-group">
            <input type="password" name="new_password" id="new_password" placeholder="New Password" required>
                <span class="toggle-password" onclick="togglePassword('new_password')">
                    <i class="fa fa-eye"></i>
                </span>
             </div>
            <div class="form-group">
           
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
                <span class="toggle-password" onclick="togglePassword('confirm_password')">
                <i class="fa fa-eye"></i>
                </span>
             </div>
            <div class="form-group">
             <button type="submit" class="form-group">Update Password</button>
            </div>
        </form>
    </div>

    <!-- Font Awesome for the eye icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <script>
        // Function to toggle password visibility
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = input.nextElementSibling.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
