<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="G.O.A.T Team - Joey Manani, Sienna Virtuoso & Nima Adel">
    <meta name="description" content="View all of our current job vacancies. We'd love you to be part of our team. We're GOAT Solutions. Tomorrow's Innovation, Today.">
    <meta name="keywords" content="GOAT, melbourne, IT, software, development">
    <title>Job Vacancies | GOAT Solutions</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <!-- Navigation Bar -->
    <?php include 'header.inc'; ?>

    <?php
        require 'settings.php';

        if (!$conn) {
            die('Database connection failed: ' . mysqli_connect_error());
        }

        // Query the database for job listings
        $result = mysqli_query($conn, 'SELECT * FROM jobs');
    ?>


    <main>
        <!-- Create a page title panel -->
        <section class="panel">
            <h1 class="jobs-page-title">Job Openings</h1>
            <h2>There are currently <?php echo mysqli_num_rows($result) ?> vacancies</h2>
        </section>

        <!-- Create a grid layout for the job listings -->
        <div class="jobs-grid">

            <?php

            if (mysqli_num_rows($result) > 0) {
                // while loop goes here to fetch each job listing
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<section class="panel">';
                    echo '<h2 class="job-title">' . $row['reference'] . '</h2>';
                    echo '<h3 class="job-title-extended">' . $row['name'] . '</h3>';
                    echo '<p class="job-description">' . $row['description'] . '</p>';
                    echo '<p class="salary-range"><strong>Salary:</strong> Up to $' . $row['salary'] . '</p>';
                    echo '<p class="report-to"><strong>Report To:</strong> ' . $row['report_to'] . '</p>';
                    echo '<details>';
                    echo '<summary><h3>Key Responsibilities:</summary>';
                    echo '<ul class="job-responsibilities">';
                    echo $row['responsibilities'];
                    echo '</ul>';
                    echo '</details>';
                    echo '<details class="qualifications">';
                    echo '<summary><h3>Qualifications:</h3></summary>';
                    echo '<details>';
                    echo '<summary><h3>Required:</h3></summary>';
                    echo '<ul class="required-skills">';
                    echo $row['required_skills'];
                    echo '</ul>';
                    echo '</details>';
                    echo '<details>';
                    echo '<summary><h3>Preferred:</h3></summary>';
                    echo '<ul class="preferred-skills">';
                    echo $row['preferred_skills'];
                    echo '</ul>';
                    echo '</details>';
                    echo '</details>';
                    echo '</section>';
                }
            }

            ?>
        </div>


        <aside class="panel" id="trainingPanel">
            <button class="close" onclick="document.getElementById('trainingPanel').remove()">✖</button>
            <h2>Experience Award-Winning Training</h2>
            <p>At GOAT, we prioritise your training and wellbeing. We have an award-winning training process which 
                will guarantee your satisfaction. Whether you're just starting out, or completely dynamic, 
                we will get you up to scratch with how we want to work with you. 
                Experience high-pay as well as a supportive and friendly workplace environment. 
                We're GOAT. Tomorrow's Innovation, Today</p>
            <a href="apply.php">Apply Now</a>
        </aside>
    </main>

    <!-- Footer -->
    <?php include 'footer.inc'; ?>
</body>
</html>
