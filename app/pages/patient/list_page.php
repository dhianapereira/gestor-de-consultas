<html>

<head>
    <title>Unidade de Saúde | Lista de Pacientes</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../../../public/styles/img/doctors-list.svg" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/main.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/home.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/card.css" />
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
                    <p>Cadastrar Paciente</p>
                    <img src="../../../public/styles/img/plus.svg" alt="Imagem de adicionar" />
                </h3>
            </a>
            <a href="search_patient.html" class="home-button">
                <h3>
                    <p>Procurar Paciente</p>
                    <img src="../../../public/styles/img/update-patient.svg" alt="Imagem de paciente" />
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

            use app\controllers\PatientController;

            $patient_controller = new PatientController();

            if (!isset($_GET['page'])) {
                $_GET['page'] = "1";
            }

            $pagination = pagination($_GET['page'], "2");

            $result = $patient_controller->allPatients($pagination[0], $pagination[1]);

            if ($result != null && !is_string($result)) {
                $patient_list = $result[1];
            ?>
                <div class="table">

                    <h2>Lista de Pacientes</h2>
                    <table>
                        <tr>
                            <th>CPF</th>
                            <th>Nome Completo</th>
                            <th>Gênero</th>
                            <th>Data de nascimento</th>
                            <th>Nome da Mãe</th>
                            <th>Acompanhante</th>
                            <th>Endereço</th>
                            <th>Naturalidade</th>
                            <th>Status</th>
                        </tr>
                        <?php
                        foreach ($patient_list as $patient) {
                        ?>
                            <tr>
                                <td><?php echo ($patient->getCpf()); ?></td>
                                <td><?php echo ($patient->getName()); ?></td>
                                <td><?php echo ($patient->getGenre()); ?></td>
                                <td><?php echo ($patient->getDateOfBirth()); ?></td>
                                <td><?php echo ($patient->getMotherName()); ?></td>
                                <td><?php echo ($patient->getCompanion()); ?></td>
                                <td><?php echo ($patient->getAddress()); ?></td>
                                <td><?php echo ($patient->getNaturalness()); ?></td>
                                <td><?php echo ($patient->getActive()); ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
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
            ?>
                <div class="card">
                    <h3>
                        <span>A lista de pacientes está vazia</span>
                        <img src="../../../public/styles/img/error.svg" alt="Imagem de mensagem de erro">
                    </h3>
                    <p>Ainda não há nenhum paciente cadastrado.</p>
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