<?php
if (!isset($_SESSION["loggedUser"])) {
    header("Location: ./");
}

require_once "app/utils/pagination.php";
require_once "app/controllers/UserController.php";
require_once "app/components/MessageContainer.php";
require_once "app/components/Base.php";
?>
<html>

<head>
    <?php Base::head("Funcionários | Unidade de Saúde"); ?>
    <link rel="stylesheet" type="text/css" href="./public/styles/css/table.css" />
</head>

<body>
    <?php Base::header(); ?>
    <main class="container">
        <section class="quick-access">
            <a href="?page=user/register" class="home-button">
                <h3>
                    <p>Cadastrar Funcionário</p>
                    <img src="./public/styles/img/plus.svg" alt="Imagem de adicionar" />
                </h3>
            </a>
            <a href="?page=user/search" class="home-button">
                <h3>
                    <p>Procurar Funcionário</p>
                    <img src="./public/styles/img/update-patient.svg" alt="Imagem de funcionário" />
                </h3>
            </a>
            <a href="?page=home" class="home-button">
                <h3>
                    <p>Home</p>
                    <img src="./public/styles/img/home.svg" alt="Imagem de Home" />
                </h3>
            </a>
        </section>
        <section>
            <?php

            if (!isset($_GET['index'])) {
                $_GET['index'] = "1";
            }

            $pagination = pagination($_GET['index'], "2");

            $start = $pagination[0];
            $total_records = $pagination[1];

            $result = UserController::allUsers($start, $total_records);

            if ($result != null && !is_string($result)) {
                $user_list = $result[1];
                if ($user_list != null && is_array($user_list)) {
            ?>
                    <div class="table">
                        <h2>Lista de Funcionários</h2>
                        <table>
                            <tr>
                                <th>CPF</th>
                                <th>Nome</th>
                                <th>Gênero</th>
                                <th>Data de nascimento</th>
                                <th>Naturalidade</th>
                                <th>Endereço</th>
                                <th>Cargo</th>
                                <th>Status</th>
                            </tr>
                            <?php
                            foreach ($user_list as $user) {
                            ?>
                                <tr>
                                    <td><?php echo ($user->getCpf()); ?></td>
                                    <td><?php echo ($user->getName()); ?></td>
                                    <td><?php echo ($user->getGenre()); ?></td>
                                    <td><?php echo ($user->getDateOfBirth()); ?></td>
                                    <td><?php echo ($user->getNaturalness()); ?></td>
                                    <td><?php echo ($user->getAddress()); ?></td>
                                    <td><?php echo ($user->getResponsibility()); ?></td>
                                    <td><?php echo ($user->getActive()); ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </div>
                <?php
                } else {
                    MessageContainer::errorMessage("A lista de funcionários está vazia", "Não há mais nenhum funcionário cadastrado.");
                }
                ?>
                <div class="input-block actions">
                    <?php
                    $total = $result[0];
                    $position = $pagination[2];

                    printTheButtons($total, $total_records, $position, "user/menu");
                    ?>
                </div>
            <?php
            } else {
                MessageContainer::errorMessage("A lista de funcionários está vazia", "Ainda não há nenhum funcionário cadastrado.");
            }
            ?>
        </section>
    </main>
    <?php Base::footer(); ?>
</body>

</html>