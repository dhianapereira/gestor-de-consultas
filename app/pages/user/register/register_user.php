<html>

<head>
    <title>Unidade de Saúde | Cadastro</title>
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
        <h3 class="logo">Unidade de Saúde</h3>
    </header>
    <main class="container">
        <section class="quick-access">
            <a href="./register_page.html" class="home-button">
                <h3>
                    <p>Cadastrar Funcionário(a)</p>
                    <img src="../../../public/styles/img/plus.svg" alt="Imagem de adicionar" />
                </h3>
            </a>
            <a href="./search_user.html" class="home-button">
                <h3>
                    <p>Procurar Funcionário(a)</p>
                    <img src="../../../public/styles/img/update-patient.svg" alt="Imagem de pesquisa">
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
            use app\components\MessageContainer;

            $user_controller = new UserController();

            $cpf = $_POST["cpf"];
            $name = $_POST["name"];
            $genre = $_POST["genre"];
            $date_of_birth = $_POST["date_of_birth"];
            $address = $_POST["address"];
            $naturalness = $_POST["naturalness"];
            $responsibility = $_POST["responsibility"];


            if (
                !isset($cpf) || !isset($name)
                || !isset($genre) || !isset($date_of_birth)
                || !isset($responsibility)
                || !isset($address) || !isset($naturalness)
            ) {

                MessageContainer::errorMessage("Não foi possível realizar esta operação", "../../../public/styles/img/error.svg", "Você precisa preencher todos os campos para realizar esta operação!");
            } else {

                $result = $user_controller->register(
                    $cpf,
                    $name,
                    $genre,
                    $date_of_birth,
                    $naturalness,
                    $address,
                    $responsibility
                );

                if (!is_bool($result)) {
                    MessageContainer::errorMessage("Mensagem de Erro", "../../../public/styles/img/error.svg",  $result);
                } else {
                    MessageContainer::successMessage("Operação realizada", "../../../public/styles/img/success.svg", "O cadastro do funcionário(a) foi realizado com sucesso!");
                }
            }
            ?>
        </section>
    </main>

    <footer>
        <p>2021 - Unidade de Saúde</p>
    </footer>
</body>

</html>