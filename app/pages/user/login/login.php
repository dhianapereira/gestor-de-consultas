<html>

<head>
    <title>Unidade de Saúde | Entrar</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../../../../public/styles/img/doctors-list.svg" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="../../../../public/styles/css/main.css" />
    <link rel="stylesheet" type="text/css" href="../../../../public/styles/css/home.css" />
    <link rel="stylesheet" type="text/css" href="../../../../public/styles/css/card.css" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap" rel="stylesheet" />
</head>

<body>
    <header>
        <h1 class="logo">Unidade de Saúde</h1>
    </header>
    <main class="container">
        <section class="up">
            <?php
            session_start();

            include_once('../../../utils/autoload.php');

            spl_autoload_register("autoload");

            use app\controllers\UserController;
            use app\components\MessageContainer;

            $user_controller = new UserController();

            $username = $_POST["username"];
            $password = $_POST["password"];

            if (isset($username) && isset($password)) {
                $result = $user_controller->signIn($username, $password);

                if ($result == null || !is_object($result)) {

                    MessageContainer::errorMessage("Erro ao tentar acessar a plataforma", "../../../../public/styles/img/error.svg", "O usuário inserido não possui permissão para acessar a plataforma.");
                } else {
                    $_SESSION['responsibility'] = $result->getResponsibility();
                    header('Location:../../home_page.php');
                }
            } else {
                MessageContainer::errorMessage("Não foi possível realizar esta operação", "../../../../public/styles/img/error.svg", "Você precisa inserir o username e a senha para acessar a plataforma!");
            }
            ?>
        </section>
    </main>
    <footer>
        <p>2021 - Unidade de Saúde</p>
    </footer>
</body>

</html>