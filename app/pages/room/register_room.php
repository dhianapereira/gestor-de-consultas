<html>

<head>
    <title>Unidade de Saúde | Cadastro</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../../../public/styles/img/doctors-list.svg" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/main.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/home.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/card.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/modal.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/buttons.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/form.css" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap" rel="stylesheet" />
</head>

<body>
    <?php
    include_once('../../utils/autoload.php');
    include_once('../../utils/pagination.php');

    spl_autoload_register("autoload");
    spl_autoload_register("pagination");

    use app\controllers\RoomController;
    use app\components\MessageContainer;
    use app\components\Modal;
    ?>
    <header>
        <h3 class="logo">Unidade de Saúde</h3>
    </header>
    <main class="container">
        <section class="quick-access">
            <a href="#" onclick="Modal.open()" class="home-button">
                <h3>
                    <p>Cadastrar Sala</p>
                    <img src="../../../public/styles/img/hospital-icon.svg" alt="Imagem de cadastro de uma sala" />
                </h3>
            </a>
            <a href="./list_page.php" class="home-button">
                <h3>
                    <p>Listar Salas</p>
                    <img src="../../../public/styles/img/list.svg" alt="Imagem de lista de salas" />
                </h3>
            </a>
            <a href="./search_room.html" class="home-button">
                <h3>
                    <p>Procurar Sala</p>
                    <img src="../../../public/styles/img/search.svg" alt="Imagem de pesquisa" />
                </h3>
            </a> <a href="../home_page.php" class="home-button">
                <h3>
                    <p>Home</p>
                    <img src="../../../public/styles/img/home.svg" alt="Imagem de Home" />
                </h3>
            </a>
        </section>
        <section class="box">
            <?php
            $room_controller = new RoomController();

            $type = $_POST["type"];
            if (!isset($type)) {
                MessageContainer::errorMessage("Não foi possível realizar esta operação", "../../../public/styles/img/error.svg", "Você precisa preencher todos os campos para realizar esta operação!");
            } else {

                $result = $room_controller->register($type);

                if (!is_bool($result)) {
                    MessageContainer::errorMessage("Mensagem de Erro", "../../../public/styles/img/error.svg", $result);
                } else {
                    MessageContainer::successMessage("Operação realizada", "../../../public/styles/img/success.svg", "O cadastro da sala foi realizado com sucesso!");
                }
            }
            ?>
        </section>
    </main>
    <?php
    Modal::registerRoom("#");
    ?>
    <footer>
        <p>2021 - Unidade de Saúde</p>
    </footer>
    <script src="../../../public/scripts/modal.js"></script>
</body>

</html>