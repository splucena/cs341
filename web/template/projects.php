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
                <a href="index.php">Home</a>
                <a href="projects.php" class="active">Projects</a>
                <a href="#about">About</a>
                <a href="javascript:void(0)" class="icon" onclick="toggleMenu()">
                    <i class="fa fa-bars"></i>
                </a>
            </nav>
        </header>
        <main>
            <div class="profile-container">
                <h2>Coming Soon!</h2>
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