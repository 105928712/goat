<?php
session_start();
include 'settings.php';

// Create manager table if it doesn't exist
$conn->query("CREATE TABLE IF NOT EXISTS managers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    failed_attempts INT DEFAULT 0,
    lockout_time DATETIME DEFAULT NULL
)");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="G.O.A.T Team - Joey Manani">
    <meta name="description" content="Management Portal">
    <meta name="keywords" content="GOAT, melbourne, IT, software, development">
    <title>Management | GOAT Solutions</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <?php include 'header.inc'; ?>

    <?php
    // Handle signup
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signup'])) {
        $newUser = trim($_POST['new_username']);
        $newPass = trim($_POST['new_password']);
        $confirmPass = trim($_POST['confirm_password']);

        if ($newPass !== $confirmPass) {
            die("<h1>Passwords do not match.</h1>");
        }

        // Check if user already exists
        $checkStmt = $conn->prepare("SELECT * FROM managers WHERE username = ?");
        $checkStmt->bind_param("s", $newUser);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();

        if ($checkResult->num_rows > 0) {
            die("<h1>Username already exists.</h1>");
        }

        // hash the password
        $hashedPass = password_hash($newPass, PASSWORD_DEFAULT);

        $insertStmt = $conn->prepare("INSERT INTO managers (username, password) VALUES (?, ?)");
        $insertStmt->bind_param("ss", $newUser, $hashedPass);
        if ($insertStmt->execute()) {
            $_SESSION['manager'] = $newUser; // auto-login after signup
            $conn->query("UPDATE managers SET failed_attempts = 0, lockout_time = NULL WHERE username = '$newUser'");
            header("Location: manage.php");
        } else {
            die("<h1>Signup failed. Try again.</h1>");
        }
    }

    // Handle login
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        $stmt = $conn->prepare("SELECT * FROM managers WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $manager = $result->fetch_assoc();

        if ($manager) {
            $now = new DateTime();
            $lockout = new DateTime($manager['lockout_time']);
            $lockout->modify('+15 minutes'); // 15 minutes lockout period


            if ($manager['failed_attempts'] >= 3 && $now < $lockout) {
                die("<h1>Too many failed login attempts. Please try again later.</h1>");
            }

            if (password_verify($password, $manager['password'])) { // hashed password check
                $_SESSION['manager'] = $username;
                $conn->query("UPDATE managers SET failed_attempts = 0, lockout_time = NULL WHERE username = '$username'");

            } else {
                // increment failed attempts and lockout
                $conn->query("UPDATE managers SET failed_attempts = failed_attempts + 1, lockout_time = NOW() WHERE username = '$username'");
                die("<h1>Invalid credentials.</h1>");
            }
        } else {
            die("<h1>Invalid credentials.</h1>");
        }
    }
    ?>

    <?php
    // Check if logout is requested
    if (isset($_GET['logout'])) {
        session_destroy();
        header("Location: manage.php");
        exit();
    }

    // Check login
    if (!isset($_SESSION['manager'])) {
        echo '
        <main class="form">
        <section class="panel form-section">

        <form method="POST" action="manage.php">
        <h1>Manager Login</h1>
        <label>Username: <input type="text" name="username" required></label><br>
        <label>Password: <input type="password" name="password" required></label><br>
        <button type="submit" name="login">Login</button>
        </form>
        </section>

        <section class="panel form-section">
        <form method="POST" action="manage.php">
        <h1>Manager Signup</h1>
        <label>New Username: <input type="text" name="new_username" required></label><br>
        <label>New Password: <input type="password" name="new_password" required></label><br>
        <label>Confirm Password: <input type="password" name="confirm_password" required></label><br>
        <button type="submit" name="signup">Sign Up</button>
        </form>

        </section>
        </main>
    ';
    } else { ?>
        <main class="form">
            <section class="panel form-section manage-section">

                <!-- Manager Control Panel -->
                <h2>Welcome, <?php echo $_SESSION['manager'] ?>! <a href="manage.php?logout">Logout</a></h2>

                <form method="GET" action="manage.php">
                    <h3>Manage EOIs</h3>
                    <fieldset class="manage-eoi">
                        <legend>Actions</legend>
                        <label><input type="radio" name="action" value="list_all" required> List all EOIs</label>
                        <label><input type="radio" name="action" value="list_job"> List EOIs by <input type="text" placeholder="Job Reference" name="jobRef"></label>
                        <label><input type="radio" name="action" value="list_name"> List EOIs by <input type="text" name="firstName" placeholder="First name"> <input type="text" name="lastName" placeholder="Last name"></label>
                        <label><input type="radio" name="action" value="delete_job"> Delete EOIs by <input type="text" placeholder="Job Reference" name="deleteJobRef"></label>
                        <label><input type="radio" name="action" value="update_status"> Change Status of <input type="number" placeholder="EOI Number" name="eoiNumber"> to 
                            <select name="status">
                                <option value="New">New</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Finalised">Finalised</option>
                            </select>
                        </label>
                    </fieldset>
                    
                    <button type="submit">Submit</button>
                </form>


                <?php
        // get the action from the form submission
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action'])) {
            $action = $_GET['action'];

            switch ($action) {
                case 'list_all':
                    $result = $conn->query("SELECT * FROM eoi");
                    break;

                case 'list_job':
                    $jobRef = $_GET['jobRef'];
                    $stmt = $conn->prepare("SELECT * FROM eoi WHERE reference = ?");
                    $stmt->bind_param("s", $jobRef);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    break;


                case 'list_name':
                    $first = $_GET['firstName'] ?? '';
                    $last = $_GET['lastName'] ?? '';
                    $nameQuery = "%" . trim($first . ' ' . $last) . "%"; // allow empty first or last name (% wildcard for partial match on either side to search either first or last)
                    $stmt = $conn->prepare("SELECT * FROM eoi WHERE fullname LIKE ?");
                    $stmt->bind_param("s", $nameQuery);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    break;

                case 'delete_job':
                    $jobRef = $_GET['deleteJobRef'];
                    $stmt = $conn->prepare("DELETE FROM eoi WHERE reference = ?");
                    $stmt->bind_param("s", $jobRef);
                    $stmt->execute();
                    echo "<p>EOIs deleted for job reference $jobRef.</p>";
                    return;

                case 'update_status':
                    $eoiNum = $_GET['eoiNumber'];
                    $status = $_GET['status'];
                    $stmt = $conn->prepare("UPDATE eoi SET status = ? WHERE EOInumber = ?");
                    $stmt->bind_param("si", $status, $eoiNum);
                    $stmt->execute();
                    echo "<p>Status updated for EOI $eoiNum to $status</p>";
                    return;

                default:
                    echo "<p>Invalid action.</p>";
                    return;
            }

            // display results as table
            if (isset($result) && $result->num_rows > 0) {
                echo "<table><tr><th>EOI Number</th><th>Reference</th><th>Name</th><th>Address</th><th>Email</th><th>Phone</th><th>Skills</th><th>Other</th><th>Status</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['EOInumber']}</td>
                        <td>{$row['reference']}</td>
                        <td>{$row['fullname']}</td>
                        <td>{$row['address']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['phone']}</td>
                        <td>{$row['skills']}</td>
                        <td>{$row['other']}</td>
                        <td>{$row['status']}</td>
                    </tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No results found.</p>";
            }
        }
        ?>



            </section>
        </main>

    <?php } ?>



    <?php include 'footer.inc'; ?>
    
</body>
</html>
