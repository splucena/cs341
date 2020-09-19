<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=isset($title) ? $title : 'Home'?></title>
    <link rel="stylesheet" href="../web/static/css/bootstrap.min.css">
    <link rel="stylesheet" href="../web/static/css/style.css">
</head>

<body>
    <div class="bg">
        <nav class="navbar navbar-expand-lg navbar-custom">
            <a class="navbar-brand" href="http://">CIT341</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Projects</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                </ul>
                <span class="navbar-text">
                    Web Backend Development II
                </span>
            </div>
        </nav>
        <main>
            <div class="row">

            </div>
        </main>
        <footer class="text-center p-2">
            <div>
            <span>&copy; Sumilang R. Plucena, All rights reserved</span><br />
            <span>All images used are believed to be in "Fair Use". Please notify author if any are not and they will be
                removed.</span><br />
            <span>Last updated: <?=isset($currentDate) ? $currentDate : "2.2.2020" ?></span>
            </div>            
        </footer>
    </div>
</body>

</html>