<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Signup Form</title>
    <link rel="stylesheet" href="../static/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>
<body>
    <div class="container">
        <header>Signup Form</header>
        <div class="progress-bar">
            <div class="step">
                <p>Name</p>
                <div class="bullet"><span>1</span></div>
                <div class="check fas fa-check"></div>
            </div>
            <div class="step">
                <p>Contact</p>
                <div class="bullet"><span>2</span></div>
                <div class="check fas fa-check"></div>
            </div>
            <div class="step">
                <p>Details</p>
                <div class="bullet"><span>3</span></div>
                <div class="check fas fa-check"></div>
            </div>
            <div class="step">
                <p>Submit</p>
                <div class="bullet"><span>4</span></div>
                <div class="check fas fa-check"></div>
            </div>
        </div>
        <div class="form-outer">

            <form action="signup.php" method="POST">
                <!-- Page 1: Basic Info -->
                <div class="page slide-page">
                    <div class="title">Basic Info:</div>
                    <div class="field">
                        <div class="label">First Name</div>
                        <input type="text" name="first_name" required>
                    </div>
                    <div class="field">
                        <div class="label">Last Name</div>
                        <input type="text" name="last_name" required>
                    </div>
                    <div class="field">
                        <button class="firstNext next">Next</button>
                    </div>
                </div>

                <!-- Page 2: Contact Info -->
                <div class="page">
                    <div class="title">Contact Info:</div>
                    <div class="field">
                        <div class="label">Email Address</div>
                        <input type="email" name="email" required>
                    </div>
                    <div class="field">
                        <div class="label">Phone Number</div>
                        <input type="tel" name="phone" required>
                    </div>
                    <div class="field btns">
                        <button class="prev-1 prev">Previous</button>
                        <button class="next-1 next">Next</button>
                    </div>
                </div>

                <!-- Page 3: Additional Details -->
                <div class="page">
                    <div class="title">Additional Details:</div>
                    <div class="field">
                        <div class="label">Age</div>
                        <input type="number" name="age" required>
                    </div>
                    <div class="field">
                        <div class="label">Height (cm)</div>
                        <input type="number" name="height" required>
                    </div>
                    <div class="field">
                        <div class="label">Weight (kg)</div>
                        <input type="number" name="weight" required>
                    </div>
                    <div class="field">
                        <div class="label">Gender</div>
                        <select name="gender" required>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="field btns">
                        <button class="prev-2 prev">Previous</button>
                        <button class="next-2 next">Next</button>
                    </div>
                </div>

                <!-- Page 4: Login Details -->
                <div class="page">
                    <div class="title">Login Details:</div>
                    <div class="field">
                        <div class="label">Username</div>
                        <input type="text" name="username" required>
                    </div>
                    <div class="field">
                        <div class="label">Password</div>
                        <input type="password" name="password" required>
                    </div>
                    <div class="field btns">
                        <button class="prev-3 prev">Previous</button>
                        <button type="submit" name="submit" class="submit">Submit</button>
                    </div>
                </div>
            </form>
            <div class="footer">
            
            <h5>Ready to begin? <a href="../php/login.php">Let’s go!</a></h5>
        </div>
        </div>
    </div>
    <script src="../static/js/script.js"></script>

    <?php
  
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Debugging: Print all POST data
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
  // Log POST data to the server's error log
  error_log(print_r($_POST, true));
}

    include '../database/db_connect.php';
    
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Collect form data
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $age = $_POST['age'];
        $height = $_POST['height'];
        $weight = $_POST['weight'];
        $gender = $_POST['gender'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT); //

       

        // Insert data into the database
        $sql = "INSERT INTO users (first_name, last_name, email, phone, age, height, `weight`, gender, username, `password`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error); 
    }

    $stmt->bind_param("ssssiiisss", $first_name, $last_name, $email, $phone, $age, $height, $weight, $gender, $username, $password);
        
    if ($stmt->execute()) {
      
      echo "Data inserted successfully!<br>";
  } else {
      
      echo "Error inserting data: " . $stmt->error . "<br>";
  }

 
  $stmt->close();
  $conn->close();
}
?>

<style>
    @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
*{
  margin: 0;
  padding: 0;
  outline: none;
  font-family: 'Poppins', sans-serif;
}
body{
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  overflow: hidden;
  background: url("bg.png"), -webkit-linear-gradient(bottom, #0250c5, #d43f8d);
}
::selection{
  color: #fff;
  background:rgb(135, 63, 212);
}
.container{
  width: 300px;
  background: #fff;
  text-align: center;
  border-radius: 5px;
  padding: 30px 20px 10px 20px;
}
.container header{
  font-size: 35px;
  font-weight: 600;
  margin: 0 0 20px 0;
}
.container .form-outer{
  width: 100%;
  overflow: hidden;
}
.container .form-outer form{
  display: flex;
  width: 400%;
}
.form-outer form .page{
  width: 25%;
  transition: margin-left 0.3s ease-in-out;
}
.form-outer form .page .title{
  text-align: left;
  font-size: 20px;
  font-weight: 500;
  margin-bottom: 15px;
}
.form-outer form .page .field{
  width: 100%;
  height: 40px;
  margin: 30px 0;
  display: flex;
  position: relative;
}


form .page .field .label{
  position: absolute;
  top: -25px;
  font-weight: 500;
  font-size: 14px;
}
form .page .field input{
  height: 100%;
  width: 100%;
  border: 1px solid lightgrey;
  border-radius: 5px;
  padding-left: 10px;
  font-size: 14px;
}
form .page .field select{
  width: 100%;
  padding-left: 10px;
  font-size: 14px;
  font-weight: 500;
}
form .page .field button{
  width: 100%;
  height: 40px;
  border: none;
  background:rgb(212, 63, 141);
  margin-top: -10px;
  border-radius: 5px;
  color: #fff;
  cursor: pointer;
  font-size: 14px;
  font-weight: 500;
  letter-spacing: 1px;
  text-transform: uppercase;
  transition: 0.5s ease;
  text-shadow: 2px 2px 4px rgb(14, 0, 20); /* Text shadow */
  box-shadow: 2px 2px 10px rgba(0, 21, 29, 0.9); /* Box shadow */
}
form .page .field button:hover{
  background: #000;
}
form .page .btns button{
  margin-top: -10px!important;
}
form .page .btns button.prev{
  margin-right: 3px;
  font-size: 14px;
}
form .page .btns button.next{
  margin-left: 3px;
}
.container .progress-bar{
  display: flex;
  margin: 20px 0;
  user-select: none;
}
.container .progress-bar .step{
  text-align: center;
  width: 100%;
  position: relative;
}
.container .progress-bar .step p{
  font-weight: 500;
  font-size: 14px;
  color: #000;
  margin-bottom: 5px;
}
.progress-bar .step .bullet{
  height: 20px;
  width: 20px;
  border: 2px solid #000;
  display: inline-block;
  border-radius: 50%;
  position: relative;
  transition: 0.2s;
  font-weight: 500;
  font-size: 14px;
  line-height: 20px;
}
.progress-bar .step .bullet.active{
  border-color: #d43f8d;
  background: #d43f8d;
}
.progress-bar .step .bullet span{
  position: absolute;
  left: 50%;
  transform: translateX(-50%);
}
.progress-bar .step .bullet.active span{
  display: none;
}
.progress-bar .step .bullet:before,
.progress-bar .step .bullet:after{
  position: absolute;
  content: '';
  bottom: 9px;
  right: -41px;
  height: 2px;
  width: 35px;
  background: #262626;
}
.progress-bar .step .bullet.active:after{
  background: #d43f8d;
  transform: scaleX(0);
  transform-origin: left;
  animation: animate 0.3s linear forwards;
}
@keyframes animate {
  100%{
    transform: scaleX(1);
  }
}
.progress-bar .step:last-child .bullet:before,
.progress-bar .step:last-child .bullet:after{
  display: none;
}
.progress-bar .step p.active{
  color: #d43f8d;
  transition: 0.2s linear;
}
.progress-bar .step .check{
  position: absolute;
  left: 50%;
  top: 70%;
  font-size: 12px;
  transform: translate(-50%, -50%);
  display: none;
}
.progress-bar .step .check.active{
  display: block;
  color: #fff;
}
.footer {
            margin-top: 1 em;
        }

        .footer a {
            color: black;
            text-decoration: underline double #0077cc;
            font-weight: bold;
            
        }

        .footer a:hover {
            text-decoration: underline;
            
        }


</style>
</body>
</html>

