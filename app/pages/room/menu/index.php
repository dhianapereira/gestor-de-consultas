<?php
if (!isset($_SESSION["loggedUser"])) {
    header("Location: ./");
}
?>
<html>

<head>
    <title>Unidade de Saúde | Salas</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="./public/styles/img/doctors-list.svg" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="./public/styles/css/main.css" />
    <link rel="stylesheet" type="text/css" href="./public/styles/css/home.css" />
    <link rel="stylesheet" type="text/css" href="./public/styles/css/table.css" />
    <link rel="stylesheet" type="text/css" href="./public/styles/css/card.css" />
    <link rel="stylesheet" type="text/css" href="./public/styles/css/modal.css" />
    <link rel="stylesheet" type="text/css" href="./public/styles/css/buttons.css" />
    <link rel="stylesheet" type="text/css" href="./public/styles/css/form.css" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap" rel="stylesheet" />
</head>

<body>
    <?php
    require_once "app/utils/pagination.php";
    require_once "app/components/Modal.php";
    require_once "app/controllers/RoomController.php";
    require_once "app/components/MessageContainer.php";
    ?>
    <header>
        <h3 class="logo">Unidade de Saúde</h3>
    </header>
    <main class="container">
        <section class="quick-access">
            <a href="#" onclick="Modal.open()" class="home-button">
                <h3>
                    <p>Cadastrar Sala</p>
                    <img src="./public/styles/img/hospital-icon.svg" alt="Imagem de cadastro de uma sala" />
                </h3>
            </a>
            <a href="?page=room/search" class="home-button">
                <h3>
                    <p>Procurar Sala</p>
                    <img src="./public/styles/img/search.svg" alt="Imagem de pesquisa" />
                </h3>
            </a> <a href="?page=home" class="home-button">
                <h3>
                    <p>Home</p>
                    <img src="./public/styles/img/home.svg" alt="Imagem de Home" />
                </h3>
            </a>
        </section>
        <?php
        if (isset($_SESSION["errorMessage"])) {
            MessageContainer::errorMessage("Mensagem de Erro", $_SESSION["errorMessage"]);
            $_SESSION["errorMessage"] = null;
        } else if (isset($_SESSION["successMessage"])) {
            MessageContainer::successMessage("Operação realizada", $_SESSION["successMessage"]);
            $_SESSION["successMessage"] = null;
        }
        ?>
        <section>
            <?php

            if (!isset($_GET['index'])) {
                $_GET['index'] = "1";
            }

            $pagination = pagination($_GET['index'], "4");

            $start = $pagination[0];
            $total_records = $pagination[1];

            $result = RoomController::allRooms($start, $total_records);

            if ($result != null && !is_string($result)) {
                $room_list = $result[1];
                if ($room_list != null && is_array($room_list)) {
            ?>
                    <div class="table">

                        <h2>Lista de Salas</h2>
                        <table>
                            <tr>
                                <th>ID</th>
                                <th>Tipo</th>
                                <th>Status</th>
                            </tr>
                            <?php
                            foreach ($room_list as $room) {
                            ?>
                                <tr>
                                    <td><?php echo ($room->getId()); ?></td>
                                    <td><?php echo ($room->getType()); ?></td>
                                    <td><?php echo ($room->getStatus()); ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </div>
                <?php
                } else {
                    MessageContainer::errorMessage("A lista de salas está vazia", "Não há mais nenhuma sala cadastrada.");
                } ?>
                <div class="input-block actions">
                    <?php
                    $total = $result[0];
                    $position = $pagination[2];

                    printTheButtons($total, $total_records, $position, "room/menu");
                    ?>
                </div>
            <?php
            } else {
                MessageContainer::errorMessage("A lista de salas está vazia", "Ainda não há nenhuma sala cadastrada.");
            }
            ?>
        </section>
    </main>
    <?php
    Modal::registerRoom("?class=Room&action=register");
    ?>
    <footer>
        <p>2021 - Unidade de Saúde</p>
    </footer>
    <script src="./public/scripts/modal.js"></script>
</body>

</html>