<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remedies</title>
    <link rel="stylesheet" href="../static/css/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url('uploaded_pic/remedy.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }

        .top-bar {
         background: linear-gradient(to right, #20126d, #a772c6);
         display: flex;
         align-items: center;
          justify-content: space-between;
          padding: 10px 20px;
         width: 100%;
         box-sizing: border-box;
         margin: 0;
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
        }

        .nav-links a:hover {
            text-decoration: underline;
        }

        /* Remedies Section */
        .remedy-container {
            text-align: center;
            background: linear-gradient(to bottom,rgba(207, 228, 247, 0.9),rgb(249, 230, 243));

            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            width: 80%;
            max-width: 1000px;
            padding: 20px;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }

        .remedy-container h1 {
            font-size: 35px;
            color: #333;
        }

        .remedy-container span {
            color: #6a5acd;
            font-weight: bold;
        }

        .intro-text {
            font-size: 22px;
            margin-bottom: 15px;
        }

        .remedy-list {
            text-align: left;
            padding: 0;
            list-style-type: none;
            font-size: 20px;
            margin: 0 auto;
        }

        .remedy-list li {
            background: #f8f8ff;
            padding: 8px;
            margin: 5px 0;
            border-radius: 5px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .remedy-section {
            text-align: left;
            margin-top: 15px;
            padding: 10px;
            background-color: #f8f8ff;
            border-radius: 8px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            font-size: 20px;
        }

        .remedy-section h2 {
            color: #6a5acd;
            font-size: 22px;
            margin-bottom: 5px;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 15px;
        }

        .action-buttons button {
            background: #6a5acd;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 14px;
            cursor: pointer;
            border-radius: 5px;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .action-buttons button:hover {
            background: #00bfff;
            transform: scale(1.05);
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
            <a href="../templates/symptoms.html">Symptoms</a>
            <a href="../templates/logout.php">Logout</a>
        </div>
    </div>

    <div class="remedy-container">
        <h1>Home Remedies for <span id="disease-name">Detected Disease</span></h1>
        <p class="intro-text">Here are some natural remedies you can try:</p>

        <ul class="remedy-list">
            <li><strong>Remedy 1:</strong> Ginger Tea - Helps with nausea and digestion.</li>
            <li><strong>Remedy 2:</strong> Honey and Lemon - Soothes sore throat and cough.</li>
            <li><strong>Remedy 3:</strong> Turmeric Milk - Helps in reducing inflammation.</li>
        </ul>

        <div class="remedy-section">
            <h2>Preparation Instructions</h2>
            <p><strong>Ginger Tea:</strong> Boil fresh ginger slices in water for 5-10 minutes. Add honey and lemon for taste.</p>
            <p><strong>Honey and Lemon:</strong> Mix one tablespoon of honey with the juice of half a lemon and drink warm.</p>
            <p><strong>Turmeric Milk:</strong> Heat a glass of milk and add half a teaspoon of turmeric powder. Stir well.</p>
        </div>

        <div class="action-buttons">
            <button onclick="window.location.href='../templates/disease.html'">Back</button>
        </div>
    </div>

</body>
</html>
