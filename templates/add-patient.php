<?php
session_start();
// Example: Check if a user is logged in
if (!isset($_SESSION['doctor_id'])) {
  // Redirect to login page if user is not logged in
  header("Location: ../index.php");
  exit();
}

// Include your DB connection script
require_once '../components/db_connection.php';

// Get the logged-in user's ID from the session
$user_id = $_SESSION['doctor_id'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $emergency_contact_name = $_POST['emergency_contact_name'];
    $emergency_contact_phone = $_POST['emergency_contact_phone'];
    $diabetes_type = $_POST['diabetes_type'];
    $diagnosis_date = $_POST['diagnosis_date'];
    $medical_history = $_POST['medical_history'];
    $allergies = $_POST['allergies'];
    $current_blood_sugar_level = $_POST['current_blood_sugar_level'];
    $recent_hba1c_level = $_POST['recent_hba1c_level'];
    $medication_refill_date = $_POST['medication_refill_date'];
    $reminder_preferences = $_POST['reminder_preferences'];
    $insurance_details = $_POST['insurance_details'];

    try {
        // Prepare the SQL query to insert the patient data
        $stmt = $pdo->prepare("INSERT INTO patients 
            (name, phone, email, gender, dob, emergency_contact_name, emergency_contact_phone, diabetes_type, 
            diagnosis_date, medical_history, allergies, current_blood_sugar_level, 
            recent_hba1c_level, medication_refill_date, reminder_preferences, insurance_details, created_at, updated_at) 
            VALUES (:name, :phone, :email, :gender, :dob, :emergency_contact_name, :emergency_contact_phone, :diabetes_type, 
            :diagnosis_date, :medical_history, :allergies, :current_blood_sugar_level, 
            :recent_hba1c_level, :medication_refill_date, :reminder_preferences, :insurance_details, NOW(), NOW())");

        // Bind parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':dob', $dob);
        $stmt->bindParam(':emergency_contact_name', $emergency_contact_name);
        $stmt->bindParam(':emergency_contact_phone', $emergency_contact_phone);
        $stmt->bindParam(':diabetes_type', $diabetes_type);
        $stmt->bindParam(':diagnosis_date', $diagnosis_date);
        $stmt->bindParam(':medical_history', $medical_history); 
        $stmt->bindParam(':allergies', $allergies);
        $stmt->bindParam(':current_blood_sugar_level', $current_blood_sugar_level);
        $stmt->bindParam(':recent_hba1c_level', $recent_hba1c_level);
        $stmt->bindParam(':medication_refill_date', $medication_refill_date);
        $stmt->bindParam(':reminder_preferences', $reminder_preferences);
        $stmt->bindParam(':insurance_details', $insurance_details);

        // Execute the query
        if ($stmt->execute()) {
            $success_message = "Patient added successfully.";
        } else {
            $error_message = "Failed to add patient.";
        }
    } catch (PDOException $e) {
        $error_message = "Error: " . $e->getMessage();
    }
    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Collect prescription details from the form
        $medication_name = $_POST['medication_name'];
        $dosage = $_POST['dosage'];
        $route = $_POST['route'];
        $frequency = $_POST['frequency'];
        $duration = $_POST['Duration'];
    
        try {
            // Get the last inserted patient ID (assuming this happens after adding the patient record)
            $patient_id = $pdo->lastInsertId();
    
            // Example: Assuming doctor_id is fetched from the session
            $doctor_id = $_SESSION['doctor_id'];
    
            // Prepare SQL query to insert the prescription data
            $stmt = $pdo->prepare("INSERT INTO prescriptions 
                (patient_id, doctor_id, prescription_date, medication_name, dosage, frequency, duration) 
                VALUES 
                (:patient_id, :doctor_id, NOW(), :medication_name, :dosage, :frequency, :duration)");
    
            // Bind parameters
            $stmt->bindParam(':patient_id', $patient_id, PDO::PARAM_INT);
            $stmt->bindParam(':doctor_id', $doctor_id, PDO::PARAM_INT);
            $stmt->bindParam(':medication_name', $medication_name, PDO::PARAM_STR);
            $stmt->bindParam(':dosage', $dosage, PDO::PARAM_STR);
            $stmt->bindParam(':frequency', $frequency, PDO::PARAM_STR);
            $stmt->bindParam(':duration', $duration, PDO::PARAM_STR);
    
            // Execute the query
            if ($stmt->execute()) {
                $success_message = "Prescription saved successfully.";
            } else {
                $error_message = "Failed to save prescription.";
            }
        } catch (PDOException $e) {
            $error_message = "Error: " . $e->getMessage();
        }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Patient</title>
    <link rel="stylesheet" href="../static/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../static/assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../static/assets/plugins/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="../static/assets/css/feather.css">

    <link rel="stylesheet" href="../static/assets/css/bootstrap-datetimepicker.min.css">

    <link rel="stylesheet" href="../static/assets/css/owl.carousel.min.css">

    <link rel="stylesheet" href="../static/assets/css/aos.css">

    <link rel="stylesheet" href="../static/assets/css/custom.css">
    <style type="text/css">@font-face { font-family: Roboto; src: url("chrome-extension://mcgbeeipkmelnpldkobichboakdfaeon/css/Roboto-Regular.ttf"); }</style>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        header {
          position: fixed; /* Ensure the header stays at the top */
          top: 0;
          left: 0;
          width: 100%; /* Ensure the header spans the full width */
          z-index: 1000; /* Make sure it sits above the form content */
          background-color: #fff; /* Set a background color if needed */
          box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); /* Optional: Add a shadow for better visibility */
       }

        .form-container {
            max-width: 600px;
            margin: 90px auto;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px 30px;
            margin-bottom: 40px;

        }

        .form-container h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: #343a40;
        }

        .form-container .form-label {
            font-weight: 600;
        }

        .form-container .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .form-container .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .alert {
            margin-top: 80px; /* Adjust this value based on your navbar height */
            z-index: 1000; /* Ensure it appears above other elements */
            position: relative;
        }

        @media (max-width: 768px) {
            .form-container {
                margin: 20px;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
  <?php

  ?>
<div class="container">
    <!-- Success and error messages -->
    <?php if (!empty($success_message)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success_message) ?></div>
    <?php endif; ?>

    <?php if (!empty($error_message)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error_message) ?></div>
    <?php endif; ?>

    <!-- Form Container -->
    
    <!-- Form Container -->
    <div class="form-container">
        <h1>Add Patient</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <select class="form-control" id="gender" name="gender" required>
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" id="dob" name="dob" required>
            </div>
            <div class="mb-3">
                <label for="emergency_contact_name" class="form-label">Emergency Contact Name</label>
                <input type="text" class="form-control" id="emergency_contact_name" name="emergency_contact_name" required>
            </div>
            <div class="mb-3">
                <label for="emergency_contact_phone" class="form-label">Emergency Contact Phone</label>
                <input type="text" class="form-control" id="emergency_contact_phone" name="emergency_contact_phone" required>
            </div>
            <div class="mb-3">
                <label for="diabetes_type" class="form-label">Diabetes Type</label>
                <select class="form-control" id="diabetes_type" name="diabetes_type" required>
                    <option value="">Select Diabetes Type</option>
                    <option value="Type 1">Type 1</option>
                    <option value="Type 2">Type 2</option>
                    <option value="Gestational">Gestational</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="diagnosis_date" class="form-label">Diagnosis Date</label>
                <input type="date" class="form-control" id="diagnosis_date" name="diagnosis_date" required>
            </div>
            <div class="mb-3">
                <label for="medical_history" class="form-label">Medical History</label>
                <textarea class="form-control" id="medical_history" name="medical_history" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="medication_prescrption" class="form-label">Medication and Prescription</label>
                <input type="text" class="form-control" id="medication_name" name="medication_name" placeholder="Enter Medication Name">
                <input type="text" class="form-control" id="dosage" name="dosage" placeholder="Enter Dosage">
                <input type="text" class="form-control" id="route" name="route" placeholder="Enter Route">
                <input type="text" class="form-control" id="frequency" name="frequency" placeholder="Enter frequency">
                <input type="text" class="form-control" id="Duration" name="Duration" placeholder="Enter Duration">
            </div>
            <div class="mb-3">
                <label for="allergies" class="form-label">Allergies</label>
                <textarea class="form-control" id="allergies" name="allergies" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="current_blood_sugar_level" class="form-label">Current Blood Sugar Level</label>
                <input type="number" step="0.01" class="form-control" id="current_blood_sugar_level" name="current_blood_sugar_level" required>
            </div>
            <div class="mb-3">
                <label for="recent_hba1c_level" class="form-label">Recent HbA1c Level</label>
                <input type="number" step="0.01" class="form-control" id="recent_hba1c_level" name="recent_hba1c_level" required>
            </div>
            <div class="mb-3">
                <label for="medication_refill_date" class="form-label">Medication Refill Date</label>
                <input type="date" class="form-control" id="medication_refill_date" name="medication_refill_date">
            </div>
            <div class="mb-3">
                <label for="reminder_preferences" class="form-label">Reminder Preferences</label>
                <select class="form-control" id="reminder_preferences" name="reminder_preferences">
                    <option value="Email">Email</option>
                    <option value="SMS">SMS</option>
                    <option value="Both">Both</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="insurance_details" class="form-label">Insurance Details</label>
                <textarea class="form-control" id="insurance_details" name="insurance_details" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">Add Patient</button>
        </form>
    </div>
</div>
<?php
  require_once'../components/footer.php';
?>
<script src="../static/assets/js/jquery-3.6.4.min.js"></script>

<script src="../static/assets/js/bootstrap.bundle.min.js"></script>

<script src="../static/assets/plugins/theia-sticky-sidebar/ResizeSensor.js"></script>
<script src="../static/assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js"></script>

<script src="../static/assets/js/circle-progress.min.js"></script>

<script src="../static/assets/js/script.js"></script><div class="sidebar-overlay"></div><div class="sidebar-overlay"></div>
</body>
</html>
