<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="G.O.A.T Team - Joey Manani">
    <meta name="description" content="Apply for an available job vacancy at an award-winning software company. We're GOAT Solutions. Tomorrow's Innovation, Today.">
    <meta name="keywords" content="GOAT, melbourne, IT, software, development">
    <title>Job Application | GOAT Solutions</title>
    <link rel="stylesheet" href="styles/styles.css">
    <!-- This document is licensed under the Joey Manani Licensing Agreement as specified in LICENSE -->
</head>
<body>
    <!-- Navigation Bar -->
    <?php include 'header.inc'; ?>


    <!-- Main Content -->
    <main class="form">
        <section class="panel form-section">
            <h1>Job Application</h1>
            <p>Please fill out the form below to apply for a job with us. Fields marked with an asterisk (*) are required.</p>

            
            <?php
            if (isset($_GET['error'])) {
                echo '<div class="overlay" id="overlay"></div>';
                echo '<div class="modal panel fail" id="modal">';
                echo "<button class='close' onclick='document.getElementById(\"modal\").remove(); document.getElementById(\"overlay\").remove()'>✖</button>";
                echo "<h2>The following error occurred in your submission:</h2>";
                echo "<pre>" . htmlspecialchars($_GET['error']) . "</pre>";
                echo "<p>Please correct the errors and try again.</p>";
                echo '</div>';
            }

            if (isset($_GET['EOInumber'])) {
                // get the name of the submitter from the db
                require 'settings.php';
                if (!$conn) {
                    die('Database connection failed: ' . mysqli_connect_error());
                }
                $stmt = $conn->prepare("SELECT fullname FROM eoi WHERE EOInumber = ?");
                $stmt->bind_param("i", $_GET['EOInumber']);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    // if the EOI number exists, display a thank you message, otherwise don't display anything as user might've manipulated the URL
                    $row = $result->fetch_assoc();
                    $name = htmlspecialchars($row['fullname']);
                    echo '<div class="overlay" id="overlay"></div>';
                    echo '<div class="modal panel" id="modal">';
                    echo "<button class='close' onclick='document.getElementById(\"modal\").remove(); document.getElementById(\"overlay\").remove()'>✖</button>";
                    echo "<h2>Thank you for your application, " . $name . "!</h2>";
                    echo "<p>Your application number is: <strong>" . htmlspecialchars($_GET['EOInumber']) . "</strong></p>";
                    echo '</div>';
                } 
            }
            ?>

            <!-- Create an application form to the swinburne test server -->
            <form action="process_eoi.php" method="post" novalidate>

                <!-- Job Reference Number -->
                <label for="jobRef">Job Reference Number: *</label>
                <select id="jobRef" name="jobRef" required>
                    <option value="" disabled selected>Select a job reference number</option>
                    <option value="sdev1">SDEV1 - Software Developer</option>
                    <option value="neta1">NETA1 - Network Administrator</option>
                    <option value="daan1">DAAN1 - Data Analyst</option>
                    <option value="cssp1">CSSP1 - Cybersecurity Specialist</option>
                    <option value="itsp1">ITSP1 - IT Support Technician</option>
                    <option value="clen1">CLEN1 - Cloud Engineer</option>
                    <option value="aiml1">AIML1 - AI/ML Engineer</option>
                </select>

                <!-- First Name -->
                <label for="firstName">First Name: *</label>
                <input type="text" id="firstName" name="firstName" maxlength="20" required pattern="^[A-Za-z\s\-]{1,20}$" title="First name should contain only letters, spaces or hyphens.">

                <!-- Last Name -->
                <label for="lastName">Last Name: *</label>
                <input type="text" id="lastName" name="lastName" maxlength="20" required pattern="^[A-Za-z\s\-]{1,20}$" title="Last name should contain only letters, spaces or hyphens.">

                <!-- Date of Birth -->
                <label for="dob">Date of Birth: *</label>
                <input type="date" id="dob" name="dob" required max="2007-01-01" title="You must be at least 18 years old to apply for a job"> <!-- No JS so just assume 1st jan 2007 marks 18 year olds -->

                <!-- Gender -->
                <fieldset>
                    <legend>Gender: *</legend>
                    <label for="male"><input type="radio" id="male" name="gender" value="Male" required> Male</label>
                    <label for="female"><input type="radio" id="female" name="gender" value="Female" required> Female</label>
                    <label for="other"><input type="radio" id="other" name="gender" value="Other" required> Other</label>
                </fieldset>

                <!-- Street Address -->
                <label for="address">Street Address: *</label>
                <input type="text" id="address" name="address" maxlength="40" required pattern="^[\w\s\.\-']{1,40}$" title="Street address should be up to 40 characters and can include letters, numbers, periods, hyphens, or apostrophes.">

                <!-- Suburb -->
                <label for="suburb">Suburb/Town: *</label>
                <input type="text" id="suburb" name="suburb" maxlength="40" required pattern="^[A-Za-z\s\-]{1,40}$" title="Suburb should only contain letters, spaces or hyphens.">

                <!-- State -->
                <label for="state">State: *</label>
                <select id="state" name="state" required>
                    <option value="" disabled selected>Select a state</option>
                    <option value="VIC">VIC</option>
                    <option value="NSW">NSW</option>
                    <option value="QLD">QLD</option>
                    <option value="NT">NT</option>
                    <option value="WA">WA</option>
                    <option value="SA">SA</option>
                    <option value="TAS">TAS</option>
                    <option value="ACT">ACT</option>
                </select>

                <!-- Postcode -->
                <label for="postcode">Postcode: *</label>
                <input type="text" id="postcode" name="postcode" maxlength="4" minlength="4" pattern="^\d{4}$" required title="Postcode must be exactly 4 digits.">

                <!-- Email -->
                <label for="email">Email Address: *</label>
                <input type="email" id="email" name="email" required pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[A-Za-z]{2,}$" title="Enter a valid email address.">

                <!-- Phone Number -->
                <label for="phone">Phone Number: *</label>
                <input type="tel" id="phone" name="phone" maxlength="10" minlength="6" pattern="^\d{6,10}$" required title="Phone number must be 6 to 10 digits.">

                <!-- Required Technical Skills -->
                <label>Required Technical Skills: *</label><br>
                <input type="checkbox" id="techSkills1" name="skills[]" required value="JavaScript"> JavaScript<br>
                <input type="checkbox" id="techSkills2" name="skills[]" required value="HTML"> HTML<br>
                <input type="checkbox" id="techSkills3" name="skills[]" required value="CSS"> CSS<br>

                <!-- Other Skills (Optional) -->
                <label for="otherSkills">Other Skills:</label>
                <textarea id="otherSkills" name="otherSkills" rows="4" cols="50" maxlength="1000" title="Keep it under 1000 characters. Letters, numbers and punctuation only."></textarea>

                <button type="submit">Apply</button>
            </form>
        </section>
    </main>


    <!-- Footer -->
    <?php include 'footer.inc'; ?>
</body>
</html>
