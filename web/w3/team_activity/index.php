<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        html {
            box-sizing: border-box;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        .container {
            margin: 0 auto;
            width: 400px;
            border: solid 1px #000;
        }

        div {
            padding: 5px;
        }

        input[type=text],
        textarea,
        input[type=submit] {
            padding: 4px;
            width: 100%;
        }
    </style>
</head>
<body>
    <div>
        <?php
            $majors = array(array("cs","Computer Programming"), 
                            array("wdd","Web Design & Development"), 
                            array("cit","Computer Information Technology"), 
                            array("ce","Computer Engineering"));

            $continents = array("na" => "North America",
                                "sa" =>"South America",
                                "eu" => "Europe",
                                "as" => "Asia",
                                "au" => "Australia",
                                "af" => "Africa",
                                "an" => "Antartica");

            $html = "<div class='container'>";
            $html .= "<div>
                        <label for='name'>Name</label>
                        <input type='text' name='name'>
                    </div>";
            $html .= "<div>
                        <label for='email'>Email</label><br>
                        <input type='text' id='email' name='email'>
                    </div>";
            $html .= "<div><fieldset><legend>Majors</legend>";
            foreach($majors as $major) {
                $html .="<input type='radio' name='$major[0]'>
                        <label for='$major[0]'>$major[1]</label><br>";
            }
            $html .= "</fieldset></div>";
            
            $html .= "<div><fieldset><legend>Continents</legend>";
            foreach($continents as $key => $value) {
                $html .="<input type='checkbox' name='$key'>
                        <label for='$key'>$value</label><br>";
            }
            $html .= "</fieldset></div>"; 
            $html .= "<div>";

            echo $html;
        ?>
    </div>
</body>
</html>