<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="G.O.A.T Team - Sienna Virtuoso">
    <meta name="description" content="Enhancements to the GOAT Solutions application process.">
    <meta name="keywords" content="GOAT, melbourne, IT, software, development">
    <title>Enhancement | GOAT Solutions</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <?php include 'header.inc'; ?>
        <main>
            <section class="panel">
                <h1>Enhancements</h1>
            </section>
            <section class="panel">
                <h2>1. Modularisation</h2>
                <p>To make the HTML repeat less and to remove any redundancy, repeated elements such as the header and footer were modulurised into inc files are dynamically inserted into each of the PHP files.</p>
            </section>
            <section class="panel">
                <h2>2. Settings.php</h2>
                <p>The settings.php file was created to store the database's credentials and create a connection. This file was included in every PHP file that required access to the database.</p>
            </section>
            <section class="panel">
                <h2>3. EOI Table</h2>
                <p>The EOI table was created inside of the database and this holds all of the Expressions of Interest as submitted by the apply.php page.</p>
            </section>
            <section class="panel">
                <h2>4. Process EOI</h2>
                <p>The file process_eoi.php was used to process the form data from apply.php, validate it as per the requirements and if they pass, to insert a new Expression of Interest into the table for managers to review</p>
            </section>
            <section class="panel">
                <h2>5. HR Manager</h2>
                <p>The manage.php page allows managers to query the EOI table and retrieve applications with the following options:</p>
                <ul>
                    <li>List all EOIs.</li>
                    <li>List all EOIs for a particular position (given a job reference number).</li>
                    <li>List all EOIs for a particular applicant given their first name, last name or both.</li>
                    <li>Delete all EOIs with a specified job reference number</li>
                    <li>Change the Status of an EOI.</li>
                </ul>
            </section>
            <section class="panel">
                <h2>6. About Page</h2>
                <p>The about.php was updated to reflect team member's contribution for part 2 of the project. No PHP was required in this file.</p>
            </section>
            <section class="panel">
                <h2>7. Job Descriptions</h2>
                <p>Another table was created inside of the database which holds the job descriptions for each job currently vacant. A total of six records exist. The jobs.php file utilised this table to dynamically create panels which advertise each job and display how many vacancies at the top.</p>
            </section>
            <section class="panel">
                <h2>8. Enhancements for Manage Page</h2>

                <p>To allow secure access to manage.php, a manager registration page was created. This page collects a unique username and a secure password, which are validated on the server side before being stored in a dedicated database table named managers.</p>

                <h3>Unique Username Validation:</h3>
                <p>Upon submission, the server checks whether the chosen username already exists in the managers table. If it does, the user is prompted to choose a different name. This prevents conflicts and ensures each manager can be individually identified.</p>

                <h3>Login Process:</h3>
                <p>Once validated, the password is hashed (e.g., using PHP's password_hash() function) and then stored in the database, along with the username. Storing hashed passwords is a critical security best practice to prevent credential leaks in the event of a data breach. This allows managers to login restricting access to manage.php</p>

                <h3>Lockout Process:</h3>
                <p>The managers table includes a column for invalid login attempts and a lockout timestamp. If a manager fails to log in after three attempts, the system locks them out for 15 minutes. During this period, any login attempts will be denied, and the user will be informed of the lockout status.</p>

                <h3>Inline Form:</h3>
                <p>The manage.php form uses the radio buttons inline with the input field for better usability and accessibility.

                <h3>Custom Storage of Skills:</h3>
                <p>Taking inspiration from binary, each of the required skills checkboxes holds a significant value that when added can create an integer that represents the skills selected. This integer is then stored in the database, allowing for efficient storage and retrieval of skills. </p>
            </section>
            <section class="panel">
                <h2>9. Feedback Incorporated</h2>

                <p>Feedback from the team including tutor from part 1 was incorporated into the project, including:</p>

                <ul>
                    <li>Fixing the section heights in index.php as per tutor's feedback</li>
                    <li>Fixed the overcrowding of jobs.php and ensuring the &lt;aside&gt; is more clear</li>
                    <li>Field-specific error hinting on apply.php using a modal.</li>
                    <li>Redundant CSS comments were removed.</li>
                </ul>
            </section>
        </main>

    <?php include 'footer.inc'; ?>
</body>
</html>
