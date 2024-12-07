
<?php


// Start the session
require_once '../components/db_connection.php';
session_start();

// Example: Check if a user is logged in
if (!isset($_SESSION['doctor_id'])) {
    // Redirect to login page if user is not logged in
    header("Location: ../index.php");
    exit();
}
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
$name = !empty($doctor_data['name']) ? htmlspecialchars($doctor_data['name']) : 'Not Available';

?>

<html lang="en" class="fontawesome-i2svg-active fontawesome-i2svg-complete"><head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
<title>HealthyMe</title>
<link rel="shortcut icon" href="../assets/favicon.png" type="image/x-icon">


  <link rel="stylesheet" href="../static/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>


<link rel="stylesheet" href="../static/assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="../static/assets/plugins/fontawesome/css/all.min.css">

<link rel="stylesheet" href="../static/assets/css/feather.css">

<link rel="stylesheet" href="../static/assets/css/bootstrap-datetimepicker.min.css">

<link rel="stylesheet" href="../static/assets/css/owl.carousel.min.css">

<link rel="stylesheet" href="../static/assets/css/aos.css">

<link rel="stylesheet" href="../static/assets/css/custom.css">
<style type="text/css">@font-face { font-family: Roboto; src: url("chrome-extension://mcgbeeipkmelnpldkobichboakdfaeon/css/Roboto-Regular.ttf"); }</style>

</head>
<body data-aos-easing="ease" data-aos-duration="1200" data-aos-delay="0">
<div class="main-wrapper">

<?php
    require_once '../components/header.php';
?>

<section class="banner-section">
<div class="container">
<div class="row align-items-center">
<div class="col-lg-6">
<div class="banner-content aos aos-init aos-animate" data-aos="fade-up">
<h1>Consult <span>Best Doctors</span> in Your Local Area.</h1>
<img src="../static/assets/img/icons/header-icon.svg" class="header-icon" alt="header-icon">
<p>Effortlessly Book Appointments with Top Doctors Nearby.</p>
<a href="#find" id="find" class="btn">Find Doctors</a>
<div class="banner-arrow-img">
<img src="../static/assets/img/down-arrow-img.png" class="img-fluid" alt="">
</div>
</div>
<div class="search-box-one aos aos-init aos-animate" data-aos="fade-up">
<form method="POST" action="/search-doctors">
<div class="search-input search-line">
<i class="feather-search bficon"></i>
<div class="form-group mb-0">
<input type="text" class="form-control" id="name" name="name" placeholder="Search doctors, clinics, hospitals, etc">
</div>
</div>
<div class="search-input search-map-line">
<i class="feather-map-pin"></i>
<div class="form-group mb-0">
<input type="text" class="form-control" id="location" name="location" placeholder="Location" required>
<a class="current-loc-icon current_location" href="javascript:void(0);">
<i class="feather-crosshair"></i>
</a>
</div>
</div>
<div class="search-input search-calendar-line">
<i class="feather-calendar"></i>
<div class="form-group mb-0">
<input type="text" class="form-control" id="doctor_id" name="doctor_id" placeholder="Doctor ID">

</div>
</div>
<div class="form-search-btn">
<button class="btn" type="submit">Search</button>
</div>
</form>
</div>
</div>
<div class="col-lg-6" style="padding-left:100px">
<div class="banner-img aos aos-init aos-animate" data-aos="fade-up">
<img src="../static/assets/img/banner-img.png" class="img-fluid" alt="">
<div class="banner-img1">
<!--<img src="../static/assets/img/banner-img1.png" class="img-fluid" alt="">-->
</div>
<div class="banner-img2">
<!--<img src="../static/assets/img/banner-img2.png" class="img-fluid" alt="">-->
</div>
<div class="banner-img2" style="padding-top:250px">
<!--<img src="../static/assets/img/banner-img3.png" class="img-fluid" alt="">-->
</div>
</div>
</div>
</div>
</div>
</section>

c
<section class="work-section">
<div class="container">
<div class="row">
<div class="col-lg-4 col-md-12 work-img-info aos aos-init aos-animate" data-aos="fade-up">
<div class="work-img">
<img src="../static/assets/img/work-img.png" class="img-fluid" alt="">
</div>
</div>
<div class="col-lg-8 col-md-12 work-details">
<div class="section-header-one aos aos-init aos-animate" data-aos="fade-up">
<h5>How it Works</h5>
<h2 class="section-title">4 easy steps to get your solution</h2>
</div>
<div class="row">
<div class="col-lg-6 col-md-6 aos aos-init aos-animate" data-aos="fade-up">
<div class="work-info">
<div class="work-icon">
<span><img src="../static/assets/img/icons/work-01.svg" alt=""></span>
</div>
<div class="work-content">
<h5>Search Doctor</h5>
<p>Easily find and connect with the right doctor for you with a simple click. Discover a wide range of qualified healthcare professionals at your fingertips.</p>
</div>
</div>
</div>
<div class="col-lg-6 col-md-6 aos aos-init aos-animate" data-aos="fade-up">
<div class="work-info">
<div class="work-icon">
<span><img src="../static/assets/img/icons/work-02.svg" alt=""></span>
</div>
<div class="work-content">
<h5>Check Doctor Profile</h5>
<p>Explore doctor profiles for comprehensive information on qualifications, specialties, and patient feedback to make informed decisions for personalized healthcare.</p>
</div>
</div>
</div>
<div class="col-lg-6 col-md-6 aos aos-init aos-animate" data-aos="fade-up">
<div class="work-info">
<div class="work-icon">
<span><img src="../static/assets/img/icons/work-03.svg" alt=""></span>
</div>
<div class="work-content">
<h5>Schedule Appointment</h5>
<p>Secure your appointment with a click, ensuring a hassle-free and timely consultation with your preferred doctor.</p>
</div>
</div>
</div>
<div class="col-lg-6 col-md-6 aos aos-init aos-animate" data-aos="fade-up">
<div class="work-info">
<div class="work-icon">
<span><img src="../static/assets/img/icons/work-04.svg" alt=""></span>
</div>
<div class="work-content">
<h5>Get Your Solution</h5>
<p>Get personalized solutions for your healthcare needs through expert consultations and tailored treatment plans, ensuring optimal care and well-being.</p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>



<section class="articles-section">
<div class="container">
<div class="row">
<div class="col-md-12 aos aos-init aos-animate" data-aos="fade-up">
<div class="section-header-one text-center">
<h2 class="section-title" id="highlights">Highlights</h2>
</div>
</div>
</div>
<div class="row">
<div class="col-lg-6 col-md-6 d-flex aos aos-init aos-animate" data-aos="fade-up">
<div class="articles-grid w-100">
<div class="articles-info">
<div class="articles-left">
<a href="#highlights">
<div class="articles-img">
<img src="../static/assets/img/blog/blog-11.jpg" class="img-fluid" alt="">
</div>
</a>
</div>
<div class="articles-right">
<div class="articles-content">

<h4 >
<a href="#highlights">PMS – Making your clinic painless visit?</a>
</h4>
<p>Making your clinic visits stress-free, effortless and enhancing your clinic experience with a painless appointment process. </p>

</div>
</div>
</div>
</div>
</div>
<div class="col-lg-6 col-md-6 d-flex aos aos-init aos-animate" data-aos="fade-up">
<div class="articles-grid w-100">
<div class="articles-info">
<div class="articles-left">
<a href="#highlights">
<div class="articles-img">
<img src="../static/assets/img/blog/blog-12.jpg" class="img-fluid" alt="">
</div>
</a>
</div>
<div class="articles-right">
<div class="articles-content">
<h4>
<a href="#highlights">What are the benefits of Online Doctor Booking?</a>
</h4>
<p>Easily book appointments from anywhere, at any time, without the need to visit or call a clinic. </p>

</div>
</div>
</div>
</div>
</div>
<div class="col-lg-6 col-md-6 d-flex aos aos-init aos-animate" data-aos="fade-up">
<div class="articles-grid w-100">
<div class="articles-info">
<div class="articles-left">
<a href="#highlights">
<div class="articles-img">
<img src="../static/assets/img/blog/blog-13.jpg" class="img-fluid" alt="">
</div>
</a>
</div>
<div class="articles-right">
<div class="articles-content">

<h4>
<a href="#highlights">Benefits of consulting with an Online Doctor</a>
</h4>
<p>Online consultations may be more affordable compared to in-person visits, as they eliminate travel expenses and reduce overhead costs. </p>

</div>
</div>
</div>
</div>
</div>
<div class="col-lg-6 col-md-6 d-flex aos aos-init aos-animate" data-aos="fade-up">
<div class="articles-grid w-100">
<div class="articles-info">
<div class="articles-left">
<a href="#highlights">
<div class="articles-img">
<img src="../static/assets/img/blog/blog-14.jpg" class="img-fluid" alt="">
</div>
</a>
</div>
<div class="articles-right">
<div class="articles-content">

<h4>
<a href="#highlights">Benefits of Using an AI Chatbot in Healthcare</a>
</h4>
<p>Improving patient care, AI chatbots analyse patient data to generate personalised recommendations. </p>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>


<section class="app-section">
<div class="container">
<div class="app-bg">
<div class="row align-items-center">
<div class="col-lg-6 col-md-12">
<div class="app-content">
<div class="app-header aos aos-init aos-animate" data-aos="fade-up">


</div>
<div class="google-imgs aos aos-init aos-animate" data-aos="fade-up">
<a href="javascript:void(0);"></a>
<a href="javascript:void(0);"></a>
</div>
</div>
</div>
<div class="col-lg-6 col-md-12 aos aos-init aos-animate" data-aos="fade-up">
<div class="mobile-img">
<img src="../static/assets/img/mobile-img.png" class="img-fluid" alt="img">
</div>
</div>
</div>
</div>
</div>
</section>

<section class="faq-section">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="section-header-one text-center aos aos-init aos-animate" data-aos="fade-up">
<h5>Get Your Answer</h5>
<h2 class="section-title">Frequently Asked Questions</h2>
</div>
</div>
</div>
<div class="row align-items-center">
<div class="col-lg-6 col-md-12 aos aos-init aos-animate" data-aos="fade-up">
<div class="faq-img">
<img src="../static/assets/img/faq-img.png" class="img-fluid" alt="img">
<div class="faq-patients-count">
<div class="faq-smile-img">
<img src="../static/assets/img/icons/smiling-icon.svg" alt="icon">
</div>
<div class="faq-patients-content">
<h4><span class="count-digit counter-loaded">85</span>k+</h4>
<p>Happy Patients</p>
</div>
</div>
</div>
</div>
<div class="col-lg-6 col-md-12">
<div class="faq-info aos aos-init aos-animate" data-aos="fade-up">
<div class="accordion" id="faq-details">

<div class="accordion-item">
<h2 class="accordion-header" id="headingOne">
<a href="javascript:void(0);" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
What services does Pranik Medical Services (PMS) offer? How do I access PMS?
</a>
</h2>
<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faq-details" >
<div class="accordion-body">
<div class="accordion-content">
<p>You can access PMS through our website and PMS offers a wide range of healthcare services, including online appointments, medical advice, prescription management, and health monitoring. </p>
</div>
</div>
</div>
</div>


<div class="accordion-item">
<h2 class="accordion-header" id="headingTwo">
<a href="javascript:void(0);" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
Can I book appointments with Local Clinic doctors through PMS?
</a>
</h2>
<div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faq-details" >
<div class="accordion-body">
<div class="accordion-content">
<p>Yes, you can easily book appointments with doctors of your choice through our platform. We allow online clinic appointment scheduling. Our simple platform lets you find nearby clinics, view their appointment times, and book appointments from anywhere. Booking appointments online saves time.</p>
</div>
</div>
</div>
</div>


<div class="accordion-item">
<h2 class="accordion-header" id="headingThree">
<a href="javascript:void(0);" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
Are there any fees associated with using PMS?</a>
</h2>
<div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faq-details">
<div class="accordion-body">
<div class="accordion-content">
<p>The fees for using PMS are only 2 Rs per appointment, and other services such as AI chatbot for meal and medicine recommendation are completely free of charge.</p>
</div>
</div>
</div>
</div>


<div class="accordion-item">
<h2 class="accordion-header" id="headingFour">
<a href="javascript:void(0);" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
Is my data safe? PMS age limits?</a>
</h2>
<div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faq-details">
<div class="accordion-body">
<div class="accordion-content">
<p>Yes, we prioritize the security of your personal information on PMS and have robust measures in place to protect it. Regarding age restrictions, PMS is open to individuals of all age groups, ensuring access to healthcare services for everyone.</p>
</div>
</div>
</div>
</div>


<div class="accordion-item">
<h2 class="accordion-header" id="headingFive">
<a href="javascript:void(0);" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
What should I do if I experience technical difficulties on PMS?</a>
</h2>
<div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#faq-details">
<div class="accordion-body">
<div class="accordion-content">
<p>If you encounter any technical issues, please reach out to our support team for prompt assistance.</p>
</div>
</div>
</div>
</div>

</div>
</div>
</div>
</div>
</div>
</section>


<?php
    require_once'../components/footer.php';
?>


<!--<div class="mouse-cursor cursor-outer" style="visibility: visible; transform: translate(801px, 436px);"></div>
<div class="mouse-cursor cursor-inner" style="visibility: visible; transform: translate(801px, 436px);"></div>

</div>-->


<!-- <div class="progress-wrap active-progress">
<svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
<path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 31.9792;"></path>
</svg>
</div> -->


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



</body></html>