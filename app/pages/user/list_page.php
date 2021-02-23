<html>

<head>
    <title>Unidade de Saúde | Lista de Funcionários</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../../../public/styles/img/doctors-list.svg" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/main.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/card.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/home.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/table.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/buttons.css" />
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
                    <p>Cadastrar Funcionário</p>
                    <img src="../../../public/styles/img/plus.svg" alt="Imagem de adicionar" />
                </h3>
            </a>
            <a href="./search_user.html" class="home-button">
                <h3>
                    <p>Procurar Funcionário</p>
                    <img src="../../../public/styles/img/update-patient.svg" alt="Imagem de funcionário" />
                </h3>
            </a>
            <a href="../home_page.php" class="home-button">
                <h3>
                    <p>Home</p>
                    <img src="../../../public/styles/img/home.svg" alt="Imagem de Home" />
                </h3>
            </a>
        </section>
        <section>
            <?php
            include_once('../../utils/autoload.php');
            include_once('../../utils/pagination.php');

            spl_autoload_register("autoload");
            spl_autoload_register("pagination");

            use app\controllers\UserController;
            use app\components\MessageContainer;

            $user_controller = new UserController();

            if (!isset($_GET['page'])) {
                $_GET['page'] = "1";
            }

            $pagination = pagination($_GET['page'], "2");


            $result = $user_controller->allUsers($pagination[0], $pagination[1]);

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
                    MessageContainer::errorMessage("A lista de funcionários está vazia", "../../../public/styles/img/error.svg", "Não há mais nenhum funcionário cadastrado.");
                }
                ?>
                <div class="input-block actions">
                    <?php
                    $total = $result[0];
                    $total_records = $pagination[1];
                    $position = $pagination[2];

                    printTheButtons($total, $total_records, $position);
                    ?>
                </div>
            <?php
            } else {
                MessageContainer::errorMessage("A lista de funcionários está vazia", "../../../public/styles/img/error.svg", "Ainda não há nenhum funcionário cadastrado.");
            }
            ?>
        </section>
    </main>

    <footer>
        <p>2021 - Unidade de Saúde</p>
    </footer>
</body>

</html>