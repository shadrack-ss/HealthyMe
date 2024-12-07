<?php
// database connection
require_once '../components/db_connection.php';

// Assuming a session is already started if needed
session_start();

// Check if the doctor is logged in (example)
if (!isset($_SESSION['doctor_id'])) {
    header('Location: /index.php');
    exit();
}

// Get doctor data from the database
$doctor_id = $_SESSION['doctor_id'];


// Fetch doctor data from the database
$stmt = $pdo->prepare("SELECT name,qualification, specialization, profile_pic FROM doctors WHERE doctor_id = :doctor_id");
$stmt->execute(['doctor_id' => $doctor_id]);
$doctor_data = $stmt->fetch(PDO::FETCH_ASSOC);

// Handle missing doctor data
if (!$doctor_data) {
    // Redirect or show an error if the doctor does not exist
    header('Location: /error-page.php');
    exit();
}

// Default profile picture if none exists
$profile = !empty($doctor_data['profile_pic']) ? $doctor_data['profile_pic'] : 'default-profile.png';

// Safely handle missing Qualification and Specialization
$qualification = !empty($doctor_data['qualification']) ? htmlspecialchars($doctor_data['qualification']) : 'Not Available';
$specialization = !empty($doctor_data['specialization']) ? htmlspecialchars($doctor_data['specialization']) : 'Not Available';

// Fetch statistics for patients (total, today, and upcoming medication refills)
$total_patient = getTotalPatients($pdo);
$total_today_patients = getTodayRefills($pdo);
$total_upcoming_patients = getUpcomingRefills($pdo);

// Fetch lists for patient refills
$today_patients = getTodayRefillDetails($pdo);
$upcoming_patients = getUpcomingRefillDetails($pdo);

// Helper functions
function getTotalPatients($pdo) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM patients");
    $stmt->execute();
    return $stmt->fetchColumn();
}

function getTodayRefills($pdo) {
    $today = date('Y-m-d');
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM patients WHERE DATE(medication_refill_date) = :today");
    $stmt->execute(['today' => $today]);
    return $stmt->fetchColumn();
}

function getUpcomingRefills($pdo) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM patients WHERE medication_refill_date > NOW()");
    $stmt->execute();
    return $stmt->fetchColumn();
}

function getTodayRefillDetails($pdo) {
    $today = date('Y-m-d');
    $stmt = $pdo->prepare("SELECT * FROM patients WHERE DATE(medication_refill_date) = :today");
    $stmt->execute(['today' => $today]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getUpcomingRefillDetails($pdo) {
    $stmt = $pdo->prepare("
        SELECT 
            patients.name, 
            patients.medication_refill_date, 
            prescriptions.medication_name, 
            patients.insurance_details,
            patients.patient_id
        FROM 
            patients
        LEFT JOIN 
            prescriptions ON patients.patient_id = prescriptions.patient_id
        WHERE 
            patients.medication_refill_date > NOW()
        ORDER BY 
            patients.medication_refill_date ASC
    ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fetch missed refills
$missed_refills = $missed_refills ?? [];
$missed_refills = getMissedRefills($pdo);
$missed_count = count($missed_refills);
function getMissedRefills($pdo) {
    try {
        $stmt = $pdo->prepare("
            SELECT 
                name, medication_refill_date, patient_id 
            FROM 
                patients 
            WHERE 
                medication_pickup_status IS NULL 
                AND medication_refill_date < CURDATE()
            ORDER BY 
                medication_refill_date ASC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return [];
    }
}

/*echo "<pre>";
print_r($missed_refills);
echo "</pre>";
exit();
*/


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['patient_id'])) {
    $patient_id = $_POST['patient_id'];

    $stmt = $pdo->prepare("
        UPDATE patients 
        SET medication_pickup_status = 1 
        WHERE patient_id = :patient_id
    ");
    $stmt->execute(['patient_id' => $patient_id]);

    header('Location: ./doctor-dashboard.php');
    exit();
}


?>

<!DOCTYPE html>
<html lang="en" style="transform: none;" class="fontawesome-i2svg-active fontawesome-i2svg-complete">
<head>
<meta charset="utf-8">
<title>HealthyMe</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<style>
.modal {
    z-index: 1050 !important;  /* Bootstrap's default z-index for modal */
}

.modal-backdrop {
    z-index: 1040 !important;  /* Bootstrap's default z-index for the backdrop */
}
</style>

<link rel="stylesheet" href="../static/assets/css/bootstrap.min.css">

<link rel="stylesheet" href="../static/assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="../static/assets/plugins/fontawesome/css/all.min.css">

<link rel="stylesheet" href="../static/assets/css/feather.css">

<link rel="stylesheet" href="../static/assets/css/custom.css">
<style id="theia-sticky-sidebar-stylesheet-TSS">.theiaStickySidebar:after {content: ""; display: table; clear: both;}</style><style type="text/css">@font-face { font-family: Roboto; src: url("chrome-extension://mcgbeeipkmelnpldkobichboakdfaeon/css/Roboto-Regular.ttf"); 
}</style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<script>
document.addEventListener('DOMContentLoaded', function () {
    const missedRefills = <?php echo json_encode($missed_refills); ?>;
    const missedCount = missedRefills.length;

    // Only show the alert if there are missed refills
    if (missedCount > 0) {
        Swal.fire({
            title: 'Missed Medication Refills',
            text: `There ${missedCount === 1 ? 'is' : 'are'} ${missedCount} missed medication refill${missedCount > 1 ? 's' : ''}. Do you want to see the details?`,
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Yes, Show Details',
            cancelButtonText: 'Close',
            preConfirm: () => {
                // Scroll to the section with the missed refills table
                const missedRefillsTableSection = document.getElementById('missed-refills');
                if (missedRefillsTableSection) {
                    missedRefillsTableSection.scrollIntoView({ behavior:"instant"});
                }
            }
        });
    }
});

</script>



</head>

<body style="transform: none;">
<div class="main-wrapper" style="transform: none;">
<?php 
    require_once'../components/header.php';
?>
    

    <div class="content">
        <div class="container" style="padding-top:50px">
            <div class="row">

                <!-- Sidebar -->
                <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
                    <div class="profile-sidebar">
                        <div class="widget-profile pro-widget-content">
                            <div class="profile-info-widget">
                                <a href="#" class="booking-doc-img">
                                    <img src="../uploads/profile_pics/<?php echo $profile; ?>" alt="profile">
                                </a>
                                <div class="profile-det-info">
                                    <h3>Dr. <?php echo htmlspecialchars($doctor_data['name']); ?></h3>
                                    <div class="patient-details">
                                        <h5 class="mb-0"><?php echo htmlspecialchars('Specialization: '); ?>  <?php echo htmlspecialchars($doctor_data['specialization']); ?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dashboard-widget">
                            <nav class="dashboard-menu">
                                <ul>
                                    <li class="active">
                                        <a href="./doctor-dashboard.php">
                                            <i class="fas fa-columns"></i> <span>Dashboard</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="./doctor-profile-settings.php">
                                            <i class="fas fa-user-cog"></i> <span>Profile Settings</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/doctor-change-password">
                                            <i class="fas fa-lock"></i> <span>Change Password</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/logout">
                                            <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="col-md-7 col-lg-8 col-xl-9">

                <div class="row">
                    <div class="col-md-12">
                        <?php if (!empty($missed_refills)): ?>
                            <div class="alert alert-danger">
                                <strong>Missed Refills:</strong>
                                You have <?php echo htmlspecialchars($missed_count); ?> patient(s) who missed their medication refills.
                                <a href="#missed-refills" class="alert-link">View Details</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card dash-card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-4">
                                            <div class="dash-widget dct-border-rht">
                                                <div class="circle-bar circle-bar1">
                                                    <div class="circle-graph1" data-percent="75">
                                                        <canvas width="400" height="400"></canvas>
                                                        <img src="../static/assets/img/icon-01.png" class="img-fluid" alt="patient">
                                                    </div>
                                                </div>
                                                <div class="dash-widget-info">
                                                    <h6>Total Patient</h6>
                                                    <h3><?php echo $total_patient; ?></h3>
                                                    <p class="text-muted">Till Today</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-4">
                                            <div class="dash-widget dct-border-rht">
                                                <div class="circle-bar circle-bar2">
                                                    <div class="circle-graph2" data-percent="65">
                                                        <canvas width="400" height="400"></canvas>
                                                        <img src="../static/assets/img/icon-02.png" class="img-fluid" alt="Patient">
                                                    </div>
                                                </div>
                                                <div class="dash-widget-info">
                                                    <h6>Today Refills</h6>
                                                    <h3><?php echo $total_today_patients; ?></h3>
                                                    <p class="text-muted"><?php echo date('Y-m-d'); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-4">
                                            <div class="dash-widget">
                                                <div class="circle-bar circle-bar3">
                                                    <div class="circle-graph3" data-percent="50">
                                                        <canvas width="400" height="400"></canvas>
                                                        <img src="../static/assets/img/icon-03.png" class="img-fluid" alt="Patient">
                                                    </div>
                                                </div>
                                                <div class="dash-widget-info">
                                                    <h6>Upcoming Refills</h6>
                                                    <h3><?php echo $total_upcoming_patients; ?></h3>
                                                    <p class="text-muted">Upcoming</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Patient Refills Tab -->
                    <div class="row">
                        <div class="col-md-12" style="display: flex; justify-content: space-between; align-items: center;">
                            <h4 class="mb-4" style="margin: 0;">Patient Medication Refills</h4>
                            <a class="add-patient" style="
                                 color: white;
                                padding: 8px 16px;
                                background-color: #20c0f3;
                                border-radius: 8px;
                                margin-bottom: 20px;
                                text-decoration: none;
                                transition: background-color 0.3s ease, transform 0.2s ease;
                                font-size: 14px;"
                                onmouseover="this.style.backgroundColor='#0a9fd9'; this.style.transform='scale(1.05)';" 
                                onmouseout="this.style.backgroundColor='#20c0f3'; this.style.transform='scale(1)';" href="./add-patient.php">
                                Add Patient
                            </a>
                        </div>
                    </div>
                    <div class="appointment-tab">
                        <ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="#upcoming-refills" data-bs-toggle="tab" aria-selected="true" role="tab">Upcoming</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#today-refills" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">Today</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <!-- Upcoming Refills -->
                            <div class="tab-pane active show" id="upcoming-refills" role="tabpanel">
                                <div class="card card-table mb-0">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-center mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Patient Name</th>
                                                        <th>Refill Date</th>
                                                        <th>Medication</th>
                                                        <th>Insurance</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($upcoming_patients as $patient) { ?>
                                                        <tr>
                                                            <td><?php echo htmlspecialchars($patient['name']); ?></td>
                                                            <td><?php echo htmlspecialchars($patient['medication_refill_date']); ?></td>
                                                            <td><?php echo htmlspecialchars($patient['medication_name'] ?? 'No Medication'); ?></td>
                                                            <td><?php echo htmlspecialchars($patient['insurance_details']); ?></td>
                                                            <td><a href="./patient-details.php?id=<?php echo $patient['patient_id']; ?>" class="btn btn-sm btn-primary">View Details</a></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Today Refills -->
                            <div class="tab-pane" id="today-refills" role="tabpanel">
                            <div class="card card-table mb-0">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Patient Name</th>
                                                    <th>Refill Date</th>
                                                    <th>Medication</th>
                                                    <th>Insurance</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($today_patients as $patient) { ?>
                                                    <tr>
                                                        <td><?php echo htmlspecialchars($patient['name']); ?></td>
                                                        <td><?php echo htmlspecialchars($patient['medication_refill_date']); ?></td>
                                                        <td><?php echo htmlspecialchars($patient['medication_name']); ?></td>
                                                        <td><?php echo htmlspecialchars($patient['insurance_details']); ?></td>
                                                        <td><a href="/patient-details?id=<?php echo $patient['id']; ?>" class="btn btn-sm btn-primary">View Details</a></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            </div>

                        <!-- Missed Refills Section -->
                        <div class="row" id="missed-refills" style="margin-top: 50px;">
                            <div class="col-md-12">
                                <h4 class="mb-4">Missed Medication Refills</h4>
                                <div class="card card-table">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-center mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Patient Name</th>
                                                        <th>Refill Date</th>
                                                        <th colspan="2">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($missed_refills)): ?>
                                                        <?php foreach ($missed_refills as $patient): ?>
                                                            <tr>
                                                                <td><?php echo htmlspecialchars($patient['name']); ?></td>
                                                                <td><?php echo htmlspecialchars($patient['medication_refill_date']); ?></td>
                                                                <td>
                                                                    <a href="./patient-details.php?id=<?php echo htmlspecialchars($patient['patient_id']); ?>" class="btn btn-sm btn-primary">View Details</a>
                                                                </td>
                                                                <td>
                                                                    <form action="" method="POST">
                                                                        <input type="hidden" name="patient_id" value="<?php echo htmlspecialchars($patient['patient_id']); ?>">
                                                                        <button type="submit" class="btn btn-sm btn-success">Mark as Picked Up</button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <tr>
                                                            <td colspan="4" class="text-center">No missed medication refills.</td>
                                                        </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                            </div>
                            </div>
                        </div>
                    </div>

                </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include_once '../components/footer.php'; ?>
    
<script src="../static/assets/js/jquery-3.6.4.min.js"></script>


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
