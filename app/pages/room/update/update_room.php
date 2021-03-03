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
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/modal.css" />
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
    use app\models\Room;
    use app\components\Modal;
    ?>
    <header>
        <h3 class="logo">Unidade de Saúde</h3>
    </header>
    <main class="container">
        <section class="quick-access">
            <a href="./search_room.html" class="home-button">
                <h3>
                    <p>Procurar Sala</p>
                    <img src="../../../public/styles/img/search.svg" alt="Imagem de pesquisa" />
                </h3>
            </a>
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
            </a><a href="../home_page.php" class="home-button">
                <h3>
                    <p>Home</p>
                    <img src="../../../public/styles/img/home.svg" alt="Imagem de Home" />
                </h3>
            </a>
        </section>
        <section class="box">
            <?php

            $room_controller = new RoomController();

            $id = $_POST["id"];
            $type = $_POST["type"];
            $status = $_POST["active"];

            if (isset($id) && isset($type) && isset($status)) {
                $room = new Room($id, $type, $status);

                $result = $room_controller->update($room);

                if ($result == null || !is_bool($result)) {
                    MessageContainer::errorMessage("Mensagem de Erro", "../../../public/styles/img/error.svg", $result);
                } else {
                    MessageContainer::successMessage("Operação realizada", "../../../public/styles/img/success.svg", "As atualizações foram realizadas com sucesso!");
                }
            } else {
                MessageContainer::errorMessage("Não foi possível realizar esta operação", "../../../public/styles/img/error.svg", "Você precisa alterar alguma informação para que a operação seja realizada.");
            }
            ?>
        </section>
    </main>
    <?php
    Modal::registerRoom("register_room.php");
    ?>
    <footer>
        <p>2021 - Unidade de Saúde</p>
    </footer>
    <script src="../../../public/scripts/modal.js"></script>
</body>

</html>