<html lang="en" style="transform: none;" class="fontawesome-i2svg-active fontawesome-i2svg-complete"><head>
<meta charset="utf-8">
<title>PMS</title>
<link rel="shortcut icon" href="../static/assets/img/favicon.png" type="image/x-icon">

<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>

<link rel="stylesheet" href="../static/assets/css/bootstrap.min.css">

<link rel="stylesheet" href="../static/assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="../static/assets/plugins/fontawesome/css/all.min.css">

<link rel="stylesheet" href="../static/assets/css/feather.css">

<link rel="stylesheet" href="../static/assets/css/custom.css">
<style id="theia-sticky-sidebar-stylesheet-TSS">.theiaStickySidebar:after {content: ""; display: table; clear: both;}</style><style type="text/css">@font-face { font-family: Roboto; src: url("chrome-extension://mcgbeeipkmelnpldkobichboakdfaeon/css/Roboto-Regular.ttf"); }</style></head>
<body style="transform: none;">

<div class="main-wrapper" style="transform: none;">

<header class="header header-fixed header-one header-space">
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
</li><li class="active">
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




<div class="content" style="transform: none; min-height: 355.906px;">
<div class="container" style="transform: none; padding-top:50px">
<div class="row" style="transform: none;">
<div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">



<div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none;"><div class="profile-sidebar">
<div class="widget-profile pro-widget-content">
<div class="profile-info-widget">
<a href="#" class="booking-doc-img">
<img src="../static/assets/img/{{profile}}" alt="User Image">
</a>
<div class="profile-det-info">
<h3>{{ admin_data.Name }}</h3>
<div class="patient-details">
<h5 class="mb-0">{{ admin_data.Qualification }} &amp; {{ admin_data.Job_Profile }}</h5>
</div>
</div>
</div>
</div>
<div class="dashboard-widget">
<nav class="dashboard-menu">
<ul>
<li class="active">
<a href="/admin-dashboard">
<svg class="svg-inline--fa fa-columns fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="columns" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="" style="width: 16px; height: 16px;"><path fill="currentColor" d="M464 32H48C21.49 32 0 53.49 0 80v352c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V80c0-26.51-21.49-48-48-48zM224 416H64V160h160v256zm224 0H288V160h160v256z"></path></svg><!-- <i class="fas fa-columns"></i> Font Awesome fontawesome.com -->
<span>Dashboard</span>
</a>
</li>








<li>
<a href="/admin-profile-settings">
<svg class="svg-inline--fa fa-user-cog fa-w-20" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user-cog" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg="" style="width: 16px; height: 16px;"><path fill="currentColor" d="M610.5 373.3c2.6-14.1 2.6-28.5 0-42.6l25.8-14.9c3-1.7 4.3-5.2 3.3-8.5-6.7-21.6-18.2-41.2-33.2-57.4-2.3-2.5-6-3.1-9-1.4l-25.8 14.9c-10.9-9.3-23.4-16.5-36.9-21.3v-29.8c0-3.4-2.4-6.4-5.7-7.1-22.3-5-45-4.8-66.2 0-3.3.7-5.7 3.7-5.7 7.1v29.8c-13.5 4.8-26 12-36.9 21.3l-25.8-14.9c-2.9-1.7-6.7-1.1-9 1.4-15 16.2-26.5 35.8-33.2 57.4-1 3.3.4 6.8 3.3 8.5l25.8 14.9c-2.6 14.1-2.6 28.5 0 42.6l-25.8 14.9c-3 1.7-4.3 5.2-3.3 8.5 6.7 21.6 18.2 41.1 33.2 57.4 2.3 2.5 6 3.1 9 1.4l25.8-14.9c10.9 9.3 23.4 16.5 36.9 21.3v29.8c0 3.4 2.4 6.4 5.7 7.1 22.3 5 45 4.8 66.2 0 3.3-.7 5.7-3.7 5.7-7.1v-29.8c13.5-4.8 26-12 36.9-21.3l25.8 14.9c2.9 1.7 6.7 1.1 9-1.4 15-16.2 26.5-35.8 33.2-57.4 1-3.3-.4-6.8-3.3-8.5l-25.8-14.9zM496 400.5c-26.8 0-48.5-21.8-48.5-48.5s21.8-48.5 48.5-48.5 48.5 21.8 48.5 48.5-21.7 48.5-48.5 48.5zM224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm201.2 226.5c-2.3-1.2-4.6-2.6-6.8-3.9l-7.9 4.6c-6 3.4-12.8 5.3-19.6 5.3-10.9 0-21.4-4.6-28.9-12.6-18.3-19.8-32.3-43.9-40.2-69.6-5.5-17.7 1.9-36.4 17.9-45.7l7.9-4.6c-.1-2.6-.1-5.2 0-7.8l-7.9-4.6c-16-9.2-23.4-28-17.9-45.7.9-2.9 2.2-5.8 3.2-8.7-3.8-.3-7.5-1.2-11.4-1.2h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c10.1 0 19.5-3.2 27.2-8.5-1.2-3.8-2-7.7-2-11.8v-9.2z"></path></svg><!-- <i class="fas fa-user-cog"></i> Font Awesome fontawesome.com -->
<span>Profile Settings</span>
</a>
</li>

<li>
<a href="/admin-change-password">
<svg class="svg-inline--fa fa-lock fa-w-14" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="lock" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="" style="width: 16px; height: 16px;"><path fill="currentColor" d="M400 224h-24v-72C376 68.2 307.8 0 224 0S72 68.2 72 152v72H48c-26.5 0-48 21.5-48 48v192c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V272c0-26.5-21.5-48-48-48zm-104 0H152v-72c0-39.7 32.3-72 72-72s72 32.3 72 72v72z"></path></svg><!-- <i class="fas fa-lock"></i> Font Awesome fontawesome.com -->
<span>Change Password</span>
</a>
</li>

<li>
<a href="/admin-register">
<svg class="svg-inline--fa fa-user-injured fa-w-14" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user-injured" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="" style="width: 16px; height: 16px;"><path fill="currentColor" d="M277.37 11.98C261.08 4.47 243.11 0 224 0c-53.69 0-99.5 33.13-118.51 80h81.19l90.69-68.02zM342.51 80c-7.9-19.47-20.67-36.2-36.49-49.52L239.99 80h102.52zM224 256c70.69 0 128-57.31 128-128 0-5.48-.95-10.7-1.61-16H97.61c-.67 5.3-1.61 10.52-1.61 16 0 70.69 57.31 128 128 128zM80 299.7V512h128.26l-98.45-221.52A132.835 132.835 0 0 0 80 299.7zM0 464c0 26.51 21.49 48 48 48V320.24C18.88 344.89 0 381.26 0 422.4V464zm256-48h-55.38l42.67 96H256c26.47 0 48-21.53 48-48s-21.53-48-48-48zm57.6-128h-16.71c-22.24 10.18-46.88 16-72.89 16s-50.65-5.82-72.89-16h-7.37l42.67 96H256c44.11 0 80 35.89 80 80 0 18.08-6.26 34.59-16.41 48H400c26.51 0 48-21.49 48-48v-41.6c0-74.23-60.17-134.4-134.4-134.4z"></path></svg><!-- <i class="fas fa-user-injured"></i> Font Awesome fontawesome.com -->
<span>Register Admin</span>
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
</div><div class="resize-sensor"></div></div></div>
<div class="col-md-7 col-lg-8 col-xl-9">
<div class=" container-fluid">

<div class="page-header">
<div class="row">
<div class="col-sm-12">
<h3 class="page-title">Welcome Admin!</h3>
<ul class="breadcrumb">

</ul>
</div>
</div>
</div>

<div class="row">
<div class="col-xl-3 col-sm-6 col-12">
<div class="card">
<div class="card-body">
<div class="dash-widget-header">
<span class="dash-widget-icon text-primary border-primary">
<i class="fe fe-users"></i>
</span>
<div class="dash-count">
<h3>{{total_doctor}}</h3>
</div>
</div>
<div class="dash-widget-info">
<h6 class="text-muted">Doctors</h6>
<div class="progress progress-sm">
<div class="progress-bar bg-primary w-50"></div>
</div>
</div>
</div>
</div>
</div>
<div class="col-xl-3 col-sm-6 col-12">
<div class="card">
<div class="card-body">
<div class="dash-widget-header">
<span class="dash-widget-icon text-success">
<i class="fe fe-credit-card"></i>
</span>
<div class="dash-count">
<h3>{{total_patient}}</h3>
</div>
</div>
<div class="dash-widget-info">
<h6 class="text-muted">Patients</h6>
<div class="progress progress-sm">
<div class="progress-bar bg-success w-50"></div>
</div>
</div>
</div>
</div>
</div>
<div class="col-xl-3 col-sm-6 col-12">
<div class="card">
<div class="card-body">
<div class="dash-widget-header">
<span class="dash-widget-icon text-danger border-danger">
<i class="fe fe-money"></i>
</span>
<div class="dash-count">
<h3>{{total_appointment}}</h3>
</div>
</div>
<div class="dash-widget-info">
<h6 class="text-muted">Appointment</h6>
<div class="progress progress-sm">
<div class="progress-bar bg-danger w-50"></div>
</div>
</div>
</div>
</div>
</div>
<div class="col-xl-3 col-sm-6 col-12">
<div class="card">
<div class="card-body">
<div class="dash-widget-header">
<span class="dash-widget-icon text-warning border-warning">
<i class="fe fe-folder"></i>
</span>
<div class="dash-count">
<h3>₹{{revenue}}</h3>
</div>
</div>
<div class="dash-widget-info">
<h6 class="text-muted">Revenue</h6>
<div class="progress progress-sm">
<div class="progress-bar bg-warning w-50"></div>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="row">
<div class="col-md-6 d-flex">

<div class="card card-table flex-fill">
<div class="card-header">
<h4 class="card-title">Doctors List</h4>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-hover table-center mb-0">
<thead>
<tr>
<th>Doctor Name</th>
<th>Speciality</th>


</tr>
</thead>
<tbody>
  {% for  doctor in doctor_data_list %}
<tr>
<td>
<h2 class="table-avatar">
<a href="{{ url_for('doctor_profile', doctor_id=doctor.Doctor_ID) }}" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="../static/assets/img/doctors/{{doctor.Profile_URL}}" alt="User Image"></a>
<a href="{{ url_for('doctor_profile', doctor_id=doctor.Doctor_ID) }}">Dr. {{doctor.Name}} <span>#{{doctor.Doctor_ID}}</span></a>
</h2>
</td>
<td>{{doctor.Specialization}}</td>

<td>
<i class="fe fe-star text-warning"></i>
<i class="fe fe-star text-warning"></i>
<i class="fe fe-star text-warning"></i>
<i class="fe fe-star text-warning"></i>
<i class="fe fe-star-o text-secondary"></i>
</td>
</tr>
{% endfor %}
</tbody>
</table>
</div>
</div>
</div>

</div>
<div class="col-md-6 d-flex">

<div class="card  card-table flex-fill">
<div class="card-header">
<h4 class="card-title">Patients List</h4>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-hover table-center mb-0">
<thead>
<tr>
<th>Patient Name</th>
<th>Phone</th>


</tr>
</thead>
<tbody>
  {% for  patient in patient_data_list %}
<tr>
<td>
<h2 class="table-avatar">
<a href="/coming-soon" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="../static/assets/img/patients/{{patient.Profile_URL}}" alt="User Image"></a>
<a href="/coming-soon">{{patient.Name}} <span>#{{patient.Patient_ID}}</span></a>
</h2>
</td>
<td>{{patient.Phone}}</td>
</tr>
{% endfor %}
</tbody>
</table>
</div>
</div>
</div>

</div>
</div>
<div class="row">
<div class="col-md-12">

<div class="card card-table">
<div class="card-header">
<h4 class="card-title">Appointment List</h4>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-hover table-center mb-0">
<thead>
<tr>
<th>Doctor Name</th>
<th>Speciality</th>
<th>Patient Name</th>
<th>Apointment Time</th>
<th>Status</th>

</tr>
</thead>
<tbody>
  {% for  appointment in appointment_data_list %}
<tr>
<td>
<h2 class="table-avatar">
<a href="{{ url_for('doctor_profile', doctor_id=appointment.Doctor_ID) }}" class="avatar avatar-sm me-2 "><img class="avatar-img rounded-circle" src="../static/assets/img/doctors/{{appointment.Doctor_Profile_URL}}" alt="User Image"></a>
<a href="{{ url_for('doctor_profile', doctor_id=appointment.Doctor_ID) }}">Dr. {{appointment.Doctor_Name}} <span>#{{appointment.Doctor_ID}}</span></a>
</h2>
</td>
<td>{{appointment.Specialization}}</td>
<td>
<h2 class="table-avatar">
<a href="/coming-soon" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="../static/assets/img/patients/{{appointment.Patient_Profile_URL}}" alt="User Image"></a>
<a href="/coming-soon">{{appointment.Patient_Name}} <span>#{{appointment.Patient_ID}}</span></a>
</h2>
</td>
<td>{{appointment.Appointment_Date}} <span class="d-block text-info">{{appointment.Appointment_Time}}</span></td>
<td>
<div class="status-toggle">
<input type="checkbox" id="status_1" class="check" checked="">
<label for="status_1" class="checktoggle">checkbox</label>
</div>
</td>

</tr>
{% endfor %}
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
<p><i class="feather-mail"></i> pms.write@gmail.com</p>
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

<script src="../static/assets/js/bootstrap.bundle.min.js"></script>

<script src="../assets/plugins/theia-sticky-sidebar/ResizeSensor.js"></script>
<script src="../static/assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js"></script>

<script src="../static/assets/js/circle-progress.min.js"></script>

<script src="../static/assets/js/script.js"></script><div class="sidebar-overlay"></div><div class="sidebar-overlay"></div>
<div></div></body></html>