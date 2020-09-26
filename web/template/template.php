<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=isset($title) ? $title : 'Home'?></title>
    <!--<link rel="stylesheet" href="./static/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="./static/css/all.css">
    <link rel="stylesheet" href="./static/css/style.css?version=1">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <header>
            <nav class="navbar-top" id="navbarTop">
                <a class="navbar-brand" href="#"><img class="brand-icon" src="./static/img/icon/coding.png"
                        alt="Coding" /></a>
                <a href="index.php" class="active">Home</a>
                <a href="projects.php">Projects</a>
                <a href="#about">About</a>
                <a href="javascript:void(0)" class="icon" onclick="toggleMenu()">
                    <i class="fa fa-bars"></i>
                </a>
            </nav>
        </header>
        <main>
            <div class="profile-container">
                <div class="profile-text border-bottom padding-bottom">
                    <div><img class="profile-picture" src="./static/img/splucena.jpg" width="80px"
                            height="80px" alt="My Image"></div>
                    <div class="">
                        <h2 class="">Sumilang R. Plucena</h2>
                        <span class="small-font">Technology Enthusiast</span>
                    </div>
                </div>
                <div class="profile-description">
                    <p class="">
                        Experienced Information Technology Specialist with a demonstrated history of
                        working in the hospital & health care industry. Skilled in Leadership,
                        Automation, Web Frontend and Backend Development, Database Management,
                        Troubleshooting, and Linux. Proficient in Python, Java, PHP, JavaScript, CSS,
                        HTML, and SQL.
                    </p>

                </div>
                <div class="profile-projects border-bottom padding-bottom">
                    <a href="projects.php" class="btn btn-success">PROJECTS</a>
                </div>
                <div class="profile-footer">
                    <div class="profile-icon">
                        <span><a href="https://www.facebook.com/sumilang.plucena" target="_blank"><img class="icon"
                                    src="./static/img/icon/facebook.png" alt=""></a></span>
                        <span><a href="https://www.linkedin.com/in/sumilang-plucena-462a4a60/" target="_blank"><img
                                    class="icon" src="./static/img/icon/linkedin.png" alt=""></a></span>
                        <span><a href="https://github.com/splucena" target="_blank"><img class="icon"
                                    src="./static/img/icon/github.png" alt=""></a></span>
                    </div>
                </div>
            </div>
        </main>
        <footer class="small-font">
            <div>
                <span>&copy; Sumilang R. Plucena, All rights reserved</span><br />
                <span>All images used are believed to be in "Fair Use".</span><br /><span>Please notify author if
                    any are not and they
                    will be
                    removed.</span><br />
                <span>Last updated: <?=isset($currentDate) ? $currentDate : "2.2.2020" ?></span>
            </div>
        </footer>
    </div>
    <script src="./static/js/toggleMenu.js"></script>
</body>

</html>