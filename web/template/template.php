<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=isset($title) ? $title : 'Home'?></title>
    <link rel="stylesheet" href="./static/css/bootstrap.min.css">
    <link rel="stylesheet" href="./static/css/style.css?version=1">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container-fluid h-100">
        <div class="row">
            <nav class="navbar navbar-expand-lg w-100 navbar-custom">
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
        </div>
        <div class="row h-75">
            <main>
                <div class="container-fluid text-center h-100">
                    <div class="row content h-100">
                        <div class="col-sm-5 text-left about">
                            <div class="card special-card">
                                <div class="card-header border-bottom">
                                    <div class="row">
                                        <div class="col-sm-2"><img class="text-center" style="border-radius: 50%;" src="./static/img/person.png" width="80px" height="80px"
                                        alt="My Image"></div>
                                        <div class="col col-sm-10 p-3"><h2 class="card-title">Sumilang R. Plucena</h2></div>
                                    </div>
                                </div>
                                <div class="card-body border-bottom">                                    
                                    <p class="card-text">
                                        The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for
                                        those
                                        interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by
                                        Cicero are also reproduced in their exact original form, accompanied by English
                                        versions from the 1914 translation by H. Rackham.
                                    </p>
                                    <a href="#" class="btn btn-success">PROJECTS</a>
                                </div>
                                <div class="card-footer text-muted">
                                    2 days ago
                                </div>
                            </div>
                        </div>
                    </div>
            </main>
        </div>
        <div class="row">
            <footer class="w-100 text-center p-2">
                <div>
                    <span>&copy; Sumilang R. Plucena, All rights reserved</span><br />
                    <span>All images used are believed to be in "Fair Use". Please notify author if any are not and they
                        will be
                        removed.</span><br />
                    <span>Last updated: <?=isset($currentDate) ? $currentDate : "2.2.2020" ?></span>
                </div>
            </footer>
        </div>
    </div>
</body>

</html>