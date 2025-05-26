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

    ?>

    <main>
        <!-- Create a page title panel -->
        <section class="panel">
            <h1 class="jobs-page-title">Job Openings</h1>
            <h2>There are currently <!-- make php do this --> vacancies</h2>
        </section>

        <!-- Create a grid layout for the job listings -->
        <div class="jobs-grid">
            <!-- Job 1: Software Developer -->
            <section class="panel">
                <h2 class="job-title"><!--reference--></h2>
                <h3 class="job-title-extended"><!--name--></h3>
                <p class="job-description">
                    <!--description-->
                </p>
                <p class="salary-range"><strong>Salary Range:</strong> Up to $<!--salary--> for entry level positions</p>
                <p class="report-to"><strong>Applicants Report To:</strong> <!--report_to--></p>
                <h3>Key Responsibilities:</h3>
                <ul class="job-responsibilities">
                    <!--responsibilities-->
                </ul>
                <h3><u>Required</u> Qualifications, Skills, Knowledge, and Attributes:</h3>
                <ul class="required-skills">
                    <!--required_skills-->
                </ul>
                <h3><u>Preferred</u> Qualifications, Skills, Knowledge, and Attributes:</h3>
                <ul class="preferred-skills">
                    <!--preferred_skills-->
                </ul>
            </section>
        </div>


        <aside class="panel">
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
