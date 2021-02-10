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
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap" rel="stylesheet" />
</head>

<body>
    <header>
        <h3 class="logo">Unidade de Saúde</h3>
    </header>
    <main class="container">
        <section class="quick-access">
            <a href="#" class="home-button">
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
        <section class="table">
            <?php
            include_once('../../utils/autoload.php');

            spl_autoload_register("autoload");

            use app\controllers\UserController;

            $user_controller = new UserController();

            $user_list = $user_controller->allUsers();

            if ($user_list != null && is_array($user_list)) {

            ?>
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
            <?php
            } else {
            ?>
                <div class="card">
                    <h3>
                        <span>A lista de funcionários está vazia</span>
                        <img src="../../../public/styles/img/error.svg" alt="Imagem de mensagem de erro">
                    </h3>
                    <p>Ainda não há nenhum funcionário cadastrado.</p>
                </div>
            <?php
            }
            ?>
        </section>
    </main>

    <footer>
        <p>2021 - Unidade de Saúde</p>
    </footer>
</body>

</html>