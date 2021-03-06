<?php
if (!isset($_SESSION["loggedUser"])) {
    header("Location: ./");
}

require_once "app/components/MessageContainer.php";
require_once "app/components/Base.php";
?>
<html>

<head>
    <?php Base::head("Dados do Funcionário | Unidade de Saúde"); ?>
    <link rel="stylesheet" type="text/css" href="./public/styles/css/form.css" />
</head>
<script src="./public/scripts/toggle.js"></script>

<body>

    <?php Base::header(); ?>

    <main class="container">
        <section class="quick-access">
            <a href="?page=user/search" class="home-button">
                <h3>
                    <p>Procurar Funcionário(a)</p>
                    <img src="./public/styles/img/update-patient.svg" alt="Imagem de pesquisa">
                </h3>
            </a> <a href="?page=user/search" class="home-button">
                <h3>
                    <p>Cadastrar Funcionário(a)</p>
                    <img src="./public/styles/img/plus.svg" alt="Imagem de adicionar" />
                </h3>
            </a>
            <a href="?page=user/list" class="home-button">
                <h3>
                    <p>Lista de Funcionários</p>
                    <img src="./public/styles/img/list.svg">
                </h3>
            </a>
            <a href="?page=home" class="home-button">
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
        } else {
        ?>
            <section class="box">
                <div class="form">
                    <h2>Dados do Funcionário</h2>
                    <form method="POST" action="?class=User&action=update">
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
                                <button data-value="Feminino" onclick="toggle(event, 'active-genre', 'genre')" type="button" <?php
                                                                                                                                if ($user->getGenre() == "Feminino") {
                                                                                                                                ?> class="active-genre" <?php
                                                                                                                                                    }
                                                                                                                                                        ?>>
                                    Feminino
                                </button>
                                <button data-value="Masculino" onclick="toggle(event, 'active-genre', 'genre')" type="button" <?php
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
                                <button data-value="Brasileiro(a)" onclick="toggle(event, 'active-naturalness', 'naturalness')" type="button" <?php
                                                                                                                                                if ($user->getNaturalness() == "Brasileiro(a)") {
                                                                                                                                                ?> class="active-naturalness" <?php
                                                                                                                                                                            }
                                                                                                                                                                                ?>>
                                    Brasileiro(a)
                                </button>
                                <button data-value="Estrangeiro(a)" onclick="toggle(event, 'active-naturalness', 'naturalness')" type="button" <?php
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
                                <button data-value=1 onclick="toggle(event, 'active', 'active')" type="button" <?php
                                                                                                                if ($user->getActive() == 1) {
                                                                                                                ?> class="active" <?php
                                                                                                                                }
                                                                                                                                    ?>>
                                    Ativo
                                </button>
                                <button data-value=0 onclick="toggle(event, 'active', 'active')" type="button" <?php
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
                </div>

            </section>
        <?php
        }
        ?>
    </main>
    <?php Base::footer(); ?>

</body>

</html>