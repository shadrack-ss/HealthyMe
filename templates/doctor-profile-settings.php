<?php
  // Database connection
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

// Safely handle missing Qualification and Specialization
$qualification = !empty($doctor_data['qualification']) ? htmlspecialchars($doctor_data['qualification']) : 'Not Available';
$specialization = !empty($doctor_data['Specialization']) ? htmlspecialchars($doctor_data['specialization']) : 'Not Available';


// Safely handle other fields
$name = !empty($doctor_data['name']) ? htmlspecialchars($doctor_data['name']) : 'Not Available';
$phone = !empty($doctor_data['phone']) ? htmlspecialchars($doctor_data['phone']) : 'Not Available';
$health_center_name = !empty($doctor_data['health_center_name']) ? htmlspecialchars($doctor_data['health_center_name']) : 'Not Available';
$health_center_address = !empty($doctor_data['health_center_address']) ? htmlspecialchars($doctor_data['health_center_address']) : 'Not Available';
$address_line1 = !empty($doctor_data['address_line1']) ? htmlspecialchars($doctor_data['address_line1']) : 'Not Available';
$address_line2 = !empty($doctor_data['address_line2']) ? htmlspecialchars($doctor_data['address_line2']) : 'Not Available';
$city = !empty($doctor_data['city']) ? htmlspecialchars($doctor_data['city']) : 'Not Available';
$country = !empty($doctor_data['country']) ? htmlspecialchars($doctor_data['country']) : 'Not Available';
$about_health_center = !empty($doctor_data['about_health_center']) ? htmlspecialchars($doctor_data['about_health_center']) : 'Not Available';



// Handle form submission to update profile
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $qualification = $_POST['qualification'];
    $specialization = $_POST['specialization'];
    $health_center_name = $_POST['health_center_name'];
    $health_center_address = $_POST['health_center_address'];
    $address_line1 = $_POST['address_line1'];
    $address_line2 = $_POST['address_line2'];
    $city = $_POST['city'];
    $county= $_POST['county'];
    $about_health_center = $_POST['about_health_center'];

    // Handle profile picture update
    $profilePicPath = NULL; // Default to NULL if no profile picture is uploaded
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = "../uploads/profile_pics/"; // Directory to save profile pictures
        $fileName = time() . "_" . basename($_FILES['photo']['name']); // Unique file name
        $targetFilePath = $uploadDir . $fileName;
    
        // Ensure the directory exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true); // Create directory with proper permissions
        }
    
        // Check file type
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif']; // Allowed file types
        if (in_array(strtolower($fileType), $allowedTypes)) {
            // Move file to the target directory
            if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFilePath)) {
                $profilePicPath = $fileName; // Save the file name to use in the database
    
                // Update profile picture in the database
                $stmt = $pdo->prepare("UPDATE doctors SET Profile_Pic = :profile_pic WHERE doctor_id = :doctor_id");
                $stmt->execute([
                    'profile_pic' => $profilePicPath,
                    'doctor_id' => $doctor_id
                ]);
            } else {
                $_SESSION['error'] = "Error uploading the profile picture.";
                header("Location: ./doctor-profile-setting.php"); // Redirect to the appropriate page
                exit();
            }
        } else {
            $_SESSION['error'] = "Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.";
            header("Location: ./doctor-profile-setting.ph");
            exit();
        }
    }

    // Update doctor information in the database
    $stmt = $pdo->prepare("UPDATE doctors SET Name = :name, Phone = :phone, Qualification = :qualification, 
                           Specialization = :specialization, Health_Center_Name = :health_center_name, 
                           Health_Center_Address = :health_center_address, Address_Line1 = :address_line1, 
                           Address_Line2 = :address_line2, City = :city, country = :country,
                           About_Health_Center = :about_health_center WHERE doctor_id = :doctor_id");

$stmt->execute([
  'name' => $name, 
  'phone' => $phone, 
  'qualification' => $qualification, 
  'specialization' => $specialization, 
  'health_center_name' => $health_center_name, 
  'health_center_address' => $health_center_address, 
  'address_line1' => $address_line1, 
  'address_line2' => $address_line2, 
  'city' => $city, 
  'country' => $country, 
  'about_health_center' => $about_health_center, 
  'doctor_id' => $doctor_id
]);

    // Redirect back to profile settings page after update
    header('Location: doctor-profile-settings.php');
    exit();
}
?>
<html lang="en" style="transform: none;" class="fontawesome-i2svg-active fontawesome-i2svg-complete">
<head>
<meta charset="utf-8">
<title>HealthyMe</title>
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
</head>

<body style="transform: none;">
<div class="main-wrapper" style="transform: none;">

<?php
  require_once'../components/header.php';
?>

<div class="content" style="transform: none; min-height: 385.906px;">
<div class="container" style="transform: none; padding-top:50px">
<div class="row" style="transform: none;">
<div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">
<div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none;"><div class="profile-sidebar">
<div class="widget-profile pro-widget-content">
<div class="profile-info-widget">
<a href="#" class="booking-doc-img">
<img src="../uploads/profile_pics/<?php echo $profile; ?>" alt="profile">
</a>
<div class="profile-det-info">
<h3>Dr. <?php echo $doctor_data['name'] ?></h3>
<div class="patient-details">
<h5 class="mb-0"><?php echo 'Specialization';
?>  <?php echo $doctor_data['specialization'];
?></h5>
</div>
</div>
</div>
</div>


<div class="dashboard-widget">
<nav class="dashboard-menu">
<ul>
<li>
  <a href="./doctor-dashboard.php">
    <svg class="svg-inline--fa fa-columns fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="columns" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="" style="width: 16px; height: 16px;"><path fill="currentColor" d="M464 32H48C21.49 32 0 53.49 0 80v352c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V80c0-26.51-21.49-48-48-48zM224 416H64V160h160v256zm224 0H288V160h160v256z"></path></svg><!-- <i class="fas fa-columns"></i> Font Awesome fontawesome.com -->
    <span>Dashboard</span>
  </a>
</li>

<li class="active">
<a href="./doctor-profile-settings.php">
<svg class="svg-inline--fa fa-user-cog fa-w-20" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user-cog" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg="" style="width: 16px; height: 16px;"><path fill="currentColor" d="M610.5 373.3c2.6-14.1 2.6-28.5 0-42.6l25.8-14.9c3-1.7 4.3-5.2 3.3-8.5-6.7-21.6-18.2-41.2-33.2-57.4-2.3-2.5-6-3.1-9-1.4l-25.8 14.9c-10.9-9.3-23.4-16.5-36.9-21.3v-29.8c0-3.4-2.4-6.4-5.7-7.1-22.3-5-45-4.8-66.2 0-3.3.7-5.7 3.7-5.7 7.1v29.8c-13.5 4.8-26 12-36.9 21.3l-25.8-14.9c-2.9-1.7-6.7-1.1-9 1.4-15 16.2-26.5 35.8-33.2 57.4-1 3.3.4 6.8 3.3 8.5l25.8 14.9c-2.6 14.1-2.6 28.5 0 42.6l-25.8 14.9c-3 1.7-4.3 5.2-3.3 8.5 6.7 21.6 18.2 41.1 33.2 57.4 2.3 2.5 6 3.1 9 1.4l25.8-14.9c10.9 9.3 23.4 16.5 36.9 21.3v29.8c0 3.4 2.4 6.4 5.7 7.1 22.3 5 45 4.8 66.2 0 3.3-.7 5.7-3.7 5.7-7.1v-29.8c13.5-4.8 26-12 36.9-21.3l25.8 14.9c2.9 1.7 6.7 1.1 9-1.4 15-16.2 26.5-35.8 33.2-57.4 1-3.3-.4-6.8-3.3-8.5l-25.8-14.9zM496 400.5c-26.8 0-48.5-21.8-48.5-48.5s21.8-48.5 48.5-48.5 48.5 21.8 48.5 48.5-21.7 48.5-48.5 48.5zM224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm201.2 226.5c-2.3-1.2-4.6-2.6-6.8-3.9l-7.9 4.6c-6 3.4-12.8 5.3-19.6 5.3-10.9 0-21.4-4.6-28.9-12.6-18.3-19.8-32.3-43.9-40.2-69.6-5.5-17.7 1.9-36.4 17.9-45.7l7.9-4.6c-.1-2.6-.1-5.2 0-7.8l-7.9-4.6c-16-9.2-23.4-28-17.9-45.7.9-2.9 2.2-5.8 3.2-8.7-3.8-.3-7.5-1.2-11.4-1.2h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c10.1 0 19.5-3.2 27.2-8.5-1.2-3.8-2-7.7-2-11.8v-9.2z"></path></svg><!-- <i class="fas fa-user-cog"></i> Font Awesome fontawesome.com -->
<span>Profile Settings</span>
</a>
</li>

<li>
<a href="/doctor-change-password">
<svg class="svg-inline--fa fa-lock fa-w-14" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="lock" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="" style="width: 16px; height: 16px;"><path fill="currentColor" d="M400 224h-24v-72C376 68.2 307.8 0 224 0S72 68.2 72 152v72H48c-26.5 0-48 21.5-48 48v192c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V272c0-26.5-21.5-48-48-48zm-104 0H152v-72c0-39.7 32.3-72 72-72s72 32.3 72 72v72z"></path></svg><!-- <i class="fas fa-lock"></i> Font Awesome fontawesome.com -->
<span>Change Password</span>
</a>
</li>
<li>
<a href="/logout">
<svg class="svg-inline--fa fa-sign-out-alt fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="sign-out-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="" style="width: 16px; height: 16px;"><path fill="currentColor" d="M497 273L329 441c-15 15-41 4.5-41-17v-96H152c-13.3 0-24-10.7-24-24v-96c0-13.3 10.7-24 24-24h136V88c0-21.4 25.9-32 41-17l168 168c9.3 9.4 9.3 24.6 0 34zM192 436v-40c0-6.6-5.4-12-12-12H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h84c6.6 0 12-5.4 12-12V76c0-6.6-5.4-12-12-12H96c-53 0-96 43-96 96v192c0 53 43 96 96 96h84c6.6 0 12-5.4 12-12z"></path></svg><!-- <i class="fas fa-sign-out-alt"></i> Font Awesome fontawesome.com -->
<span>Logout</span>
</a>
</li>
</ul>
</nav>
</div>
</div>

<form method="POST" action="" enctype="multipart/form-data">

<div class="resize-sensor" style="position: absolute; inset: 0px; overflow: hidden; z-index: -1; visibility: hidden;">
<div class="resize-sensor-expand" style="position: absolute; left: 0; top: 0; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden;">
<div style="position: absolute; left: 0px; top: 0px; transition: all 0s ease 0s; width: 295px; height: 937px;">
</div>
</div>
<div class="resize-sensor-shrink" style="position: absolute; left: 0; top: 0; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden;">
  <div style="position: absolute; left: 0; top: 0; transition: 0s; width: 200%; height: 200%">

  </div></div>
</div>
</div>
</div>


<div class="col-md-7 col-lg-8 col-xl-9">
<div class="card">
<div class="card-body">
<h4 class="card-title">Basic Information</h4>
<div class="row form-row">
<div class="col-md-12">
<div class="form-group">
<div class="change-avatar">
<div class="profile-img">
<img id="preview-img" alt="Profile Update" src="../uploads/profile_pics/<?php echo $profile; ?>">
</div>

<div class="upload-img">
  <div class="change-photo-btn">
    <span>
      <svg class="svg-inline--fa fa-upload fa-w-16 fa-xs" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="upload" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="" style="width: 16px; height: 16px;">
        <path fill="currentColor" d="M296 384h-80c-13.3 0-24-10.7-24-24V192h-87.7c-17.8 0-26.7-21.5-14.1-34.1L242.3 5.7c7.5-7.5 19.8-7.5 27.3 0l152.2 152.2c12.6 12.6 3.7 34.1-14.1 34.1H320v168c0 13.3-10.7 24-24 24zm216-8v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h136v8c0 30.9 25.1 56 56 56h80c30.9 0 56-25.1 56-56v-8h136c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z"></path>
      </svg><!-- <i class="fa fa-upload"></i> Font Awesome fontawesome.com -->
      Upload Photo
    </span>
    <input type="file" id="photo" name="photo" accept="image/*" class="upload" onchange="previewImage(event)">
  </div>
  <small class="form-text text-muted">Allowed JPG or PNG. Max size of 2MB</small>
</div>
</div>
</div>
</div>
<div class="col-md-6">
  <div class="form-group">
    <label>Doctor ID <span class="text-danger">*</span></label>
    <input type="text" class="form-control" value="<?php echo htmlspecialchars($doctor_data['doctor_id']); ?>" readonly>
  </div>
</div>
<div class="col-md-6">
  <div class="form-group">
    <label>Email <span class="text-danger">*</span></label>
    <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($doctor_data['email']); ?>" readonly>
  </div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Name <span class="text-danger">*</span></label>
<input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($doctor_data['name']); ?>">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Phone Number</label>
<input type="text"  id="phone" name="phone" class="form-control" value="<?php echo htmlspecialchars($doctor_data['phone']); ?>">
</div>
</div>
<div class="col-md-6">
<div class="form-group mb-0">
<label>Qualification</label>
<input type="text" id="qualification" name="qualification" class="form-control" value="<?php echo htmlspecialchars($doctor_data['qualification']); ?>">
</div>
</div>
<div class="col-md-6">
<div class="form-group mb-0">
<label>Specialization</label>
<input type="text" id="specialization" name="specialization" class="form-control" value="<?php echo htmlspecialchars($doctor_data['specialization']); ?>">
</div>
</div>
</div>
</div>
</div>

<!-- Health Center Info -->
<div class="card">
    <div class="card-body">
      <h4 class="card-title">Health Center Info</h4>
      <div class="row form-row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Health Center Name</label>
            <input type="text" id="health_center_name" name="health_center_name" class="form-control" value="<?php echo htmlspecialchars($doctor_data['health_center_name']); ?>">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Health Center Address</label>
            <input type="text" id="health_center_address" name="health_center_address" class="form-control" value="<?php echo htmlspecialchars($doctor_data['health_center_address']); ?>">
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- About Health Center -->
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">About Health Center</h4>
      <div class="form-group mb-0">
        <label>Services</label>
        <textarea class="form-control" id="about_health_center" name="about_health_center" rows="5"><?php echo htmlspecialchars($doctor_data['about_health_center']); ?></textarea>
      </div>
    </div>
  </div>

  <!-- Contact Details -->
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Contact Details</h4>
      <div class="row form-row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Address Line 1</label>
            <input type="text" id="address_line1" name="address_line1" class="form-control" value="<?php echo htmlspecialchars($doctor_data['address_line1']); ?>">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Address Line 2</label>
            <input type="text" id="address_line2" name="address_line2" class="form-control" value="<?php echo htmlspecialchars($doctor_data['address_line2']); ?>">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label>City</label>
            <input type="text" id="city" name="city" class="form-control" value="<?php echo htmlspecialchars($doctor_data['city']); ?>">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Country</label>
            <input type="text" id="country" name="country" class="form-control" value="<?php echo htmlspecialchars($doctor_data['country']); ?>">
          </div>
        </div>

<div class="card">
<div class="card-body">
<h4 class="card-title">Registrations</h4>
<div class="registrations-info">
<div class="row form-row reg-cont">
<div class="col-12 col-md-5">
<div class="form-group">
<label>Registration Number</label>
<input type="text" id="registration_number" name="registration_number" class="form-control" value="<?php echo htmlspecialchars($doctor_data['registration_number']); ?>">
</div>
</div>
<div class="col-12 col-md-5">
<div class="form-group">
<label>Year</label>
<input type="text" id="year" name="year" class="form-control" value="<?php echo htmlspecialchars($doctor_data['year']); ?>">
</div>
</div>
</div>
</div>
</div>
</div>
<div class="submit-section submit-btn-bottom">

<button type="submit" class="btn btn-primary prime-btn" value="Update">Save Changes</button>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
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

</body></html>