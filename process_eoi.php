<?php
// Include the database connection file
require 'settings.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();

    // Check if the form data is set
    if (isset($_POST['jobRef']) && isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['dob']) && isset($_POST['gender']) && isset($_POST['address']) && isset($_POST['suburb']) && isset($_POST['state']) && isset($_POST['postcode']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['skills'])) {
        
        // Sanitize and validate the input data
        $jobRef = htmlspecialchars(trim($_POST['jobRef']));
        $firstName = htmlspecialchars(trim($_POST['firstName']));
        $lastName = htmlspecialchars(trim($_POST['lastName']));
        $dob = htmlspecialchars(trim($_POST['dob']));
        $gender = htmlspecialchars(trim($_POST['gender']));
        $address = htmlspecialchars(trim($_POST['address']));
        $suburb = htmlspecialchars(trim($_POST['suburb']));
        $state = htmlspecialchars(trim($_POST['state']));
        $postcode = htmlspecialchars(trim($_POST['postcode']));
        $email = htmlspecialchars(trim($_POST['email']));
        $phone = htmlspecialchars(trim($_POST['phone']));
        $skills = htmlspecialchars(trim(implode(", ", $_POST['skills'])));
        $otherSkills = isset($_POST['otherSkills']) ? htmlspecialchars(trim($_POST['otherSkills'])) : 'None provided';

        // Validate name fields
        if (!preg_match('/^[A-Za-z\s\-]{1,20}$/', $firstName) || !preg_match('/^[A-Za-z\s\-]{1,20}$/', $lastName)) {
            $_SESSION['error'] = "Invalid name format. Please only use letters, spaces or hyphens at a maximum of 20 characters.";
            header("Location: apply.php");
            exit();
        }

        // Validate the date of birth follows the format dd/mm/yyyy
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $dob)) {
            $_SESSION['error'] = "Invalid date format. Please use yyyy-mm-dd.";
            header("Location: apply.php");
            exit();
        }

        // Validate gender 
        if (!in_array($gender, ['Male', 'Female', 'Other'])) {
            $_SESSION['error'] = "Invalid gender selection.";
            header("Location: apply.php");
            exit();
        }

        // Validate address max 40 and only letters, numbers, periods, hyphens, or apostrophes
        if (!preg_match('/^[\w\s\.\-\']{1,40}$/', $address)) {
            $_SESSION['error'] = "Invalid address format. Please only use letters, numbers, periods, hyphens, or apostrophes maximum 40 characters.";
            header("Location: apply.php");
            exit();
        }

        // Validate suburb max 40 and only letters, spaces or hyphens
        if (!preg_match('/^[A-Za-z\s\-]{1,40}$/', $suburb)) {
            $_SESSION['error'] = "Invalid suburb format. Please only use letters, spaces or hyphens maximum 40 characters.";
            header("Location: apply.php");
            exit();
        }

        // Validate state
        $validStates = ['VIC', 'NSW', 'QLD', 'NT', 'WA', 'SA', 'TAS', 'ACT'];
        if (!in_array($state, $validStates)) {
            $_SESSION['error'] = "Invalid state selection. Please select a valid Australian state.";
            header("Location: apply.php");
            exit();
        }

        // Validate australian postcode exactly 4 digits and between 0200-9999
        if (!preg_match('/^\d{4}$/', $postcode) || $postcode < 0200 || $postcode > 9999) {
            $_SESSION['error'] = "Invalid postcode format. Please enter a valid 4-digit postcode between 0200 and 9999.";
            header("Location: apply.php");
            exit();
        }

        // Validate email format https://www.w3schools.com/php/filter_validate_email.asp
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "Invalid email format. Please enter a valid email address.";
            header("Location: apply.php");
            exit();
        }

        // Validate phone number 8 to 12 digits with spaces allowed 
        if (!preg_match('/^(?:\d\s*){8,12}$/', $phone)) {
            $_SESSION['error'] = "Invalid phone number format. Please enter a valid phone number with 8 to 12 digits.";
            header("Location: apply.php");
            exit();
        }

        // Concatenate skills into a binary string
        $bit1 = in_array('JavaScript', $_POST['skills']) ? 1 : 0;
        $bit2 = in_array('HTML', $_POST['skills']) ? 1 : 0;
        $bit3 = in_array('CSS', $_POST['skills']) ? 1 : 0;
        $skillsBinary = bindec("$bit1$bit2$bit3");

        if ($skillsBinary !== 7) {
            $_SESSION['error'] = "You need to select all of the required technical skills to be eligible for a job.";
            header("Location: apply.php");
            exit();
        }

        // Concatenate full name
        $fullName = $firstName . ' ' . $lastName;

        // Concatenate address
        $fullAddress = $address . ', ' . $suburb . ', ' . $state . ' ' . $postcode;

        if (!$conn) {
            die("Database connection failed: " . mysqli_connect_error());
        }

        // Create the EOI table if it does not exist
        $createTableSQL = "
            CREATE TABLE IF NOT EXISTS eoi (
                EOInumber INT AUTO_INCREMENT PRIMARY KEY,
                reference VARCHAR(10),
                fullname VARCHAR(100),
                address VARCHAR(255),
                email VARCHAR(100),
                phone VARCHAR(20),
                skills INT,
                other TEXT,
                status VARCHAR(20) DEFAULT 'New'
            );
        ";
        $conn->query($createTableSQL);

        // Insert the data
        $stmt = $conn->prepare("INSERT INTO eoi (reference, fullname, address, email, phone, skills, other) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $jobRef, $fullName, $fullAddress, $email, $phone, $skillsBinary, $otherSkills);

        if ($stmt->execute()) {
            $eoiNumber = $conn->insert_id;
            $_SESSION['EOInumber'] = $eoiNumber; // Store the EOI number in the session
            $_SESSION['name'] = $fullName;
            header("Location: apply.php");
            exit();
        } else {
            $_SESSION['error'] = "Database Error: " . $stmt->error;
            header("Location: apply.php");
            exit();
        }
    }
    else {
        $_SESSION['error'] = "Please fill in all required fields.";
        header("Location: apply.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
