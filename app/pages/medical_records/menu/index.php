<?php
if (!isset($_SESSION["loggedUser"])) {
    header("Location: ./");
}
?>
<html>

<head>
    <title>Unidade de Saúde | Prontuários</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="./public/styles/img/doctors-list.svg" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="./public/styles/css/main.css" />
    <link rel="stylesheet" type="text/css" href="./public/styles/css/home.css" />
    <link rel="stylesheet" type="text/css" href="./public/styles/css/table.css" />
    <link rel="stylesheet" type="text/css" href="./public/styles/css/card.css" />
    <link rel="stylesheet" type="text/css" href="./public/styles/css/buttons.css" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap" rel="stylesheet" />
</head>

<body>
    <header>
        <h3 class="logo">Unidade de Saúde</h3>
    </header>
    <main class="container">
        <?php
        require_once "app/utils/pagination.php";
        require_once "app/controllers/MedicalRecordsController.php";
        require_once "app/components/MessageContainer.php";

        ?>
        <section class="quick-access">
            <a href="?page=symptom" class="home-button">
                <h3>
                    <p>Questionário (Dengue)</p>
                    <img src="./public/styles/img/questionnaire.svg" alt="Imagem de questionário" />
                </h3>
            </a>
            <a href="./search_medical_records.html" class="home-button">
                <h3>
                    <p>Procurar Prontuário</p>
                    <img src="./public/styles/img/file-search.png" alt="Imagem de prontuário" />
                </h3>
            </a>
            <a href="./search_by_month.php" class="home-button">
                <h3>
                    <p>Sintomas mais recorrentes</p>
                    <img src="./public/styles/img/search.svg" alt="Imagem da pesquisa por sintomas mais recorrentes" />
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

            $pagination = pagination($_GET['index'], "4");

            $start = $pagination[0];
            $total_records = $pagination[1];

            $result = MedicalRecordsController::allMedicalRecords($start, $total_records);

            if ($result != null && !is_string($result)) {
                $medical_records_list = $result[1];
                if ($medical_records_list != null && is_array($medical_records_list)) {
            ?>
                    <div class="table">
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
                    </div>
                <?php
                } else {
                    MessageContainer::errorMessage("A lista de prontuários está vazia", "Não há mais nenhum prontuário cadastrado.");
                } ?>
                <div class="input-block actions">
                    <?php
                    $total = $result[0];
                    $position = $pagination[2];

                    printTheButtons($total, $total_records, $position, "medical_records/menu");
                    ?>
                </div>
            <?php
            } else {
                MessageContainer::errorMessage("A lista de prontuários está vazia", "Ainda não há nenhum prontuário no sistema.");
            }
            ?>
        </section>
    </main>
    <footer>
        <p>2021 - Unidade de Saúde</p>
    </footer>
</body>

</html>