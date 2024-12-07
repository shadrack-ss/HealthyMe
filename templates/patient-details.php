<?php
// database connection
require_once '../components/db_connection.php';
// Start session
session_start();

// Check if the doctor is logged in
if (!isset($_SESSION['doctor_id'])) {
    header('Location: /index.php');
    exit();
}

// Get doctor ID from session
$doctor_id = $_SESSION['doctor_id'];

// Fetch doctor data from the database
$stmt = $pdo->prepare("SELECT * FROM doctors WHERE doctor_id = :doctor_id");
$stmt->execute(['doctor_id' => $doctor_id]);
$doctor_data = $stmt->fetch(PDO::FETCH_ASSOC);

// Handle missing doctor data
if (!$doctor_data) {
    header('Location: /error-page.php');
    exit();
}

// Default profile picture if none exists
$profile = !empty($doctor_data['profile_pic']) ? $doctor_data['profile_pic'] : 'default-profile.png';

// Check if the `patient_id` is provided in the query string
if (!isset($_GET['id'])) {
    // Redirect to an error page or show a message if no ID is provided
    header('Location: /error-page.php');
    exit();
}

$patient_id = $_GET['id'];

// Fetch patient data from the database
$stmt = $pdo->prepare("
    SELECT 
        patients.name, 
        patients.medication_refill_date, 
        patients.insurance_details, 
        prescriptions.medication_name, 
        prescriptions.dosage
    FROM 
        patients
    LEFT JOIN 
        prescriptions ON patients.patient_id = prescriptions.patient_id
    WHERE 
        patients.patient_id = :patient_id
");
$stmt->execute(['patient_id' => $patient_id]);
$patient_data = $stmt->fetch(PDO::FETCH_ASSOC);

// Handle case where patient does not exist
if (!$patient_data) {
    header('Location: /error-page.php');
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Details</title>
    <link rel="shortcut icon" href="../assets/favicon.png" type="image/x-icon">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="../static/assets/css/bootstrap.min.css">
<link rel="stylesheet" href="../static/assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="../static/assets/plugins/fontawesome/css/all.min.css">
<link rel="stylesheet" href="../static/assets/css/feather.css">
<link rel="stylesheet" href="../static/assets/css/custom.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
<script>
  function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function () {
        var previewImg = document.getElementById('preview-img');
        previewImg.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>
<style id="theia-sticky-sidebar-stylesheet-TSS">.theiaStickySidebar:after {content: ""; display: table; clear: both;}</style>
<style type="text/css">@font-face { font-family: Roboto; src: url("chrome-extension://mcgbeeipkmelnpldkobichboakdfaeon/css/Roboto-Regular.ttf"); }</style>
<style>
    body {
    margin-top: 90px; 
}

.header {
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1000; 
}
</style>
</head>
<body style="transform: none;">
<div class="main-wrapper" style="transform: none;">
<?php 
        require_once'../components/header.php';
    ?>
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3>Patient Details</h3>
        </div>
        <div class="card-body">
            <h4>Patient Information</h4>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($patient_data['name']); ?></p>
            <p><strong>Medication Refill Date:</strong> <?php echo htmlspecialchars($patient_data['medication_refill_date']); ?></p>
            <p><strong>Insurance Details:</strong> <?php echo htmlspecialchars($patient_data['insurance_details']); ?></p>

            <?php if ($patient_data['medication_name']): ?>
                <h4>Prescription Details</h4>
                <p><strong>Medication Name:</strong> <?php echo htmlspecialchars($patient_data['medication_name']); ?></p>
                <p><strong>Dosage:</strong> <?php echo htmlspecialchars($patient_data['dosage']); ?></p>
            <?php else: ?>
                <p><strong>Prescription:</strong> No prescription available for this patient.</p>
            <?php endif; ?>
        </div>
        
        <div class="card-footer text-end">
        <a href="./edit-patient.php?id=<?php echo $patient_id; ?>" class="btn btn-secondary" style="margin-right: 60%; padding-left:4%; padding-right:4%">Edit Details</a>
            <a href="./doctor-dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
        </div>
    </div>
</div>
<?php include_once '../components/footer.php'; ?>
    
    <script src="../static/assets/js/jquery-3.6.4.min.js"></script>
    
    <script src="../static/assets/js/bootstrap.bundle.min.js"></script>
    
    <script src="../static/assets/js/feather.min.js"></script>
    
    <script src="../static/assets/js/moment.min.js"></script>
    <script src="../static/assets/js/bootstrap-datetimepicker.min.js"></script>
    
    <script src="../static/assets/js/owl.carousel.min.js"></script>
    
    <script src="../static/assets/js/slick.js"></script>
    
    <script src="../static/assets/js/aos.js"></script>
    
    <script src="../static/assets/js/counter.js"></script>
    
    <script src="../static/assets/js/backToTop.js"></script>
    
    <script src="../static/assets/js/script.js"></script><div class="sidebar-overlay"></div><div class="sidebar-overlay"></div><div class="sidebar-overlay"></div><div class="sidebar-overlay"></div><div class="sidebar-overlay"></div><div class="sidebar-overlay"></div><div class="sidebar-overlay"></div><div class="sidebar-overlay"></div><div class="sidebar-overlay"></div><div class="sidebar-overlay"></div><div class="sidebar-overlay"></div><div class="sidebar-overlay"></div><div class="sidebar-overlay"></div><div class="sidebar-overlay"></div><div class="sidebar-overlay"></div><div class="sidebar-overlay"></div><div class="sidebar-overlay"></div><div class="sidebar-overlay"></div><div class="sidebar-overlay"></div><div class="sidebar-overlay"></div><div class="sidebar-overlay"></div><div class="sidebar-overlay"></div><div class="sidebar-overlay"></div><div class="sidebar-overlay"></div>
    <div></div><div id="intellisense-root"></div>
</body>
</html>
