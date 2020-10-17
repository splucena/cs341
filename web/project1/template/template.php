<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=isset($title) ? $title : 'SRP Online Store'; ?></title>
    <link rel="stylesheet" href="../../static/css/all.css">
    <link rel="stylesheet" href="../../static/css/style.css?version=1">
    <link rel="stylesheet" href="../static/css/style.css?version=5">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <header>
            <nav><?php include $_SERVER['DOCUMENT_ROOT'] . '/cs341/web/project1/common/navigation.php'; ?></nav>
        </header>
        <main>
            <div class="main-container">
                <h1><?=isset($content_title) ? $content_title : 'Content Title'; ?></h1>
                <div>
                    <?=isset($main_content) ? $main_content : 'Main Content'; ?>
                </div>
            </div>
    </div>
    </main>
    <footer class="small-font">
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/cs341/web/project1/common/footer.php'; ?>
    </footer>
    </div>
</body>

</html>