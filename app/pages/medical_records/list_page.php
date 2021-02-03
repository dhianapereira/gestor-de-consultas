<html>

<head>
    <title>Unidade de Saúde | Lista de Prontuários</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../../../public/styles/img/doctors-list.svg" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/main.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/home.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/card.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/table.css" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap" rel="stylesheet" />
</head>

<body>
    <header>
        <h3 class="logo">Unidade de Saúde</h3>
    </header>
    <main class="container">
        <section class="quick-access">
            <a href="../symptom/questionnaire_page.html" class="home-button">
                <h3>
                    <p>Questionário (Dengue)</p>
                    <img src="../../../public/styles/img/questionnaire.svg" alt="Imagem de questionário" />
                </h3>
            </a>
            <a href="./search_medical_records.html" class="home-button">
                <h3>
                    <p>Procurar Prontuário</p>
                    <img src="../../../public/styles/img/file-search.png" alt="Imagem de prontuário" />
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

            use app\controllers\MedicalRecordsController;

            $medical_records_controller = new MedicalRecordsController();

            $medical_records_list = $medical_records_controller->allMedicalRecords();

            if ($medical_records_list != null && is_array($medical_records_list)) {
            ?>
                <h2>Lista de Prontuários</h2>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Paciente</th>
                        <th>Resultado (%)</th>
                        <th>Gravidade</th>
                        <th>Data de início dos sintomas</th>
                    </tr>
                    <?php
                    foreach ($medical_records_list as $medical_records) {
                    ?>
                        <tr>
                            <td><?php echo ($medical_records->getId()); ?></td>
                            <td><?php echo ($medical_records->getPatientCpf()); ?></td>
                            <td><?php echo ($medical_records->getResult()); ?></td>
                            <td><?php echo ($medical_records->getGravity()); ?></td>
                            <td><?php echo ($medical_records->getStartDate()); ?></td>

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
                        <span>A lista de prontuários está vazia</span>
                        <img src="../../../public/styles/img/error.svg" alt="Imagem de mensagem de erro">
                    </h3>
                    <p>Ainda não há nenhum prontuário no sistema.</p>
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