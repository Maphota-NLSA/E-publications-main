<?php
include '../assets/php/conn.php';
include 'forms_hearder.php';

require "vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // validate inputs
    $country = htmlspecialchars($_POST['country']);
    $authorContact = htmlspecialchars($_POST['authorContact']);
    $bookName = htmlspecialchars($_POST['bookName']);
    $authorFullName = htmlspecialchars($_POST['authorFullName']);
    $authorAddress = htmlspecialchars($_POST['authorAddress']);
    $authorEmail = htmlspecialchars($_POST['authorEmail']);
    $publisherName = htmlspecialchars($_POST['publisherName']);
    $publisherAddress = htmlspecialchars($_POST['publisherAddress']);
    $publisherContact = htmlspecialchars($_POST['publisherContact']);
    $publisherEmail = htmlspecialchars($_POST['publisherEmail']);
    $format = htmlspecialchars($_POST['format']);
    $publicationDate = htmlspecialchars($_POST['publicationDate']);
    $openAccess = htmlspecialchars($_POST['openAccess']);
    $isbnRegistered = htmlspecialchars($_POST['isbnRegistered']);
    $externalPlatforms = htmlspecialchars($_POST['externalPlatforms']);

    // Insert into the database
    $stmt = $conn->prepare(
        "INSERT INTO publisher (
            country, authorContact, bookName, authorFullName, authorAddress, authorEmail, 
            publisherName, publisherAddress, publisherContact, publisherEmail, 
            format, publicationDate, openAccess, isbnRegistered, externalPlatforms
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
    );
    $stmt->bind_param(
        "sssssssssssssss",
        $country, $authorContact, $bookName, $authorFullName, $authorAddress, $authorEmail,
        $publisherName, $publisherAddress, $publisherContact, $publisherEmail,
        $format, $publicationDate, $openAccess, $isbnRegistered, $externalPlatforms
    );

    if ($stmt->execute()) {
        $successMessage = "Form submitted successfully.";

        $to= $publisherEmail;    
        $subject = "Request for ISBN from a Commercial Publisher";
          
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->Username = "nicolasmahlangu75@gmail.com";
        $mail->Password="ykbq ecat ctyl avbb ";
        $mail->setFrom($publisherEmail, $publisherName);
        $mail->addAddress("nicholus.mahlangu@nlsa.ac.za","Nicholus");
        //$mail->addAddress("motubatse.kgatle@nlsa.ac.za","motubatsi");
        $mail->Subject= "$subject";
        $mail->Body="Hi Motubatsi. A request for an ISBN has been sent for the book: $bookName by: $publisherName Email addresss: $publisherEmail";
        $mail->send();
        echo "email sent";
    } else {
        $errorMessage = "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Commercial Publisher Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
</head>
<body>

<div class="container mt-5">
  <h1 class="text-center mb-4">Commercial-Publisher ISBN Request Form</h1>

  <!-- Display Success/Error Messages -->
  <?php if (!empty($successMessage)): ?>
    <div class="alert alert-success"><?= htmlspecialchars($successMessage) ?></div>
  <?php elseif (!empty($errorMessage)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($errorMessage) ?></div>
  <?php endif; ?>

  <form id="isbnForm" action="" method="POST" class="needs-validation" novalidate>
    <!-- Country Selection -->
    <div class="mb-3">
      <label for="country" class="form-label">Select Your Country</label>
      <select id="country" name="country" class="form-select" required>
        <option value="" selected>— Select a country —</option>

            <!-- African Countries -->
    <optgroup label="Africa">
      <option data-code="+213" value="Algeria">🇩🇿 Algeria</option>
      <option data-code="+244" value="Angola">🇦🇴 Angola</option>
      <option data-code="+229" value="Benin">🇧🇯 Benin</option>
      <option data-code="+267" value="Botswana">🇧🇼 Botswana</option>
      <option data-code="+226" value="Burkina Faso">🇧🇫 Burkina Faso</option>
      <option data-code="+257" value="Burundi">🇧🇮 Burundi</option>
      <option data-code="+237" value="Cameroon">🇨🇲 Cameroon</option>
      <option data-code="+238" value="Cape Verde">🇨🇻 Cape Verde</option>
      <option data-code="+236" value="Central African Republic">🇨🇫 Central African Republic</option>
      <option data-code="+235" value="Chad">🇹🇩 Chad</option>
      <option data-code="+269" value="Comoros">🇰🇲 Comoros</option>
      <option data-code="+242" value="Congo (Brazzaville)">🇨🇬 Congo (Brazzaville)</option>
      <option data-code="+243" value="Congo (Kinshasa)">🇨🇩 Congo (Kinshasa)</option>
      <option data-code="+253" value="Djibouti">🇩🇯 Djibouti</option>
      <option data-code="+20" value="Egypt">🇪🇬 Egypt</option>
      <option data-code="+240" value="Equatorial Guinea">🇬🇶 Equatorial Guinea</option>
      <option data-code="+291" value="Eritrea">🇪🇷 Eritrea</option>
      <option data-code="+251" value="Ethiopia">🇪🇹 Ethiopia</option>
      <option data-code="+241" value="Gabon">🇬🇦 Gabon</option>
      <option data-code="+220" value="Gambia">🇬🇲 Gambia</option>
      <option data-code="+233" value="Ghana">🇬🇭 Ghana</option>
      <option data-code="+224" value="Guinea">🇬🇳 Guinea</option>
      <option data-code="+245" value="Guinea-Bissau">🇬🇼 Guinea-Bissau</option>
      <option data-code="+225" value="Ivory Coast">🇨🇮 Ivory Coast</option>
      <option data-code="+254" value="Kenya">🇰🇪 Kenya</option>
      <option data-code="+266" value="Lesotho">🇱🇸 Lesotho</option>
      <option data-code="+231" value="Liberia">🇱🇷 Liberia</option>
      <option data-code="+218" value="Libya">🇱🇾 Libya</option>
      <option data-code="+261" value="Madagascar">🇲🇬 Madagascar</option>
      <option data-code="+265" value="Malawi">🇲🇼 Malawi</option>
      <option data-code="+223" value="Mali">🇲🇱 Mali</option>
      <option data-code="+222" value="Mauritania">🇲🇷 Mauritania</option>
      <option data-code="+230" value="Mauritius">🇲🇺 Mauritius</option>
      <option data-code="+212" value="Morocco">🇲🇦 Morocco</option>
      <option data-code="+258" value="Mozambique">🇲🇿 Mozambique</option>
      <option data-code="+264" value="Namibia">🇳🇦 Namibia</option>
      <option data-code="+227" value="Niger">🇳🇪 Niger</option>
      <option data-code="+234" value="Nigeria">🇳🇬 Nigeria</option>
      <option data-code="+250" value="Rwanda">🇷🇼 Rwanda</option>
      <option data-code="+290" value="Saint Helena">🇸🇭 Saint Helena</option>
      <option data-code="+221" value="Senegal">🇸🇳 Senegal</option>
      <option data-code="+248" value="Seychelles">🇸🇨 Seychelles</option>
      <option data-code="+232" value="Sierra Leone">🇸🇱 Sierra Leone</option>
      <option data-code="+27" value="South Africa">🇿🇦 South Africa</option>
      <option data-code="+211" value="South Sudan">🇸🇸 South Sudan</option>
      <option data-code="+249" value="Sudan">🇸🇩 Sudan</option>
      <option data-code="+268" value="Eswatini">🇸🇿 Eswatini</option>
      <option data-code="+255" value="Tanzania">🇹🇿 Tanzania</option>
      <option data-code="+228" value="Togo">🇹🇬 Togo</option>
      <option data-code="+216" value="Tunisia">🇹🇳 Tunisia</option>
      <option data-code="+256" value="Uganda">🇺🇬 Uganda</option>
      <option data-code="+260" value="Zambia">🇿🇲 Zambia</option>
      <option data-code="+263" value="Zimbabwe">🇿🇼 Zimbabwe</option>
    </optgroup>

    <!-- Rest of the World -->
    <optgroup label="World">
      <option data-code="+1" value="USA">🇺🇸 USA</option>
      <option data-code="+44" value="UK">🇬🇧 UK</option>
      <option data-code="+91" value="India">🇮🇳 India</option>
      <option data-code="+61" value="Australia">🇦🇺 Australia</option>
      <option data-code="+81" value="Japan">🇯🇵 Japan</option>
      <option data-code="+86" value="China">🇨🇳 China</option>
      <option data-code="+49" value="Germany">🇩🇪 Germany</option>
      <option data-code="+33" value="France">🇫🇷 France</option>
      <option data-code="+7" value="Russia">🇷🇺 Russia</option>
      <option data-code="+55" value="Brazil">🇧🇷 Brazil</option>
    </optgroup>
      </select>
      <div class="invalid-feedback">Please select a country.</div>
    </div>

    <!-- Contact Number -->
    <div class="mb-3">
      <label for="authorContact" class="form-label">Author Contact Number</label>
      <div class="input-group">
        <span class="input-group-text" id="countryCode">+1</span>
        <input type="text" id="authorContact" name="authorContact" class="form-control" pattern="\d{7,15}" placeholder="Enter phone number" required>
      </div>
      <div class="invalid-feedback">Please enter a valid phone number.</div>
    </div>

    <!-- other Fields -->
    <div class="mb-3">
      <label for="bookName" class="form-label">Title/Name of the Book(s)</label>
      <input type="text" id="bookName" name="bookName" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="authorFullName" class="form-label">Author Full Name</label>
      <input type="text" id="authorFullName" name="authorFullName" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="authorAddress" class="form-label">Full Physical Address</label>
      <input type="text" id="authorAddress" name="authorAddress" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="authorEmail" class="form-label">Author Email Address</label>
      <input type="email" id="authorEmail" name="authorEmail" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="publisherName" class="form-label">Publisher Name</label>
      <input type="text" id="publisherName" name="publisherName" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="publisherAddress" class="form-label">Publisher Address</label>
      <input type="text" id="publisherAddress" name="publisherAddress" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="publisherContact" class="form-label">Publisher Contact</label>
      <input type="text" id="publisherContact" name="publisherContact" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="publisherEmail" class="form-label">Publisher Email</label>
      <input type="email" id="publisherEmail" name="publisherEmail" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="format" class="form-label">Format</label>
      <select id="format" name="format" class="form-select" required>
        <option value="">—Please choose an option—</option>
        <option value="Hardcover">Print</option>
        <option value="Paperback">Electronic</option>
        <option value="Digital">Both</option>
      </select>
    </div>
    <div class="mb-3">
      <label for="publicationDate" class="form-label">Estimated Publication Date</label>
      <input type="text" id="publicationDate" name="publicationDate" class="form-control datepicker" required>
    </div>
    <div class="mb-3">
      <label for="openAccess" class="form-label">Will your publications be available as Open Access?</label>
      <select id="openAccess" name="openAccess" class="form-select" required>
        <option value="Yes">Yes</option>
        <option value="No">No</option>
      </select>
    </div>
    <div class="mb-3">
      <label for="isbnRegistered" class="form-label">The ISBN should be registered against:</label>
      <select id="isbnRegistered" name="isbnRegistered" class="form-select" required>
        <!--<option value="Author">The Author</option>-->
        <option value="Publisher">The Publisher</option>
      </select>
    </div>
    <div class="mb-3">
      <label for="externalPlatforms" class="form-label">External Publishing Platforms</label>
      <input type="text" id="externalPlatforms" name="externalPlatforms" class="form-control" placeholder="e.g. Amazon" required>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

<script>
  // Update country code when a country is selected
  document.getElementById('country').addEventListener('change', function () {
    const selectedOption = this.options[this.selectedIndex];
    const countryCode = selectedOption.getAttribute('data-code');
    document.getElementById('countryCode').textContent = countryCode || '';
  });

  // Initialize datepicker
  $('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true,
    todayHighlight: true,
    startDate: new Date() // Restrict to today and future dates
  });

  // Bootstrap form validation
  (() => {
    'use strict';
    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  })();
</script>
</body>
</html>
