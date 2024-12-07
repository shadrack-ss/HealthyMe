<?php
// Database connection
require_once '../components/db_connection.php';

// Check if `id` is passed in the query string
if (!isset($_GET['id'])) {
    header('Location: /error-page.php');
    exit();
}

$patient_id = $_GET['id'];
$success_message = '';
$error_message = '';

// Fetch the patient's current details
$stmt = $pdo->prepare("
    SELECT 
        name, 
        medication_refill_date, 
        insurance_details 
    FROM 
        patients 
    WHERE 
        patient_id = :patient_id
");
$stmt->execute(['patient_id' => $patient_id]);
$patient = $stmt->fetch(PDO::FETCH_ASSOC);

// Handle the case where the patient is not found
if (!$patient) {
    header('Location: /error-page.php');
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $medication_refill_date = $_POST['medication_refill_date'];
    $insurance_details = $_POST['insurance_details'];

    // Validate inputs
    if (empty($name) || empty($medication_refill_date) || empty($insurance_details)) {
        $error_message = 'All fields are required.';
    } else {
        // Update patient details in the database
        $update_stmt = $pdo->prepare("
            UPDATE patients 
            SET 
                name = :name, 
                medication_refill_date = :medication_refill_date, 
                insurance_details = :insurance_details 
            WHERE 
                patient_id = :patient_id
        ");
        $result = $update_stmt->execute([
            'name' => $name,
            'medication_refill_date' => $medication_refill_date,
            'insurance_details' => $insurance_details,
            'patient_id' => $patient_id
        ]);

        if ($result) {
            $success_message = 'Patient details updated successfully.';
            // Refresh patient data after update
            $patient = [
                'name' => $name,
                'medication_refill_date' => $medication_refill_date,
                'insurance_details' => $insurance_details
            ];
        } else {
            $error_message = 'Failed to update patient details.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Patient Details</title>
    <link rel="stylesheet" href="../static/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../static/assets/css/custom.css">
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
<body>
<?php 
    require_once '../components/header.php';
?>
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3>Edit Patient Details</h3>
        </div>
        <div class="card-body">
            <?php if ($success_message): ?>
                <div class="alert alert-success"><?php echo htmlspecialchars($success_message); ?></div>
            <?php endif; ?>
            <?php if ($error_message): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
            <?php endif; ?>
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        id="name" 
                        name="name" 
                        value="<?php echo htmlspecialchars($patient['name']); ?>" 
                        required>
                </div>
                <div class="mb-3">
                    <label for="medication_refill_date" class="form-label">Medication Refill Date</label>
                    <input 
                        type="date" 
                        class="form-control" 
                        id="medication_refill_date" 
                        name="medication_refill_date" 
                        value="<?php echo htmlspecialchars($patient['medication_refill_date']); ?>" 
                        required>
                </div>
                <div class="mb-3">
                    <label for="insurance_details" class="form-label">Insurance Details</label>
                    <textarea 
                        class="form-control" 
                        id="insurance_details" 
                        name="insurance_details" 
                        rows="4" 
                        required><?php echo htmlspecialchars($patient['insurance_details']); ?></textarea>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="./patient-details.php?id=<?php echo $patient_id; ?>" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="../static/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
