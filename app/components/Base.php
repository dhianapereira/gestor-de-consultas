<?php
class Base
{

    public static function head($title)
    {
?>

        <title><?php echo ($title); ?></title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="shortcut icon" href="./public/styles/img/doctors-list.svg" type="image/x-icon" />
        <link rel="stylesheet" type="text/css" href="./public/styles/css/main.css" />
        <link rel="stylesheet" type="text/css" href="./public/styles/css/home.css" />
        <link rel="stylesheet" type="text/css" href="./public/styles/css/card.css" />
        <link rel="stylesheet" type="text/css" href="./public/styles/css/buttons.css" />
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap" rel="stylesheet" />

    <?php
    }

    public static function header()
    {
    ?>
        <header>
            <h3 class="logo">Gestor de Consultas</h3>
        </header>
    <?php
    }

    public static function footer()
    {
    ?>
        <footer>
            <p>2021 - Gestor de Consultas</p>
        </footer>
<?php
    }
}
