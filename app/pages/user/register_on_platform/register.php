<html>

<head>
    <title>Unidade de Saúde | Cadastrar</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../../../../public/styles/img/doctors-list.svg" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="../../../../public/styles/css/main.css" />
    <link rel="stylesheet" type="text/css" href="../../../../public/styles/css/home.css" />
    <link rel="stylesheet" type="text/css" href="../../../../public/styles/css/card.css" />
    <link rel="stylesheet" type="text/css" href="../../../../public/styles/css/buttons.css" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap" rel="stylesheet" />
</head>

<body>
    <header>
        <h1 class="logo">Unidade de Saúde</h1>
    </header>
    <main class="container">
        <section class="up">
            <?php
            include_once('../../../utils/autoload.php');

            spl_autoload_register("autoload");

            use app\controllers\UserController;
            use app\components\MessageContainer;

            $user_controller = new UserController();

            $cpf = $_POST["cpf"];
            $username = $_POST["username"];
            $password = $_POST["password"];
            $confirm_password = $_POST["confirm_password"];

            if (
                isset($username) && isset($password) &&
                isset($cpf) && isset($confirm_password)
            ) {
                $user = $user_controller->fetchUser($cpf);
                if ($user == null || !is_object($user)) {
                    MessageContainer::errorMessage("Não foi possível realizar esta operação", "../../../../public/styles/img/error.svg", "Você não pode realizar o cadastro porque você não é um funcionário dessa Unidade de Saúde");
                } else {
                    if ($password != $confirm_password) {
                        MessageContainer::errorMessage("Senhas diferentes", "../../../../public/styles/img/error.svg", "O campo SENHA está diferente do campo CONFIRMAR SENHA");
                    } else {
                        $result = $user_controller->save($cpf, $username, $password);

                        if ($result == null || !is_bool($result)) {
                            MessageContainer::errorMessage("Mensagem de Erro", "../../../../public/styles/img/error.svg", $result);
                        } else {
                            MessageContainer::successMessage("Senhas diferentes", "../../../../public/styles/img/success.svg", "O cadastro foi realizado com sucesso! Você já pode acessar a plataforma.");
            ?>

                            <a href="./login_page.html" class="primary-button">
                                Entrar na Plataforma
                            </a>
            <?php
                        }
                    }
                }
            } else {
                MessageContainer::errorMessage("Não foi possível realizar esta operação", "../../../../public/styles/img/error.svg", "Você precisa preencher todos os campos parar cadastrar o usuário na plataforma!");
            }
            ?>
        </section>
    </main>
    <footer>
        <p>2021 - Unidade de Saúde</p>
    </footer>
</body>

</html>