<html>

<head>
    <title>Unidade de Saúde | Cadastrar</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../../../public/styles/img/doctors-list.svg" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/main.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/home.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/card.css" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap" rel="stylesheet" />
</head>

<body>
    <header>
        <h1 class="logo">Unidade de Saúde</h1>
    </header>
    <main class="container">
        <section class="up">
            <?php
            include_once('../../utils/autoload.php');

            spl_autoload_register("autoload");

            use app\controllers\UserController;

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
            ?>
                    <div class="card">
                        <h3>
                            <span>Não foi possível realizar esta operação</span>
                            <img src="../../../public/styles/img/error.svg" alt="Imagem de mensagem de erro">
                        </h3>
                        <p>Você não pode realizar o cadastro porque você não é um funcionário dessa Unidade de Saúde</p>
                    </div>
                    <?php
                } else {
                    if ($password != $confirm_password) {
                    ?>
                        <div class="card">
                            <h3>
                                <span>Senhas diferentes</span>
                                <img src="../../../public/styles/img/error.svg" alt="Imagem de mensagem de erro">
                            </h3>
                            <p>O campo SENHA está diferente do campo CONFIRMAR SENHA</p>
                        </div>
                        <?php
                    } else {
                        $result = $user_controller->save($cpf, $username, $password);
                        
                        if ($result == null || !is_bool($result)) {
                        ?> <div class="card">
                                <h3>
                                    <span>Mensagem de Erro</span>
                                    <img src="../../../public/styles/img/error.svg" alt="Imagem de mensagem de erro">
                                </h3>
                                <p><?php echo "$result" ?></p>
                            </div>
                        <?php
                        } else {
                        ?> <div class="card">
                                <h3>
                                    <span>Operação realizada</span>
                                    <img src="../../../public/styles/img/success.svg" alt="Imagem de mensagem de sucesso">
                                </h3>
                                <p>As atualizações foram realizadas com sucesso! Você já pode acessar a plataforma</p>
                                <a href="./login_page.html" class="primary-button">
                                    Entrar
                                </a>
                            </div>
                <?php
                        }
                    }
                }
            } else {
                ?>
                <div class="card">
                    <h3>
                        <span>Não foi possível realizar esta operação</span>
                        <img src="../../../public/styles/img/error.svg" alt="Imagem de mensagem de erro">
                    </h3>
                    <p>Você precisa preencher todos os campos parar cadastrar o usuário na plataforma!</p>
                </div>
            <?php
            }
            ?>
        </section>
    </main>
    <footer>
        <p>2021 - Unidade de Saúde</p>
    </footer>
</body>

</html>