<header class="site-header">
    <div class="header-container">
        <a href="index.php" class="logo">
            <img src="images/logo.png" alt="Site Logo">
        </a>
        <nav class="main-nav">
            <ul>
                <li><a href="index.php" class="<?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>">Home</a></li>
                <li><a href="jobs.php" class="<?= basename($_SERVER['PHP_SELF']) == 'jobs.php' ? 'active' : '' ?>">Jobs</a></li>
                <li><a href="apply.php" class="<?= basename($_SERVER['PHP_SELF']) == 'apply.php' ? 'active' : '' ?>">Apply</a></li>
                <li><a href="about.php" class="<?= basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : '' ?>">About</a></li>
            </ul>
        </nav>
    </div>
</header>