<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diet Chart</title>
    <link rel="stylesheet" href="../static/css/styles.css">

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
            <a href="../php/logout.php">Logout</a>
        </div>
    </div>

    <div class="diet-chart-container">
        <h1>Diet Chart for <span id="disease-name">Detected Disease</span></h1>
        <p class="intro-text">Here is the recommended diet plan for the detected disease:</p>

        <ul class="diet-chart-list">
            <li><strong>Breakfast:</strong> Oatmeal with fresh fruit and a boiled egg.</li>
            <li><strong>Lunch:</strong> Grilled chicken with quinoa and steamed vegetables.</li>
            <li><strong>Snack:</strong> Almonds and a cup of green tea.</li>
            <li><strong>Dinner:</strong> Baked salmon with a side of mixed greens and sweet potato.</li>
        </ul>

        <div class="diet-section">
            <h2>Additional Tips</h2>
            <p>Drink plenty of water throughout the day to stay hydrated.</p>
            <p>Avoid processed foods and high sugar intake.</p>
        </div>

        <div class="diet-section">
            <h2>Warnings & Restrictions</h2>
            <p>Avoid fried foods, dairy, and excessive salt intake.</p>
        </div>

        <div class="action-buttons">
            <button onclick="window.location.href='../templates/disease.html'">Back</button>
        </div>
    </div>

</body>
</html>
