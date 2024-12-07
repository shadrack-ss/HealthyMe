<?php
require_once'../components/db_connection.php';
// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the form data
  $appointment_date = $_POST['appointment_date']; // Appointment date
  $appointment_time = $_POST['appointment_time']; // Appointment time
  $doctor_id = $_POST['doctor_id']; // Doctor ID
  $insurance = $_POST['insurance']; // Insurance status
  $reason = $_POST['reason']; // Reason for appointment
  $symptoms = isset($_POST['symptoms']) ? $_POST['symptoms'] : ''; // Optional symptoms

  // Validate required fields
  if (empty($appointment_date) || empty($appointment_time) || empty($reason)) {
      echo "Please fill in all required fields.";
      exit;
  }

  // Prepare the SQL query to insert the appointment using PDO
  $sql = "INSERT INTO appointments (appointment_date, appointment_time, doctor_id, insurance, reason, symptoms) 
          VALUES (:appointment_date, :appointment_time, :doctor_id, :insurance, :reason, :symptoms)";

  // Prepare and bind the statement using PDO
  $stmt = $pdo->prepare($sql);
  
  // Bind the parameters to the prepared statement
  $stmt->bindParam(':appointment_date', $appointment_date, PDO::PARAM_STR);
  $stmt->bindParam(':appointment_time', $appointment_time, PDO::PARAM_STR);
  $stmt->bindParam(':doctor_id', $doctor_id, PDO::PARAM_INT);
  $stmt->bindParam(':insurance', $insurance, PDO::PARAM_STR);
  $stmt->bindParam(':reason', $reason, PDO::PARAM_STR);
  $stmt->bindParam(':symptoms', $symptoms, PDO::PARAM_STR);

  // Execute the query
  if ($stmt->execute()) {
      echo "Appointment successfully booked!";
  } else {
      echo "Error: Could not book appointment.";
  }
}
?>
?>
<!DOCTYPE html>
<html lang="en" style="transform: none;" class="fontawesome-i2svg-active fontawesome-i2svg-complete">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
    <title>PMS</title>
    <link rel="shortcut icon" href="../static/assets/img/favicon.png" type="image/x-icon">
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
<body style="transform: none;">
<div class="main-wrapper" style="transform: none;">
    <?php require_once '../components/header.php'; ?>
    <section class="error-section">
        <div class="content" style="min-height: 382.328px;">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="booking-doc-info">
                                    <a href="{{ url_for('doctor_profile', doctor_id=doctor_data.Doctor_ID) }}" class="booking-doc-img">
                                        <img src="../static/assets/img/doctors/{{ doctor_data.Profile_URL }}" alt="User Image">
                                    </a>
                                    <div class="booking-info">
                                        <h4><a href="{{ url_for('doctor_profile', doctor_id=doctor_data.Doctor_ID) }}">Dr. {{ doctor_data.Name }}</a></h4>
                                        <p class="text-muted mb-0">
                                            <svg class="svg-inline--fa fa-map-marker-alt fa-w-12" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="map-marker-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg="" style="width: 16px; height: 16px;">
                                                <path fill="currentColor" d="M172.268 501.67C26.97 291.031 0 269.413 0 192 0 85.961 85.961 0 192 0s192 85.961 192 192c0 77.413-26.97 99.031-172.268 309.67-9.535 13.774-29.93 13.773-39.464 0zM192 272c44.183 0 80-35.817 80-80s-35.817-80-80-80-80 35.817-80 80 35.817 80 80 80z"></path>
                                            </svg> {{ doctor_data.Clinic_Address }}, {{ doctor_data.State }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Appointment Form Starts Here -->
                        <form action="book_appointment.php" method="POST">
                            <div class="row">
                                <div class="search-input search-calendar-line">
                                    <i class="feather-calendar"></i>
                                    <div class="form-group mb-0">
                                        <input type="text" class="form-control datetimepicker" name="appointment_date" placeholder="Select Date" required>
                                    </div>
                                </div>
                                <div class="search-input search-calendar-line">
                                    <div class="form-group mb-0">
                                        <p type="text">{{ date_error }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Time Slot Selection -->
                            <div class="card booking-schedule schedule-widget">
                                <div class="schedule-cont">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="time-slot">
                                                <ul class="clearfix">
                                                    <li><a class="timing" href="#" onclick="selectTimeSlot(this)"><span>8:00</span> <span>AM</span></a></li>
                                                    <li><a class="timing" href="#" onclick="selectTimeSlot(this)"><span>8:30</span> <span>AM</span></a></li>
                                                    <li><a class="timing" href="#" onclick="selectTimeSlot(this)"><span>9:00</span> <span>AM</span></a></li>
                                                    <li><a class="timing" href="#" onclick="selectTimeSlot(this)"><span>9:30</span> <span>AM</span></a></li>
                                                    <li><a class="timing" href="#" onclick="selectTimeSlot(this)"><span>10:00</span> <span>AM</span></a></li>
                                                    <li><a class="timing" href="#" onclick="selectTimeSlot(this)"><span>10:30</span> <span>AM</span></a></li>
                                                    <li><a class="timing" href="#" onclick="selectTimeSlot(this)"><span>11:00</span> <span>AM</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Hidden Fields for Selected Time and Doctor -->
                            <div class="form-group">
                                <input type="hidden" name="appointment_time" id="appointment_time" value="">
                                <input type="hidden" name="doctor_id" value="{{ doctor_data.Doctor_ID }}">
                            </div>

                            <script>
                                function selectTimeSlot(element) {
                                    // Remove the "selected" class from all time slots
                                    var timeSlots = document.querySelectorAll('.timing');
                                    timeSlots.forEach(function(slot) {
                                        slot.classList.remove('selected');
                                    });

                                    // Add the "selected" class to the clicked time slot
                                    element.classList.add('selected');

                                    // Get the value of the selected appointment time
                                    var appointmentTime = element.innerText.trim();

                                    // Set the value in the hidden input field
                                    document.getElementById('appointment_time').value = appointmentTime;
                                }
                            </script>

                            <!-- Insurance Option -->
                            <div class="form-group">
                                <label class="form-group-title">Do you have insurance?</label>
                                <label class="custom_radio me-4">
                                    <input type="radio" name="insurance" value="Yes">
                                    <span class="checkmark"></span> Yes
                                </label>
                                <label class="custom_radio">
                                    <input type="radio" name="insurance" value="No" checked>
                                    <span class="checkmark"></span> No
                                </label>
                            </div>

                            <!-- Reason for Visit -->
                            <div class="form-group">
                                <label class="form-group-title">Reason</label>
                                <textarea class="form-control" name="reason" placeholder="Enter Your Reason" required></textarea>
                                <p class="characters-text" style="text-align: right;">400 Characters</p>
                            </div>

                            <!-- Optional Symptoms -->
                            <div class="form-group">
                                <label class="form-group-title">Symptoms <span>(Optional)</span></label>
                                <input type="text" class="form-control" name="symptoms" placeholder="Skin Allergy">
                            </div>

                            <!-- Submit Button -->
                            <div class="submit-section proceed-btn text-end">
                                <button type="submit" class="btn btn-primary prime-btn justify-content-center align-items-center">
                                    Book Appointment <i class="feather-arrow-right-circle"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php require_once '../components/footer.php'; ?>
</div>

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
<script src="../static/assets/js/script.js"></script>

</body>
</html>
