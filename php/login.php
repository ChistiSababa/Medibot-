<?php
session_start();
include '../database/db_connect.php'; // Include your database connection file



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Prevent SQL Injection
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();
        
        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['email'] = $email;
            $_SESSION['loggedin'] = true;
            
            header("Location: index.php");
            exit();
        } else {
            $error = "Invalid email or password";
        }
    } else {
        $error = "Invalid email or password";
    }
    
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Your CSS styles here */
        @import url('https://fonts.googleapis.com/css?family=Abel|Abril+Fatface|Alegreya|Arima+Madurai|Dancing+Script|Dosis|Merriweather|Oleo+Script|Overlock|PT+Serif|Pacifico|Playball|Playfair+Display|Share|Unica+One|Vibur');
        
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            background-image: linear-gradient(-225deg, rgb(194, 233, 238) 0%, #FFE6FA 100%);
            background-attachment: fixed;
            font-family: 'Abel', sans-serif;
            opacity: .95;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            width: 450px;
            min-height: 500px;
            height: auto;
            border-radius: 5px;
            box-shadow: 0 9px 50px hsla(20, 67%, 75%, 0.31);
            padding: 2%;
            background-image: linear-gradient(-225deg, rgb(197, 197, 249) 50%, rgba(122, 81, 145, 0.82) 50%);
        }

        form .con {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            margin: 0 auto;
        }

        header {
            margin: 2% auto 10% auto;
            text-align: center;
        }

        header h2 {
            font-size: 250%;
            font-family: 'Playfair Display', serif;
            color: rgb(5, 3, 74);
            text-shadow: 2px 2px 10px rgba(69, 177, 235, 0.523);
        }

        header p {
            letter-spacing: 0.05em;
        }

        .input-item {
            background: #fff;
            color: #333;
            padding: 14.5px 0px 15px 9px;
            border-radius: 5px 0px 0px 5px;
        }

        #eye {
            background: #fff;
            color: #333;
            margin: 5.9px 0 0 0;
            margin-left: -20px;
            padding: 15px 9px 19px 0px;
            border-radius: 0px 5px 5px 0px;
            float: right;
            position: relative;
            right: 1%;
            top: -.2%;
            z-index: 5;
            cursor: pointer;
        }

        input[class="form-input"] {
            width: 240px;
            height: 50px;
            margin-top: 2%;
            padding: 15px;
            font-size: 16px;
            font-family: 'Abel', sans-serif;
            color: rgb(1, 4, 12);
            outline: none;
            border: none;
            border-radius: 0px 5px 5px 0px;
            transition: 0.2s linear;
        }

        input:focus {
            transform: translateX(-2px);
            border-radius: 5px;
        }

        button {
            display: inline-block;
            color: #252537;
            width: 280px;
            height: 50px;
            padding: 0 20px;
            background: #fff;
            border-radius: 5px;
            outline: none;
            border: none;
            cursor: pointer;
            text-align: center;
            transition: all 0.2s linear;
            margin: 7% auto;
            letter-spacing: 0.05em;
        }

        .submits {
            width: 48%;
            display: inline-block;
            float: left;
            margin-left: 2%;
        }

        .frgt-pass {
            background: transparent;
            color: #fff; 
        }

        .sign-up {
            background: #B8F2E6;
        }

        button:hover {
            transform: translatey(3px);
            box-shadow: none;
        }

        button[class="log-in"] {
            color: white;
            cursor: pointer;
            border: 2px solid rgb(66, 6, 94);
            background: linear-gradient(to right, rgb(201, 152, 230), rgb(66, 6, 94));
        }

        button[class="log-in"]:hover {
            background: linear-gradient(to right, rgb(94, 21, 105), rgb(63, 7, 85));
            border: 2px solid rgb(63, 7, 85);
        }

        @keyframes ani9 {
            0% {
                transform: translateY(3px);
            }
            100% {
                transform: translateY(5px);
            }
        }
    </style>
</head>
<body>
    <div class="overlay">
        <form method="POST">
            <div class="con">
                <header class="head-form">
                    <h2>Log In</h2>
                    <p>Login here using your username and password</p>
                </header>
                <br>
                <?php if (!empty($error)): ?>
                    <div style="color: red; text-align: center;"><?php echo $error; ?></div>
                <?php endif; ?>
                <div class="field-set">
                    <span class="input-item">
                        <i class="fa fa-envelope"></i> <!-- Email icon -->
                    </span>
                    <input class="form-input" id="txt-input" type="email" name="email" placeholder="Email" required>
                    <br>
                    <span class="input-item">
                        <i class="fa fa-key"></i>
                    </span>
                    <input class="form-input" type="password" placeholder="Password" id="pwd" name="password" required>
                    <span>
                        <i class="fa fa-eye" aria-hidden="true" type="button" id="eye"></i>
                    </span>
                    <br>
                    <button class="log-in" type="submit">Log In</button>
                </div>
                <div class="other">
                    <button class="btn submits frgt-pass" type="button" onclick="window.location.href='../php/forgot_pass.php'">Forgot Password</button>
                    <button class="btn submits sign-up" type="button" onclick="window.location.href='../php/signup.php'">Sign Up
                        <i class="fa fa-user-plus" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        // Show/hide password onClick of button using Javascript only
        function show() {
            var p = document.getElementById('pwd');
            p.setAttribute('type', 'text');
        }

        function hide() {
            var p = document.getElementById('pwd');
            p.setAttribute('type', 'password');
        }

        var pwShown = 0;

        document.getElementById("eye").addEventListener("click", function () {
            if (pwShown == 0) {
                pwShown = 1;
                show();
            } else {
                pwShown = 0;
                hide();
            }
        }, false);
    </script>
</body>
</html>