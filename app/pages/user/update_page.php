<html>

<head>
    <title>Unidade de Saúde | Dados do Funcionário</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../../../public/styles/img/doctors-list.svg" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/main.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/home.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/buttons.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/form.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/card.css" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap" rel="stylesheet" />
</head>
<script src="../../../public/scripts/script.js"></script>

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
            </a> <a href="#" class="home-button">
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
            <div class="form">
                <?php
                include_once('../../utils/autoload.php');

                spl_autoload_register("autoload");

                use app\controllers\UserController;

                $user_controller = new UserController();

                $cpf = $_POST["cpf"];

                if (isset($cpf)) {
                    $user = $user_controller->fetchUser($cpf);
                    if ($user == null || !is_object($user)) {

                ?>
                        <div class="card">
                            <h3>
                                <span>Mensagem de Erro</span>
                                <img src="../../../public/styles/img/error.svg" alt="Imagem de mensagem de erro">
                            </h3>
                            <p>Nenhum Funcionário com o CPF: <?php echo "$cpf" ?> </p>
                        </div>
                    <?php
                    } else {
                    ?>
                        <h2>Dados do Funcionário</h2>
                        <form method="POST" action="update_user.php">
                            <div class="input-block">
                                <label for="cpf">CPF</label>
                                <input id="cpf" value="<?php echo ($user->getCpf()) ?>" disabled />
                                <input type="hidden" name="cpf" value="<?php echo ($user->getCpf()) ?>" required />
                            </div>
                            <div class="input-block">
                                <label for="name">Nome</label>
                                <input id="name" name="name" value="<?php echo ($user->getName()) ?>" required />
                            </div>
                            <div class="input-block">
                                <label for="date_of_birth">Data de Nascimento</label>
                                <input id="date_of_birth" type="date" name="date_of_birth" value="<?php echo ($user->getDateOfBirth()) ?>" required />
                            </div>

                            <div class="input-block">
                                <label for="genre">Gênero</label>
                                <input type="hidden" name="genre" id="genre" value="<?php echo ($user->getGenre()) ?>" required />

                                <div class="button-select">
                                    <button data-value="Feminino" onclick="toggleGenre(event)" type="button" <?php
                                                                                                                if ($user->getGenre() == "Feminino") {
                                                                                                                ?> class="active-genre" <?php
                                                                                                                                    }
                                                                                                                                        ?>>
                                        Feminino
                                    </button>
                                    <button data-value="Masculino" onclick="toggleGenre(event)" type="button" <?php
                                                                                                                if ($user->getGenre() == "Masculino") {
                                                                                                                ?> class="active-genre" <?php
                                                                                                                                    }
                                                                                                                                        ?>>
                                        Masculino
                                    </button>
                                </div>
                            </div>

                            <div class="input-block">
                                <label for="naturalness">Naturalidade</label>
                                <input type="hidden" name="naturalness" id="naturalness" value="<?php echo ($user->getNaturalness()) ?>" required />

                                <div class="button-select">
                                    <button data-value="Brasileiro" onclick="toggleNaturalness(event)" type="button" <?php
                                                                                                                        if ($user->getNaturalness() == "Brasileiro(a)") {
                                                                                                                        ?> class="active-naturalness" <?php
                                                                                                                                                    }
                                                                                                                                                        ?>>
                                        Brasileiro(a)
                                    </button>
                                    <button data-value="Estrangeiro" onclick="toggleNaturalness(event)" type="button" <?php
                                                                                                                        if ($user->getNaturalness() == "Estrangeiro(a)") {
                                                                                                                        ?> class="active-naturalness" <?php
                                                                                                                                                    }
                                                                                                                                                        ?>>
                                        Estrangeiro(a)
                                    </button>
                                </div>
                            </div>

                            <div class="input-block">
                                <label for="address"> Endereço </label>
                                <input id="address" name="address" value="<?php echo ($user->getAddress()) ?>" required />
                            </div>


                            <div class="input-block">
                                <label for="responsibility"> Cargo </label>
                                <input id="responsibility" name="responsibility" value="<?php echo ($user->getResponsibility()) ?>" required />
                            </div>


                            <div class="input-block">
                                <label for="active">Status</label>
                                <input type="hidden" name="active" id="active" value="<?php echo ($user->getActive()) ?>" required />

                                <div class="button-select">
                                    <button data-value=1 onclick="toggleActive(event)" type="button" <?php
                                                                                                        if ($user->getActive() == 1) {
                                                                                                        ?> class="active" <?php
                                                                                                                        }
                                                                                                                            ?>>
                                        Ativo
                                    </button>
                                    <button data-value=0 onclick="toggleActive(event)" type="button" <?php
                                                                                                        if ($user->getActive() == 0) {
                                                                                                        ?> class="active" <?php
                                                                                                                        }
                                                                                                                            ?>>
                                        Inativo
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
                            <span>Mensagem de Erro</span>
                            <img src="../../../public/styles/img/error.svg" alt="Imagem de mensagem de erro">
                        </h3>
                        <p>Você precisa inserir um CPF!</p>
                    </div>
                <?php
                }
                ?>
            </div>

        </section>
    </main>
    <footer>
        <p>2021 - Unidade de Saúde</p>
    </footer>

</body>

</html>