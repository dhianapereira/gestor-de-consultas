<?php
if (!isset($_SESSION["loggedUser"])) {
    header("Location: ./");
}
?>
<html>

<head>
    <title>Unidade de Saúde | Sala</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="./public/styles/img/doctors-list.svg" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="./public/styles/css/main.css" />
    <link rel="stylesheet" type="text/css" href="./public/styles/css/home.css" />
    <link rel="stylesheet" type="text/css" href="./public/styles/css/buttons.css" />
    <link rel="stylesheet" type="text/css" href="./public/styles/css/form.css" />
    <link rel="stylesheet" type="text/css" href="./public/styles/css/card.css" />
    <link rel="stylesheet" type="text/css" href="./public/styles/css/modal.css" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap" rel="stylesheet" />
</head>
<script src="./public/scripts/toggle.js"></script>

<body>
    <header>
        <h3 class="logo">Unidade de Saúde</h3>
    </header>
    <main class="container">
        <section class="quick-access">
            <a href="?page=room/search" class="home-button">
                <h3>
                    <p>Procurar Sala</p>
                    <img src="./public/styles/img/search.svg" alt="Imagem de pesquisa" />
                </h3>
            </a>
            <a href="#" onclick="Modal.open()" class="home-button">
                <h3>
                    <p>Cadastrar Sala</p>
                    <img src="./public/styles/img/hospital-icon.svg" alt="Imagem de cadastro de uma sala" />
                </h3>
            </a>
            <a href="?page=room/list" class="home-button">
                <h3>
                    <p>Listar Salas</p>
                    <img src="./public/styles/img/list.svg" alt="Imagem de lista de salas" />
                </h3>
            </a><a href="?page=home" class="home-button">
                <h3>
                    <p>Home</p>
                    <img src="./public/styles/img/home.svg" alt="Imagem de Home" />
                </h3>
            </a>
        </section>
        <?php
        require_once "app/components/MessageContainer.php";
        require_once "app/components/Modal.php";

        if (isset($_SESSION["errorMessage"])) {
            MessageContainer::errorMessage("Mensagem de Erro", $_SESSION["errorMessage"]);
            $_SESSION["errorMessage"] = null;
        } else if (isset($_SESSION["successMessage"])) {
            MessageContainer::successMessage("Operação realizada", $_SESSION["successMessage"]);
            $_SESSION["successMessage"] = null;
        } else {
        ?>
            <section class="box">
                <div class="form">
                    <h2>Sala</h2>
                    <form method="POST" action="?class=Room&action=update">
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
                </div>
            </section>
        <?php
        } ?>
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