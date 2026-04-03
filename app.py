from flask import Flask, render_template, request,redirect, url_for, session
import mysql.connector
import pickle
import numpy as np
from main import symptoms_dict,diseases_list,get_predicted_value,helper
import pandas as pd



app = Flask(__name__)
app.secret_key = 'your_secret_key'  # Set your secret key


# Load the pre-trained model
with open('svc.pkl', 'rb') as f:
    model = pickle.load(f)

# Connect to your XAMPP MySQL database
db = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",  # Default XAMPP has no MySQL password
    database="medicine_recommendation"
)
cursor = db.cursor()

@app.route('/')
def home():
    return render_template('symptoms.html')

@app.route('/index')
def index():
    session.clear()  # Optional
    return render_template('index.html')

@app.route('/logout')
def logout():
    session.clear()
    return redirect(url_for('index'))




@app.route('/predict', methods=['POST'])
def predict():
    if request.method == 'POST':
        symptoms = [
            request.form['symptom1'],
            request.form['symptom2'],
            request.form['symptom3'],
            request.form['symptom4'],
            request.form['symptom5']
        ]  # Replace 'input_field' with the actual name of your input field in HTML
        print("Symptoms received:", symptoms)  # Debugging: check the symptoms from the form

        # Create 132-length binary vector
        input_vector = [0] * 132
        for symptom in symptoms:
            if symptom in symptoms_dict:  # Make sure symptom exists in the dictionary
                index = symptoms_dict[symptom]
                input_vector[index] = 1
            else:
                print(f"Warning: '{symptom}' is not a valid symptom.")
        print("Input Vector:", input_vector) 
        # Make prediction
        prediction = model.predict([input_vector])[0]  
        print(f"Predicted index from model: {prediction}")
        print(f"Diseases List length: {len(diseases_list)}")

        if prediction in diseases_list:
            predicted_disease = diseases_list[prediction]
        else:
            predicted_disease = "Unknown disease"
        
        print(f"Predicted Disease Name: {predicted_disease}") # maps to name like 'Fungal infection'
        


        return render_template('disease.html', prediction_result=predicted_disease)

@app.route('/medication/<disease>')
def medication(disease):
    medications_dict = {
    "Fungal infection": ['Antifungal Cream', 'Fluconazole', 'Terbinafine', 'Clotrimazole', 'Ketoconazole'],
    "Allergy": ['Antihistamines', 'Decongestants', 'Epinephrine', 'Corticosteroids', 'Immunotherapy'],
    "GERD": ['Proton Pump Inhibitors (PPIs)', 'H2 Blockers', 'Antacids', 'Prokinetics', 'Antibiotics'],
    "Chronic cholestasis": ['Ursodeoxycholic acid', 'Cholestyramine', 'Methotrexate', 'Corticosteroids', 'Liver transplant'],
    "Drug Reaction": ['Antihistamines', 'Epinephrine', 'Corticosteroids', 'Antibiotics', 'Antifungal Cream'],
    "Peptic ulcer disease": ['Antibiotics', 'Proton Pump Inhibitors (PPIs)', 'H2 Blockers', 'Antacids', 'Cytoprotective agents'],
    "AIDS": ['Antiretroviral drugs', 'Protease inhibitors', 'Integrase inhibitors', 'Entry inhibitors', 'Fusion inhibitors'],
    "Diabetes": ['Insulin', 'Metformin', 'Sulfonylureas', 'DPP-4 inhibitors', 'GLP-1 receptor agonists'],
    "Gastroenteritis": ['Antibiotics', 'Antiemetic drugs', 'Antidiarrheal drugs', 'IV fluids', 'Probiotics'],
    "Bronchial Asthma": ['Bronchodilators', 'Inhaled corticosteroids', 'Leukotriene modifiers', 'Mast cell stabilizers', 'Anticholinergics'],
    "Hypertension": ['Antihypertensive medications', 'Diuretics', 'Beta-blockers', 'ACE inhibitors', 'Calcium channel blockers'],
    "Migraine": ['Analgesics', 'Triptans', 'Ergotamine derivatives', 'Preventive medications', 'Biofeedback'],
    "Cervical spondylosis": ['Pain relievers', 'Muscle relaxants', 'Physical therapy', 'Neck braces', 'Corticosteroids'],
    "Paralysis (brain hemorrhage)": ['Blood thinners', 'Clot-dissolving medications', 'Anticonvulsants', 'Physical therapy', 'Occupational therapy'],
    "Jaundice": ['IV fluids', 'Blood transfusions', 'Liver transplant', 'Medications for itching', 'Antiviral medications'],
    "Malaria": ['Antimalarial drugs', 'Antipyretics', 'Antiemetic drugs', 'IV fluids', 'Blood transfusions'],
    "Chicken pox": ['Antiviral drugs', 'Pain relievers', 'IV fluids', 'Blood transfusions', 'Platelet transfusions'],
    "Dengue": ['Antibiotics', 'Antipyretics', 'Analgesics', 'IV fluids', 'Corticosteroids'],
    "Typhoid": ['Vaccination', 'Antiviral drugs', 'IV fluids', 'Blood transfusions', 'Liver transplant'],
    "Hepatitis A": ['Vaccination', 'Antiviral drugs', 'IV fluids', 'Blood transfusions', 'Liver transplant'],
    "Hepatitis B": ['Antiviral drugs', 'IV fluids', 'Blood transfusions', 'Platelet transfusions', 'Liver transplant'],
    "Hepatitis C": ['Antiviral drugs', 'IV fluids', 'Blood transfusions', 'Platelet transfusions', 'Liver transplant'],
    "Hepatitis D": ['Antiviral drugs', 'IV fluids', 'Blood transfusions', 'Platelet transfusions', 'Liver transplant'],
    "Hepatitis E": ['Alcohol cessation', 'Corticosteroids', 'IV fluids', 'Liver transplant', 'Nutritional support'],
    "Alcoholic hepatitis": ['Antibiotics', 'Isoniazid', 'Rifampin', 'Ethambutol', 'Pyrazinamide'],
    "Tuberculosis": ['Antipyretics', 'Decongestants', 'Cough suppressants', 'Antihistamines', 'Pain relievers'],
    "Common Cold": ['Antibiotics', 'Antiviral drugs', 'Antifungal drugs', 'IV fluids', 'Oxygen therapy'],
    "Pneumonia": ['Laxatives', 'Pain relievers', 'Warm baths', 'Cold compresses', 'High-fiber diet'],
    "Dimorphic hemorrhoids (piles)": ['Nitroglycerin', 'Aspirin', 'Beta-blockers', 'Calcium channel blockers', 'Thrombolytic drugs'],
    "Heart attack": ['Compression stockings', 'Exercise', 'Elevating the legs', 'Sclerotherapy', 'Laser treatments'],
    "Varicose veins": ['Levothyroxine', 'Antithyroid medications', 'Beta-blockers', 'Radioactive iodine', 'Thyroid surgery'],
    "Hypothyroidism": ['Antithyroid medications', 'Radioactive iodine', 'Thyroid surgery', 'Beta-blockers', 'Corticosteroids'],
    "Hyperthyroidism": ['Glucose tablets', 'Candy or juice', 'Glucagon injection', 'IV dextrose', 'Diazoxide'],
    "Hypoglycemia": ['Pain relievers', 'Exercise', 'Hot and cold packs', 'Joint protection', 'Physical therapy'],
    "Osteoarthritis": ['NSAIDs', 'Disease-modifying antirheumatic drugs (DMARDs)', 'Biologics', 'Corticosteroids', 'Joint replacement surgery'],
    "Arthritis": ['Vestibular rehabilitation', 'Canalith repositioning', 'Medications for nausea', 'Surgery', 'Home exercises'],
    "Vertigo (Paroxysmal Positional Vertigo)": ['Topical treatments', 'Antibiotics', 'Oral medications', 'Hormonal treatments', 'Isotretinoin'],
    "Acne": ['Antibiotics', 'Pain relievers', 'Antihistamines', 'Corticosteroids', 'Topical treatments'],
    "Urinary tract infection": ['Antibiotics', 'Urinary analgesics', 'Phenazopyridine', 'Antispasmodics', 'Probiotics'],
    "Psoriasis": ['Topical treatments', 'Phototherapy', 'Systemic medications', 'Biologics', 'Coal tar'],
    "Impetigo": ['Topical antibiotics', 'Oral antibiotics', 'Antiseptics', 'Ointments', 'Warm compresses']
}

    medications = medications_dict.get(disease, ['No medications found for this disease'])
    return render_template('medication.html', disease=disease, medications=medications)

@app.route('/workout')
def workout():
    df = pd.read_csv('workout_df.csv')
    workout= df.to_dict(orient='records')
    return render_template('workout.html', workout=workout)


disease_diet_map = {
    "Fungal infection": ['Antifungal Diet', 'Probiotics', 'Garlic', 'Coconut oil', 'Turmeric'],
    "Allergy": ['Elimination Diet', 'Omega-3-rich foods', 'Vitamin C-rich foods', 'Quercetin-rich foods', 'Probiotics'],
    "GERD": ['Low-Acid Diet', 'Fiber-rich foods', 'Ginger', 'Licorice', 'Aloe vera juice'],
    "Chronic cholestasis": ['Low-Fat Diet', 'High-Fiber Diet', 'Lean proteins', 'Whole grains', 'Fresh fruits and vegetables'],
    "Drug Reaction": ['Antihistamine Diet', 'Omega-3-rich foods', 'Vitamin C-rich foods', 'Quercetin-rich foods', 'Probiotics'],
    "Peptic ulcer disease": ['Low-Acid Diet', 'Fiber-rich foods', 'Ginger', 'Licorice', 'Aloe vera juice'],
    "AIDS": ['Balanced Diet', 'Protein-rich foods', 'Fruits and vegetables', 'Whole grains', 'Healthy fats'],
    "Diabetes": ['Low-Glycemic Diet', 'Fiber-rich foods', 'Lean proteins', 'Healthy fats', 'Low-fat dairy'],
    "Gastroenteritis": ['Bland Diet', 'Bananas', 'Rice', 'Applesauce', 'Toast'],
    "Bronchial Asthma": ['Anti-Inflammatory Diet', 'Omega-3-rich foods', 'Fruits and vegetables', 'Whole grains', 'Lean proteins'],
    "Hypertension": ['DASH Diet', 'Low-sodium foods', 'Fruits and vegetables', 'Whole grains', 'Lean proteins'],
    "Migraine": ['Migraine Diet', 'Low-Tyramine Diet', 'Caffeine withdrawal', 'Hydration', 'Magnesium-rich foods'],
    "Cervical spondylosis": ['Arthritis Diet', 'Anti-Inflammatory Diet', 'Omega-3-rich foods', 'Fruits and vegetables', 'Whole grains'],
    "Paralysis (brain hemorrhage)": ['Heart-Healthy Diet', 'Low-sodium foods', 'Fruits and vegetables', 'Whole grains', 'Lean proteins'],
    "Jaundice": ['Liver-Healthy Diet', 'Low-fat Diet', 'Fruits and vegetables', 'Whole grains', 'Lean proteins'],
    "Malaria": ['Malaria Diet', 'Hydration', 'High-Calorie Diet', 'Soft and bland foods', 'Oral rehydration solutions'],
    "Chicken pox": ['Chicken Pox Diet', 'High-Calorie Diet', 'Soft and bland foods', 'Hydration', 'Protein-rich foods'],
    "Dengue": ['Dengue Diet', 'Hydration', 'High-Calorie Diet', 'Soft and bland foods', 'Protein-rich foods'],
    "Typhoid": ['Typhoid Diet', 'High-Calorie Diet', 'Soft and bland foods', 'Hydration', 'Protein-rich foods'],
    "hepatitis A": ['Hepatitis A Diet', 'High-Calorie Diet', 'Soft and bland foods', 'Hydration', 'Protein-rich foods'],
    "Hepatitis B": ['Hepatitis B Diet', 'High-Calorie Diet', 'Soft and bland foods', 'Hydration', 'Protein-rich foods'],
    "Hepatitis C": ['Hepatitis C Diet', 'High-Calorie Diet', 'Soft and bland foods', 'Hydration', 'Protein-rich foods'],
    "Hepatitis D": ['Hepatitis D Diet', 'High-Calorie Diet', 'Soft and bland foods', 'Hydration', 'Protein-rich foods'],
    "Hepatitis E": ['Hepatitis E Diet', 'High-Calorie Diet', 'Soft and bland foods', 'Hydration', 'Protein-rich foods'],
    "Alcoholic hepatitis": ['Liver-Healthy Diet', 'Low-fat Diet', 'Fruits and vegetables', 'Whole grains', 'Lean proteins'],
    "Tuberculosis": ['TB Diet', 'High-Calorie Diet', 'Soft and bland foods', 'Hydration', 'Protein-rich foods'],
    "Common Cold": ['Cold Diet', 'Hydration', 'Warm fluids', 'Rest', 'Honey and lemon tea'],
    "Pneumonia": ['Pneumonia Diet', 'High-Calorie Diet', 'Soft and bland foods', 'Hydration', 'Protein-rich foods'],
    "Dimorphic hemmorhoids(piles)": ['Hemorrhoids Diet', 'High-Fiber Diet', 'Hydration', 'Warm baths', 'Stool softeners'],
    "Heart attack": ['Heart-Healthy Diet', 'Low-sodium foods', 'Fruits and vegetables', 'Whole grains', 'Lean proteins'],
    "Varicose veins": ['Varicose Veins Diet', 'High-Fiber Diet', 'Fruits and vegetables', 'Whole grains', 'Low-sodium foods'],
    "Hypothyroidism": ['Hypothyroidism Diet', 'Iodine-rich foods', 'Selenium-rich foods', 'Fruits and vegetables', 'Whole grains'],
    "Hyperthyroidism": ['Hyperthyroidism Diet', 'Low-Iodine Diet', 'Calcium-rich foods', 'Selenium-rich foods', 'Fruits and vegetables'],
    "Hypoglycemia": ['Hypoglycemia Diet', 'Complex carbohydrates', 'Protein-rich snacks', 'Fiber-rich foods', 'Healthy fats'],
    "Osteoarthristis": ['Arthritis Diet', 'Anti-Inflammatory Diet', 'Omega-3-rich foods', 'Fruits and vegetables', 'Whole grains'],
    "Arthritis": ['Arthritis Diet', 'Anti-Inflammatory Diet', 'Omega-3-rich foods', 'Fruits and vegetables', 'Whole grains'],
    "(vertigo) Paroymsal Positional Vertigo": ['Vertigo Diet', 'Low-Salt Diet', 'Hydration', 'Ginger tea', 'Vitamin D-rich foods'],
    "Acne": ['Acne Diet', 'Low-Glycemic Diet', 'Hydration', 'Fruits and vegetables', 'Probiotics'],
    "Urinary tract infection": ['UTI Diet', 'Hydration', 'Cranberry juice', 'Probiotics', 'Vitamin C-rich foods'],
    "Psoriasis": ['Psoriasis Diet', 'Anti-Inflammatory Diet', 'Omega-3-rich foods', 'Fruits and vegetables', 'Whole grains'],
    "Impetigo": ['Impetigo Diet', 'Antibiotic treatment', 'Fruits and vegetables', 'Hydration', 'Protein-rich foods']
}

@app.route('/dietchart')
def dietchart():
    disease = request.args.get('disease')
    diet_chart = disease_diet_map.get(disease, ['No diet recommendation found.'])
    return render_template('dietchart.html', disease=disease, diet_chart=diet_chart)



if __name__ == '__main__':
    app.run(debug=True)
