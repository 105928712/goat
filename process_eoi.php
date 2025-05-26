<?php
// Include the database connection file
require 'settings.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
            header("Location: apply.php?error=Invalid name format. Please only use letters, spaces or hyphens at a maximum of 20 characters.");
            exit();
        }

        // Validate the date of birth follows the format dd/mm/yyyy
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $dob)) {
            header("Location: apply.php?error=Invalid date format. Please use dd/mm/yyyy.");
            exit();
        }

        // Validate gender 
        if (!in_array($gender, ['Male', 'Female', 'Other'])) {
            header("Location: apply.php?error=Invalid gender selection.");
            exit();
        }

        // Validate address max 40 and only letters, numbers, periods, hyphens, or apostrophes
        if (!preg_match('/^[\w\s\.\-\']{1,40}$/', $address)) {
            header("Location: apply.php?error=Invalid address format. Please only use letters, numbers, periods, hyphens, or apostrophes maximum 40 characters.");
            exit();
        }

        // Validate suburb max 40 and only letters, spaces or hyphens
        if (!preg_match('/^[A-Za-z\s\-]{1,40}$/', $suburb)) {
            header("Location: apply.php?error=Invalid suburb format. Please only use letters, spaces or hyphens maximum 40 characters.");
            exit();
        }

        // Validate state
        $validStates = ['VIC', 'NSW', 'QLD', 'NT', 'WA', 'SA', 'TAS', 'ACT'];
        if (!in_array($state, $validStates)) {
            header("Location: apply.php?error=Invalid state selection.");
            exit();
        }

        // Validate australian postcode exactly 4 digits and between 0200-9999
        if (!preg_match('/^\d{4}$/', $postcode) || $postcode < 0200 || $postcode > 9999) {
            header("Location: apply.php?error=Invalid postcode format. Please enter a valid 4-digit postcode.");
            exit();
        }

        // Validate email format https://www.w3schools.com/php/filter_validate_email.asp
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: apply.php?error=Invalid email format.");
            exit();
        }

        // Validate phone number 8 to 12 digits with spaces allowed 
        if (!preg_match('/^(?:\d\s*){8,12}$/', $phone)) {
            header("Location: apply.php?error=Invalid phone number format. Please enter a valid phone number with 8 to 12 digits.");
            exit();
        }

        // Concatenate skills into a binary string
        $bit1 = in_array('JavaScript', $_POST['skills']) ? 1 : 0;
        $bit2 = in_array('HTML', $_POST['skills']) ? 1 : 0;
        $bit3 = in_array('CSS', $_POST['skills']) ? 1 : 0;
        $skillsBinary = bindec("$bit1$bit2$bit3");

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
            header("Location: apply.php?eoiNumber=$eoiNumber");
            exit();
        } else {
            header("Location: apply.php?error=Database error.");
            exit();
        }
    }
    else {
        header("Location: apply.php?error=Please fill in all required fields.");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
