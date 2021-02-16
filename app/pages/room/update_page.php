<html>

<head>
    <title>Unidade de Saúde | Sala</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../../../public/styles/img/doctors-list.svg" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/main.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/home.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/buttons.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/form.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/card.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/modal.css" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap" rel="stylesheet" />
</head>
<script src="../../../public/scripts/script.js"></script>

<body>

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
            <div class="form">
                <?php
                include_once('../../utils/autoload.php');

                spl_autoload_register("autoload");

                use app\controllers\RoomController;

                $room_controller = new RoomController();

                $id = $_POST["id"];

                if (isset($id)) {
                    $room = $room_controller->fetchRoom($id);

                    if ($room == null || !is_object($room)) {
                ?>
                        <div class="card">
                            <h3>
                                <span>Mensagem de Erro</span>
                                <img src="../../../public/styles/img/error.svg" alt="Imagem de mensagem de erro">
                            </h3>
                            <p>Não há nenhuma sala com o ID: <?php echo "$id" ?> </p>
                        </div>
                    <?php
                    } else {
                    ?>
                        <h2>Sala</h2>
                        <form method="POST" action="update_room.php">
                            <div class="input-block">
                                <label for="id">ID</label>
                                <input id="id" value="<?php echo ($room->getId()) ?>" disabled />
                                <input type="hidden" name="id" value="<?php echo ($room->getId()) ?>" required />
                            </div>
                            <div class="input-block">
                                <label for="type">Tipo</label>
                                <input id="type" name="type" value="<?php echo ($room->getType()) ?>" required />
                            </div>
                            <div class="input-block">
                                <label for="active">Status</label>
                                <input type="hidden" name="active" id="active" value="<?php echo ($room->getStatus()) ?>" required />

                                <div class="button-select">
                                    <button data-value=1 onclick="toggleActive(event)" type="button" <?php
                                                                                                        if ($room->getStatus() == 1) {
                                                                                                        ?> class="active" <?php
                                                                                                                        }
                                                                                                                            ?>>
                                        Ocupada
                                    </button>
                                    <button data-value=0 onclick="toggleActive(event)" type="button" <?php
                                                                                                        if ($room->getStatus() == 0) {
                                                                                                        ?> class="active" <?php
                                                                                                                        }
                                                                                                                            ?>>
                                        Liberada
                                    </button>
                                </div>
                            </div>
                            <button type="submit" class="primary-button">Salvar Alterações</button>
                        </form>
                    <?php
                    }
                } else {
                    ?>
                    <div class="card">
                        <h3>
                            <span>Não foi possível realizar esta operação</span>
                            <img src="../../../public/styles/img/error.svg" alt="Imagem de mensagem de erro">
                        </h3>
                        <p>Você precisa inserir um ID!</p>
                    </div>
                <?php
                }
                ?>
            </div>
        </section>
    </main>
    <div class="modal-overlay">
        <div class="modal">
            <div class="form">
                <h2>Cadastrar nova sala</h2>
                <form method="POST" action="register_room.php">
                    <div class="input-block">
                        <label class="sr-only" for="type">Tipo de Sala</label>
                        <input id="type" name="type" placeholder="Sala de ..." required>
                    </div>
                    <div class="input-block actions">
                        <a href="#" onclick="Modal.close()" class="button-cancel">Cancelar</a>
                        <button type="submit" class="primary-button">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <footer>
        <p>2021 - Unidade de Saúde</p>
    </footer>
    <script src="../../../public/scripts/modal.js"></script>
</body>

</html>