<?php
require_once '../components/db_connection.php';
session_start();

try {
    // Create PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

// Initialize error message
$error_message = $_SESSION['error'] ?? null;
unset($_SESSION['error']); // Clear the error message

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $name = trim($_POST['name']);
    $gender = $_POST['gender'];
    $qualification = trim($_POST['qualification']);
    $specialization = trim($_POST['specialization']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $health_center_name = trim($_POST['health_center_name']);
    $health_center_address = trim($_POST['health_center_address']);
    $about_health_center = trim($_POST['about_health_center']);
    $registration_number = trim($_POST['registration_number']);
    $year = trim($_POST['year']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Handle image upload
    $image_name = null; // Default to null if no image is uploaded
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = '../uploads/profile_pics/';
        $file_tmp = $_FILES['profile_pic']['tmp_name'];
        $file_name = basename($_FILES['profile_pic']['name']);
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        // Validate file type
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($file_ext, $allowed_types)) {
            $_SESSION['error'] = "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.";
            header("Location: ./doctor-register.php");
            exit;
        }

        // Generate a unique name for the image
        $image_name = uniqid('profile_', true) . '.' . $file_ext;

        // Ensure the upload directory exists
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // Move the uploaded file to the target directory
        $upload_path = $upload_dir . $image_name;
        if (!move_uploaded_file($file_tmp, $upload_path)) {
            $_SESSION['error'] = "Failed to upload image.";
            header("Location: ./doctor-register.php");
            exit;
        }
    }

    // Check if the email already exists
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM doctors WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    if ($stmt->fetchColumn() > 0) {
        $_SESSION['error'] = "Email is already registered.";
        header("Location: ./doctor-register.php");
        exit;
    }

    // Insert doctor details into the database
    try {
        $stmt = $pdo->prepare("
        INSERT INTO doctors 
        (name, gender, qualification, specialization, phone, email, health_center_name, health_center_address, about_health_center, registration_number, year, password, profile_pic) 
        VALUES 
        (:name, :gender, :qualification, :specialization, :phone, :email, :health_center_name, :health_center_address, :about_health_center, :registration_number, :year, :password, :profile_pic)
    ");
    
    // Bind parameters to avoid SQL injection
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':gender', $gender);
    $stmt->bindParam(':qualification', $qualification);
    $stmt->bindParam(':specialization', $specialization);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':health_center_name', $health_center_name);
    $stmt->bindParam(':health_center_address', $health_center_address); // Fixed parameter
    $stmt->bindParam(':about_health_center', $about_health_center);
    $stmt->bindParam(':registration_number', $registration_number);
    $stmt->bindParam(':year', $year);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':profile_pic', $image_name);

        $stmt->execute();

        // Redirect to a success page or login page
        $_SESSION['success'] = "Doctor registered successfully!";
        header("Location: ./index.php");
        exit;
    } catch (PDOException $e) {
        $_SESSION['error'] = "Error: " . $e->getMessage();
        header("Location: ./doctor-register.php");
        exit;
    }
}
?>
<html lang="en" class="fontawesome-i2svg-active fontawesome-i2svg-complete"><head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
<title>HealthyMe</title>
<link rel="icon" href="../assets/favicon.png" type="image/x-icon">

<!-- -------------------- social icons ----------------------- -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>

<link rel="stylesheet" href="../static/assets/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<link rel="stylesheet" href="../static/assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="../static/assets/plugins/fontawesome/css/all.min.css">

<link rel="stylesheet" href="../static/assets/css/feather.css">

<link rel="stylesheet" href="../static/assets/css/custom.css">
<style type="text/css">@font-face { font-family: Roboto; src: url("chrome-extension://mcgbeeipkmelnpldkobichboakdfaeon/css/Roboto-Regular.ttf"); }</style></head>
<body class="login-body">

<div class="main-wrapper">




<div class="login-content-info"  style="margin: 0px; padding: 0%;">
<div class="container">

<div class="row justify-content-center">
<div class="col-lg-4 col-md-6">
<div class="account-content">
<div class="login-shapes">
<div class="shape-img-left">
<img src="../static/assets/img/shape-01.png" alt="">
</div>
<div class="shape-img-right">
<img src="../static/assets/img/shape-02.png" alt="">
</div>
</div>
<div class="widget-set">
<div class="account-info doctor-reg">
<div class="widget-content multistep-form">
<fieldset id="first">
<div class="login-back">
  <a href="../index.php"><i class="fa-solid fa-arrow-left-long"></i> Back</a>
</div>
<div class="login-title">
<h3>Welcome! Doctor</h3>
<p class="mb-0"> Please enter your details.</p>
</div>
<form method="POST" action="" enctype="multipart/form-data">
            <!-- Display error message -->
            <?php if ($error_message): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($error_message); ?>
            </div>
        <?php endif; ?>
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
    <div class="form-group">
    <label>Name</label>
    <input type="text" name="name" class="form-control" placeholder="Enter Your Full Name" >
    </div>
    <div class="form-group">
    <label>Upload Profile Picture</label>
    <input class="form-control form-control-lg group_formcontrol form-control-file" id="profile_pic" name="profile_pic" type="file" accept="image/*" required>
    </div>
    <div class="form-group">
    <label>Gender</label>
    <select class="form-select form-control" name="gender">
    <option value="">Select</option>
    <option value="male">Male</option>
    <option value="female">Female</option>
    </select>
    </div>
    <div class="form-group">
    <label>Qualification</label>
    <input type="text" name="qualification" class="form-control" placeholder="Enter Your Qualification" >
    </div>
    <div class="form-group">
    <label>Specialization</label>
    <input type="text" name="specialization" class="form-control" placeholder="Enter Your Specialization" >
    </div>
    <div class="form-group">
    <label>Phone Number</label>
    <input class="form-control form-control-lg group_formcontrol form-control-phone" id="phone" name="phone" type="text" >
    </div>
    <div class="form-group">
    <label>Email</label>
    <input type="text" name="email" class="form-control" placeholder="Enter Your Email" >

    </div>
    <div class="form-group">
    <label>Clinic Name</label>
    <input type="text" name="clinic_name" class="form-control" placeholder="Enter Your Clinic's Name" >
    </div>
    <div class="form-group">
    <label>Clinic Address</label>
    <input type="text" name="health_center_address" class="form-control" placeholder="City/Town" >
    </div>
    <div class="form-group">
    <label>About Health Center (Services)</label>
    <input type="text" name="about_health_center" class="form-control" placeholder=" Your Health Center Services" >
    </div>
    <div class="form-group">
    <label>Registration Number</label>
    <input type="text" name="registration_number" class="form-control" placeholder="Enter Your Registration Number" >
    </div>
    <div class="form-group">
    <label>Registration Year</label>
    <input type="text" name="year" class="form-control" placeholder="Enter Your Registration Year" >
    </div>

    <div class="form-group">
    <label>Password</label>
    <div class="pass-group">
    <input type="password" name="password" class="form-control pass-input-sub" placeholder="*************" >
    <span class="feather-eye toggle-password-sub"></span>
    </div>
    </div>
    <button type="submit" class="btn btn-success btn-block">REGISTER <i class="fas fa-user"></i></button>
</form>
</fieldset>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>




<script src="../static/assets/js/jquery-3.6.4.min.js"></script>

<script src="../static/assets/js/slick.js"></script>

<script src="../static/assets/js/bootstrap.bundle.min.js"></script>

<script src="../static/assets/js/feather.min.js"></script>

<script src="../static/assets/js/script.js"></script><div class="sidebar-overlay"></div><div class="sidebar-overlay"></div><div class="sidebar-overlay"></div><div class="sidebar-overlay"></div><div class="sidebar-overlay"></div><div class="sidebar-overlay"></div><div class="sidebar-overlay"></div><div class="sidebar-overlay"></div><div class="sidebar-overlay"></div><div class="sidebar-overlay"></div><div class="sidebar-overlay"></div><div class="sidebar-overlay"></div><div class="sidebar-overlay"></div><div class="sidebar-overlay"></div><div class="sidebar-overlay"></div><div class="sidebar-overlay"></div><div class="sidebar-overlay"></div>
<div></div></body></html>