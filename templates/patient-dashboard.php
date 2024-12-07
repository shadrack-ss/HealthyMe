<?php
session_start();

// Include DB connection script
require '../components/db_connection.php';

// Check if the user is logged in and is a patient
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Patient') {
    header("Location: ../index.php"); // Redirect to login page
    exit();
}

// Fetch patient data
$user_id = $_SESSION['user_id']; // Get user_id from session

// Fetch patient data based on user_id
$patient_query = $pdo->prepare("SELECT patient_id, user_id, emergency_contact_name, emergency_contact_phone, diabetes_type, 
    diagnosis_date, medical_history, medication_list, allergies, current_blood_sugar_level, recent_hba1c_level, 
    next_appointment_date, medication_refill_date, reminder_preferences, insurance_details, created_at, updated_at
    FROM patients WHERE user_id = :user_id");
$patient_query->bindParam(":user_id", $user_id, PDO::PARAM_INT);
$patient_query->execute();
$patient_data = $patient_query->fetch(PDO::FETCH_ASSOC);

if (!$patient_data) {
    echo "Error: Patient data not found.";
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Healthme</title>
    <link rel="shortcut icon" href="../assets/favicon.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <!-- CSS Files -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../static/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../static/assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../static/assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../static/assets/css/custom.css">
</head>
<body>

<div class="main-wrapper">

    <?php
    require '../components/header.php'; // Include header component
    ?>

    <div class="content">
        <div class="container" style="padding-top:50px">
            <div class="row">
                <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
                    <div class="profile-sidebar">
                        <div class="widget-profile pro-widget-content">
                            <div class="profile-info-widget">
                                <a href="#" class="booking-doc-img">
                                    <img src="../uploads/profile_pics/<?= htmlspecialchars($patient_data['profile_image']) ?>" alt="User Image">
                                </a>
                                <div class="profile-det-info">
                                    <h3><?= htmlspecialchars($patient_data['emergency_contact_name']) ?></h3>
                                    <div class="patient-details">
                                        <h5><i class="fas fa-phone"></i> <?= htmlspecialchars($patient_data['emergency_contact_phone']) ?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-7 col-lg-8 col-xl-9">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Your Details</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Patient ID</th>
                                        <td><?= htmlspecialchars($patient_data['patient_id']) ?></td>
                                    </tr>
                                    <tr>
                                        <th>User ID</th>
                                        <td><?= htmlspecialchars($patient_data['user_id']) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Diabetes Type</th>
                                        <td><?= htmlspecialchars($patient_data['diabetes_type']) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Diagnosis Date</th>
                                        <td><?= htmlspecialchars($patient_data['diagnosis_date']) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Medical History</th>
                                        <td><?= htmlspecialchars($patient_data['medical_history']) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Medication List</th>
                                        <td><?= htmlspecialchars($patient_data['medication_list']) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Allergies</th>
                                        <td><?= htmlspecialchars($patient_data['allergies']) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Current Blood Sugar Level</th>
                                        <td><?= htmlspecialchars($patient_data['current_blood_sugar_level']) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Recent HbA1c Level</th>
                                        <td><?= htmlspecialchars($patient_data['recent_hba1c_level']) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Next Appointment Date</th>
                                        <td><?= htmlspecialchars($patient_data['next_appointment_date']) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Medication Refill Date</th>
                                        <td><?= htmlspecialchars($patient_data['medication_refill_date']) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Reminder Preferences</th>
                                        <td><?= htmlspecialchars($patient_data['reminder_preferences']) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Insurance Details</th>
                                        <td><?= htmlspecialchars($patient_data['insurance_details']) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Created At</th>
                                        <td><?= htmlspecialchars($patient_data['created_at']) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Updated At</th>
                                        <td><?= htmlspecialchars($patient_data['updated_at']) ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php require '../components/footer.php'; // Include footer component ?>
    </div>

    <!-- Scripts -->
    <script src="../static/assets/js/jquery-3.6.4.min.js"></script>
    <script src="../static/assets/js/bootstrap.bundle.min.js"></script>
    <script src="../static/assets/js/script.js"></script>
</body>
</html>
