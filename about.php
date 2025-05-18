<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="G.O.A.T Team - Sienna Virtuoso">
    <meta name="description" content="About our company. We're GOAT Solutions. Tomorrow's Innovation, Today.">
    <meta name="keywords" content="GOAT, melbourne, IT, software, development">
    <title>About Us | GOAT Solutions</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <!-- Navigation Bar -->
    <?php include 'header.inc'; ?>

    <main>
        <!-- Panel which holds the content for information about our team -->
        <section class="panel">
            <h1>About Us</h1>
            <h2>Team Name: GOAT</h2>
            <h2>Class: Friday 8:30am</h2>
            <h2>Tutor: Razeen</h2>

            <h2>Team Members:</h2>
            <dl>
                <dt class="right">Joey - 105928712</dt>
                <dd>Joey managed our team. He managed our Jira project, the GitHub page, and completed apply.html. He contributed the main styling of all the pages using the colour palette provided by Sienna, creating default panels, navigation and footers for each page as well as using prior knowledge to create an enhanced end-user experience. Joey also aided every team member with their respective pages. Using Sienna's basis for a logo design, Joey created the logo's final design. </dd>
                <dt class="right">Sienna - 105914355</dt>
                <dd>Sienna was responsible for all content displayed to the user, from all content on index.html to the written job descriptions for jobs.html, as well as group information for about.html. She provided the colour scheme, the company name, and the basis for the company logo. She also completed about.html.</dd>
                <dt class="right">Nima - 105911262</dt>
                <dd>Nima was assigned jobs.html. Using Sienna's written job descriptions and Joey's basic styling for the job descriptions page, Nima completed his page by inserting all the content into the page using Joey's pre-defined panels.</dd>
            </dl>
        </section>

        <div id="about-sections">
            <!-- Panel which holds the content for member interests -->
            <section class="panel" id="tables">
                <h2>Member Interests</h2>
                <table class="center">
                <thead>
                    <tr>
                        <th rowspan="1" scope="col">Member:</th>
                        <th rowspan="1" scope="col">Interests:</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">Joey</th>
                    <td>Hacking, table tennis and complex systems</td>
                </tr>
                <tr>
                    <th scope="row">Sienna</th>
                    <td>Mario Kart, cats and the colour purple</td>
                </tr>
                <tr>
                    <th scope="row">Nima</th>
                    <td>Videogames and computers</td>
                </tr>
                </tbody>
                </table>
            </section>

            <section class="panel" id="language">
                <h2>Favourite Programming Language</h2>
                <table class="center">
                <thead>
                    <tr>
                        <th rowspan="1" scope="col">Member:</th>
                        <th rowspan="1" scope="col">Favourite:</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">Joey</th>
                    <td>JavaScript and Python</td>
                </tr>
                <tr>
                    <th scope="row">Sienna</th>
                    <td>Python</td>
                </tr>
                <tr>
                    <th scope="row">Nima</th>
                    <td>C++</td>
                </tr>
                </tbody>
                </table>
            </section>

            <section class="panel" id="movie">
                <h2>Favourite Movie</h2>
                <table class="center">
                <thead>
                    <tr>
                        <th rowspan="1" scope="col">Member:</th>
                        <th rowspan="1" scope="col">Favourite:</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">Joey</th>
                    <td>Baby Driver (2017)</td>
                </tr>
                <tr>
                    <th scope="row">Sienna</th>
                    <td>The Equalizer (2014)</td>
                </tr>
                <tr>
                    <th scope="row">Nima</th>
                    <td>Game of Thrones (TV)</td>
                </tr>
                </tbody>
                </table>
            </section>

            <!-- Panel which holds the content for member photos -->
            <section class="panel" id="photos">
                <h2>Member Photos</h2>
                <!-- Member Photos! -->
                 <figure>
                    <img src="images/goat.jpg" alt="Photos of our team members." title="Member Photos">
                    <figcaption>The GOAT Team</figcaption>
                </figure>
            </section>
        </div>
    </main>


    <!-- Footer -->
    <?php include 'footer.inc'; ?>
</body>
</html>
