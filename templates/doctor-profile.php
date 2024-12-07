<html lang="en" class="fontawesome-i2svg-active fontawesome-i2svg-complete"><head>
<meta charset="utf-8">
<title>PMS</title>
<link rel="shortcut icon" href="../static/assets/img/favicon.png" type="image/x-icon">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

<!-- -------------------- social icons ----------------------- -->
 </head><body>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>


<link rel="stylesheet" href="../static/assets/css/bootstrap.min.css">

<link rel="stylesheet" href="../static/assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="../static/assets/plugins/fontawesome/css/all.min.css">

<link rel="stylesheet" href="../static/assets/css/feather.css">

<link rel="stylesheet" href="../static/assets/plugins/daterangepicker/daterangepicker.css">

<link rel="stylesheet" href="../static/assets/css/custom.css">



<div class="main-wrapper">

<header class="header header-fixed header-one">
<div class="container">
<nav class="navbar navbar-expand-lg header-nav">
<div class="navbar-header">
<a id="mobile_btn" href="javascript:void(0);">
<span class="bar-icon">
<span></span>
<span></span>
<span></span>
</span>
</a>
<a href="/index" class="navbar-brand logo">
<img src="../static/assets/img/logo.png" class="img-fluid" alt="Logo">
</a>
</div>
<div class="main-menu-wrapper">
<div class="menu-header">
<a href="/index" class="menu-logo">
<img src="../static/assets/img/logo.png" class="img-fluid" alt="Logo">
</a>
<a id="menu_close" class="menu-close" href="javascript:void(0);">
<svg class="svg-inline--fa fa-times fa-w-11" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512" data-fa-i2svg=""><path fill="currentColor" d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path></svg><!-- <i class="fas fa-times"></i> Font Awesome fontawesome.com -->
</a>
</div>
<ul class="main-nav">
<li >
<a href="/index">Home </a>
</li>

<li >
<a href="/patient-dashboard">Patients </a>
</li>

<li >
<a href="/doctor-dashboard">Doctors </a>
</li><li >
<a href="/admin-dashboard">Admin </a>
</li>

<li >
<a href="/contact-us">Contact Us </a>
</li>

<ul class="nav header-navbar-rht" style="padding-top: 20px;">

<li class="nav-item dropdown has-arrow logged-item">
<a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown" aria-expanded="false">
<span class="user-img">
<img class="rounded-circle" src="../static/assets/img/{{profile}}" width="31" alt="profile">
</span>
</a>
<div class="dropdown-menu dropdown-menu-end">
<div class="user-header">
<div class="avatar avatar-sm">
<img src="../static/assets/img/{{profile}}" alt="User Image" class="avatar-img rounded-circle">
</div>
<div class="user-text">
<h6>{{name}}</h6>
<p class="text-muted mb-0">{{user}}</p>
</div>
</div>
<a class="dropdown-item" href="{{dashboard}}">Dashboard</a>
<a class="dropdown-item" href="{{url}}">Profile Settings</a>
<a class="dropdown-item" href="/logout">Logout</a>
</div>
</li>
</ul>
</ul>
</div>
</nav>
</div>
</header>


<div class="content phone-new">
<div class="container">

<div class="card">
<div class="card-body">
<div class="doctor-widget">
<div class="doc-info-left">
<div class="doctor-img">
<img src="../static/assets/img/doctors/{{ doctor.Profile_URL }}" class="img-fluid" alt="User Image">
</div>
<div class="doc-info-cont">
<h4 class="doc-name">Dr. {{ doctor.Name }}</h4>
<p class="doc-speciality">{{ doctor.Qualification }} &amp; {{ doctor.Specialization }}</p>
<!-- <p class="doc-department"><img src="assets/img/specialities/specialities-05.png" class="img-fluid" alt="Speciality">Dentist</p> -->

<div class="clinic-details">
<p class="doc-location"><svg class="svg-inline--fa fa-map-marker-alt fa-w-12 active" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="map-marker-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg="" style="width: 16px; height: 16px;"><path fill="currentColor" d="M172.268 501.67C26.97 291.031 0 269.413 0 192 0 85.961 85.961 0 192 0s192 85.961 192 192c0 77.413-26.97 99.031-172.268 309.67-9.535 13.774-29.93 13.773-39.464 0zM192 272c44.183 0 80-35.817 80-80s-35.817-80-80-80-80 35.817-80 80 35.817 80 80 80z"></path></svg><!-- <i class="fas fa-map-marker-alt"></i> Font Awesome fontawesome.com --> {{ doctor.Clinic_Address }}, {{ doctor.State }} - <a href="javascript:void(0); ">Get Directions</a></p>

</div>

</div>
</div>
<div class="doc-info-right">


<div class="clinic-booking">
<a class="proceed-btn" href="{{ url_for('book_appointment', doctor_id=doctor.Doctor_ID) }}">Book Appointment</a>
</div>
</div>
</div>
</div>
</div>


<div class="card">
<div class="card-body pt-0">

<nav class="user-tabs mb-4">
<ul class="nav nav-tabs nav-tabs-bottom nav-justified" role="tablist">
<li class="nav-item" role="presentation">
<a class="nav-link active" href="#doc_overview" data-bs-toggle="tab" aria-selected="true" role="tab">Overview</a>
</li>
<li class="nav-item" role="presentation">
<a class="nav-link" href="#doc_locations" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">Locations</a>
</li>

<li class="nav-item" role="presentation">
<a class="nav-link" href="#doc_business_hours" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">Business Hours</a>
</li>
</ul>
</nav>


<div class="tab-content pt-0">

<div role="tabpanel" id="doc_overview" class="tab-pane fade active show">
<div class="row">
<div class="col-md-12 col-lg-9">

<div class="widget about-widget">
<h4 class="widget-title">About Me</h4>
<p>{{ doctor.About_Clinic }}</p>
</div>


<!-- <div class="widget education-widget">
<h4 class="widget-title">Education</h4>
<div class="experience-box">
<ul class="experience-list">
<li>
<div class="experience-user">
<div class="before-circle"></div>
</div>
<div class="experience-content">
<div class="timeline-content">
<a href="#/" class="name">American Dental Medical University</a>
<div>BDS</div>
<span class="time">1998 - 2003</span>
</div>
</div>
</li>
<li>
<div class="experience-user">
<div class="before-circle"></div>
</div>
<div class="experience-content">
<div class="timeline-content">
<a href="#/" class="name">American Dental Medical University</a>
<div>MDS</div>
<span class="time">2003 - 2005</span>
</div>
</div>
</li>
</ul>
</div>
</div> -->


<!-- <div class="widget experience-widget">
<h4 class="widget-title">Work &amp; Experience</h4>
<div class="experience-box">
<ul class="experience-list">
<li>
<div class="experience-user">
<div class="before-circle"></div>
</div>
<div class="experience-content">
<div class="timeline-content">
<a href="#/" class="name">Glowing Smiles Family Dental Clinic</a>
<span class="time">2010 - Present (5 years)</span>
</div>
</div>
</li>
<li>
<div class="experience-user">
<div class="before-circle"></div>
</div>
<div class="experience-content">
<div class="timeline-content">
<a href="#/" class="name">Comfort Care Dental Clinic</a>
<span class="time">2007 - 2010 (3 years)</span>
</div>
</div>
</li>
<li>
<div class="experience-user">
<div class="before-circle"></div>
</div>
<div class="experience-content">
<div class="timeline-content">
<a href="#/" class="name">Dream Smile Dental Practice</a>
<span class="time">2005 - 2007 (2 years)</span>
</div>
</div>
</li>
</ul>
</div>
</div> -->










</div>
</div>
</div>


<div role="tabpanel" id="doc_locations" class="tab-pane fade">

<div class="location-list">
<div class="row">

<div class="col-md-6">
<div class="clinic-content">
<h4 class="clinic-name"><a href="#">{{ doctor.Clinic_Name }}</a></h4>
<p class="doc-speciality">+91 {{ doctor.Phone }}, {{ doctor.Email }}</p>

<div class="clinic-details mb-0">
<h5 class="clinic-direction"> <svg class="svg-inline--fa fa-map-marker-alt fa-w-12" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="map-marker-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg="" style="width: 16px; height: 16px;"><path fill="currentColor" d="M172.268 501.67C26.97 291.031 0 269.413 0 192 0 85.961 85.961 0 192 0s192 85.961 192 192c0 77.413-26.97 99.031-172.268 309.67-9.535 13.774-29.93 13.773-39.464 0zM192 272c44.183 0 80-35.817 80-80s-35.817-80-80-80-80 35.817-80 80 35.817 80 80 80z"></path></svg><!-- <i class="fas fa-map-marker-alt"></i> Font Awesome fontawesome.com --> {{ doctor.Clinic_Address }}, {{ doctor.Address_Line1 }}, {{ doctor.City }}, {{ doctor.State }} <br></h5>

</div>
</div>
</div>


<div class="col-md-4">
<div class="clinic-timing">
<div>
<p class="timings-days">
<span> Mon - Sat </span>
</p>
<p class="timings-times">
<span>10:00 AM - 2:00 PM</span>
<span>4:00 PM - 9:00 PM</span>
</p>
</div>

</div>
</div>

<div class="col-md-2">
<div class="consult-price">
₹{{ doctor_fee }}
</div>
</div>
</div>
</div>




</div>





<div role="tabpanel" id="doc_business_hours" class="tab-pane fade">
<div class="row">
<div class="col-md-6 offset-md-3">

<div class="widget business-widget">
<div class="widget-content">
<div class="listing-hours">
<div class="listing-day current">
<div class="day">Today <span>{{today_date}}</div>

<div class="time-items">
<span class="open-status"><span class="badge bg-success-light">Open Now</span></span>
<span class="time">07:00 AM - 09:00 PM</span>
</div>
</div>
<div class="listing-day">
<div class="day">Monday</div>
<div class="time-items">
<span class="time">07:00 AM - 09:00 PM</span>
</div>
</div>
<div class="listing-day">
<div class="day">Tuesday</div>
<div class="time-items">
<span class="time">07:00 AM - 09:00 PM</span>
</div>
</div>
<div class="listing-day">
<div class="day">Wednesday</div>
<div class="time-items">
<span class="time">07:00 AM - 09:00 PM</span>
</div>
</div>
<div class="listing-day">
<div class="day">Thursday</div>
<div class="time-items">
<span class="time">07:00 AM - 09:00 PM</span>
</div>
</div>
<div class="listing-day">
<div class="day">Friday</div>
<div class="time-items">
<span class="time">07:00 AM - 09:00 PM</span>
</div>
</div>
<div class="listing-day">
<div class="day">Saturday</div>
<div class="time-items">
<span class="time">07:00 AM - 09:00 PM</span>
</div>
</div>
<div class="listing-day closed">
<div class="day">Sunday</div>
<div class="time-items">
<span class="time"><span class="badge bg-danger-light">Closed</span></span>
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




<footer class="footer footer-one">
<div class="footer-top">
<div class="container">
<div class="row">
<div class="col-lg-3 col-md-4">
<div class="footer-widget footer-about">
<a href="/"><div class="footer-logo">
<img src="../static/assets/img/logo.png" alt="logo">
</div></a>
<div class="footer-about-content">
<p>Experience hassle-free healthcare access and connect with trusted healthcare professionals effortlessly.</p>
</div>
</div>
</div>
<div class="col-lg-2 col-md-4">
<div class="footer-widget footer-menu">
<h2 class="footer-title">For Patients</h2>
<ul>
<li><a href="/">Search for Doctors</a></li>
<li><a href="/login">Login</a></li>
<li><a href="/register">Register</a></li>
</ul>
</div>
</div>
<div class="col-lg-2 col-md-4">
<div class="footer-widget footer-menu">
<h2 class="footer-title">For Doctors</h2>
<ul>
<li><a href="/login">Appointments</a></li>
<li><a href="/coming-soon">Chat</a></li>
<li><a href="/login">Login</a></li>
</ul>
</div>
</div>
<div class="col-lg-2 col-md-5">
<div class="footer-widget footer-contact">
<h2 class="footer-title">Contact Us</h2>
<div class="footer-contact-info">
<div class="footer-address">
<p><i class="feather-map-pin"></i> Najafgarh, Delhi</p>
</div>
<div class="footer-address">
<p><i class="feather-phone-call"></i> +91 902-780-0200</p>
</div>
<div class="footer-address mb-0">
<p><i class="feather-mail"></i> pms@gmail.com</p>
</div>
</div>
</div>
</div>

<div class="col-lg-3 col-md-7">
<div class="footer-widget">
<h2 class="footer-title">Join Our Newsletter</h2>
<div class="subscribe-form">
<form action="/subscribe" method="POST">
<input type="email" name="email" class="form-control" placeholder="Enter Email">
<button type="submit" class="btn">Submit</button>
</form>
</div>
<div class="social-icon">
<ul>
<li>
<a href="https://www.facebook.com/yadavnikhilrao" target="_blank"><svg class="svg-inline--fa fa-facebook fa-w-16" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="facebook" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"></path></svg><!-- <i class="fab fa-facebook"></i> Font Awesome fontawesome.com --> </a>
</li>
<li>
<a href="https://instagram.com/yadavnikhilrao" target="_blank"><svg class="svg-inline--fa fa-instagram fa-w-14" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="instagram" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"></path></svg><!-- <i class="fab fa-instagram"></i> Font Awesome fontawesome.com --></a>
</li>
<li>
<a href="https://twitter.com/yadavnikhilrao" target="_blank"><svg class="svg-inline--fa fa-twitter fa-w-16" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="twitter" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"></path></svg><!-- <i class="fab fa-twitter"></i> Font Awesome fontawesome.com --> </a>
</li>
<li>
<a href="https://linkedin.com/in/yadavnikhilrao" target="_blank"><svg class="svg-inline--fa fa-linkedin-in fa-w-14" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="linkedin-in" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z"></path></svg><!-- <i class="fab fa-linkedin-in"></i> Font Awesome fontawesome.com --></a>
</li>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="footer-bottom">
<div class="container">

<div class="copyright">
<div class="row">
<div class="col-md-6 col-lg-6">
<div class="copyright-text">
<p class="mb-0"> Copyright © 2023 <a href="https://pranik.pythonanywhere.com/" target="_blank">Pranik Medical Services.</a> All Rights Reserved</p>
</div>
</div>
<div class="col-md-6 col-lg-6">

<div class="copyright-menu">
<ul class="policy-menu">
<li><a href="/terms-condition">Terms and Conditions</a></li>
</ul>
</div>

</div>
</div>
</div>

</div>
</div>
</footer>

</div>


<script src="../static/assets/js/jquery-3.6.4.min.js"></script>

<script src="../static/assets/js/slick.js"></script>

<script src="../static/assets/js/bootstrap.bundle.min.js"></script>

<script src="../static/assets/js/moment.min.js"></script>
<script src="../static/assets/plugins/daterangepicker/daterangepicker.js"></script>

<script src="../static/assets/js/script.js"></script><div class="sidebar-overlay"></div><div class="sidebar-overlay"></div><div class="sidebar-overlay"></div>

<div class="sidebar-overlay"></div><div class="sidebar-overlay"></div><div class="sidebar-overlay"></div><div class="sidebar-overlay"></div><div class="sidebar-overlay"></div><div class="sidebar-overlay"></div><div class="sidebar-overlay"></div><div class="sidebar-overlay"></div>

<div></div><quillbot-extension-portal></quillbot-extension-portal><quillbot-extension-root></quillbot-extension-root><div class="sidebar-overlay"></div></body></html>