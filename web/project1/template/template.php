<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=isset($title) ? $title : 'SRP Online Store'; ?></title>
    <link rel="stylesheet" href="../../static/css/all.css">
    <link rel="stylesheet" href="../../static/css/style.css?version=1">
    <link rel="stylesheet" href="../static/css/style.css?version=16">
    <script src="../../static/js/jquery-3.5.1.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <header>
            <nav><?php include __DIR__. '/../common/navigation.php'; ?></nav>
        </header>
        <main>
            <div class="main-container">
                <h1><?=isset($content_title) ? $content_title : ''; ?></h1>
                <div class=<?=isset($home_container) ? "home-container" : "form-container";?>>                    
                    <?php
                        if (isset($home_title)) {
                            echo "<h1>$home_title</h1>";
                        }
                    ?>
                    <?=isset($main_content) ? $main_content : 'Main Content'; ?>
                </div>
            </div>
        </main>
        <footer class="small-font">
            <?php include __DIR__. '/../common/footer.php'; ?>
        </footer>
    </div>
    <script src="../../static/js/toggleMenu.js"></script>
</body>

</html>