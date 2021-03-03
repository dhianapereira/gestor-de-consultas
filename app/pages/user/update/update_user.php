<html>

<head>
    <title>Unidade de Saúde | Atualização</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../../../public/styles/img/doctors-list.svg" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/main.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/buttons.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/form.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/card.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/home.css" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap" rel="stylesheet" />
</head>

<body>
    <header>
        <h3 class="logo">Unidade de Saúde</h3>
    </header>
    <main class="container">
        <section class="quick-access">
            <a href="./search_user.html" class="home-button">
                <h3>
                    <p>Procurar Funcionário(a)</p>
                    <img src="../../../public/styles/img/update-patient.svg" alt="Imagem de pesquisa">
                </h3>
            </a> <a href="./register_page.html" class="home-button">
                <h3>
                    <p>Cadastrar Funcionário(a)</p>
                    <img src="../../../public/styles/img/plus.svg" alt="Imagem de adicionar" />
                </h3>
            </a>
            <a href="./list_page.php" class="home-button">
                <h3>
                    <p>Lista de Funcionários</p>
                    <img src="../../../public/styles/img/list.svg">
                </h3>
            </a>
            <a href="../home_page.php" class="home-button">
                <h3>
                    <p>Home</p>
                    <img src="../../../public/styles/img/home.svg" alt="Imagem de Home" />
                </h3>
            </a>
        </section>
        <section class="box">
            <?php
            include_once('../../utils/autoload.php');

            spl_autoload_register("autoload");

            use app\controllers\UserController;
            use app\models\User;
            use app\components\MessageContainer;

            $user_controller = new UserController();
            $cpf = $_POST["cpf"];
            $name = $_POST["name"];
            $date_of_birth = $_POST["date_of_birth"];
            $genre = $_POST["genre"];
            $naturalness = $_POST["naturalness"];
            $address = $_POST["address"];
            $responsibility = $_POST["responsibility"];
            $active = $_POST["active"];

            if (
                isset($cpf) && isset($name) && isset($genre) && isset($date_of_birth)
                && isset($responsibility) && isset($address)
                && isset($naturalness)  && isset($active)
            ) {
                $user = new User();
                $user->user(
                    $cpf,
                    $name,
                    $genre,
                    $date_of_birth,
                    $naturalness,
                    $address,
                    $responsibility,
                    $active
                );

                $result = $user_controller->update($user);

                if ($result == null || !is_bool($result)) {

                    MessageContainer::errorMessage("Mensagem de Erro", "../../../public/styles/img/error.svg",  $result);
                } else {
                    MessageContainer::successMessage("Operação realizada", "../../../public/styles/img/success.svg", "As atualizações foram realizadas com sucesso!");
                }
            } else {
                MessageContainer::errorMessage("Não foi possível realizar esta operação", "../../../public/styles/img/error.svg",  "Você precisa alterar alguma informação para que a operação seja realizada.");
            }

            ?>

        </section>
    </main>
    <footer>
        <p>2021 - Unidade de Saúde</p>
    </footer>
</body>

</html>