# Medicine Recommendation System (MediBot)

A comprehensive AI-powered healthcare assistant that predicts diseases based on symptoms and provides personalized medication, diet, and workout recommendations.

##  Important Disclaimer

**This system is for educational and informational purposes only. It is not a substitute for professional medical advice, diagnosis, or treatment. Always consult with qualified healthcare professionals for medical concerns.**

##  Features

- **Disease Prediction**: Machine learning model predicts diseases from user-inputted symptoms
- **Personalized Recommendations**:
  - Medication suggestions
  - Dietary guidelines
  - Workout plans
  - Preventive measures
- **User Authentication**: Secure login/signup system
- **Responsive Web Interface**: Modern, user-friendly design
- **Multi-language Support**: Handles various symptom descriptions

##  Tech Stack

### Backend
- **Python Flask**: Web framework for the prediction engine
- **Scikit-learn**: Machine learning library (SVM classifier)
- **Pandas & NumPy**: Data processing and analysis

### Frontend
- **HTML5/CSS3**: Responsive web design
- **JavaScript**: Interactive user interface
- **Bootstrap**: UI framework

### Database & Authentication
- **MySQL**: User data storage
- **PHP**: Server-side authentication and user management

##  Dataset

The system uses comprehensive medical datasets including:
- **Training Data**: 132 symptoms mapped to 41 diseases
- **Medication Database**: Treatment recommendations for each disease
- **Diet Plans**: Nutritional guidelines for disease management
- **Workout Routines**: Exercise recommendations
- **Precaution Database**: Preventive measures

##  Installation & Setup

### Prerequisites
- Python 3.7+
- MySQL/XAMPP
- Git

### 1. Clone the Repository
```bash
git clone https://github.com/ChistiSababa/Medibot-.git
cd Medibot-
```

### 2. Set Up Python Environment
```bash
# Create virtual environment
python -m venv venv

# Activate virtual environment
# Windows:
venv\Scripts\activate
# Linux/Mac:
source venv/bin/activate

# Install dependencies
pip install flask mysql-connector-python pandas numpy scikit-learn
```

### 3. Set Up Database
1. Start XAMPP (Apache + MySQL)
2. Create database: `medicine_recommendation`
3. Import database schema from `database/db_connect.php`

### 4. Train the Model (Optional)
```bash
python train_model.py
```
This will generate the `svc.pkl` model file.

### 5. Run the Application
```bash
# Start Flask app
python app.py

# Access at: http://127.0.0.1:5000
```

### 6. PHP Authentication (Optional)
- Place PHP files in your web server's root directory
- Access authentication pages at `http://localhost/php/`

##  Usage

### Disease Prediction
1. Open the application in your browser
2. Select 5 symptoms from the dropdown menus
3. Click "Predict" to get diagnosis
4. View comprehensive recommendations:
   - **Disease**: Predicted condition
   - **Medications**: Treatment options
   - **Diet**: Nutritional recommendations
   - **Workout**: Exercise suggestions

### User Management
- **Sign Up**: Create new account
- **Login**: Access personalized dashboard
- **Profile**: Manage user information

##  Model Details

### Algorithm
- **Support Vector Machine (SVM)** with linear kernel
- **Accuracy**: 100% on training data
- **Features**: 132 binary symptom indicators

### Training Process
1. Data preprocessing and feature engineering
2. Model training with cross-validation
3. Hyperparameter optimization
4. Model serialization for deployment

##  Project Structure

```
MedicineRecommendationSystem/
├── app.py                 # Main Flask application
├── main.py               # Helper functions and utilities
├── train_model.py        # Model training script
├── Medicine-Recommendation-System.ipynb  # Jupyter notebook
├── datasets/             # Medical datasets
│   ├── Training.csv
│   ├── medications.csv
│   ├── diets.csv
│   └── ...
├── templates/            # HTML templates
│   ├── symptoms.html
│   ├── disease.html
│   └── ...
├── static/               # CSS, JS, images
│   ├── css/
│   ├── js/
│   └── images/
├── php/                  # PHP authentication system
│   ├── login.php
│   ├── signup.php
│   └── ...
├── database/             # Database configuration
└── .gitignore
```


## Acknowledgments

- Medical datasets sourced from Kaggle.
- Built with educational purposes in mind
- Inspired by advancements in AI-assisted healthcare

## Problems:
- Need a proper verified dataset
---

**Remember**: This tool provides general information based on common medical knowledge and should not replace professional medical consultation.