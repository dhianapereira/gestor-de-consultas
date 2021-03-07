<?php
if (!isset($_SESSION["loggedUser"])) {
    header("Location: ./");
}

require_once "app/utils/pagination.php";
require_once "app/controllers/PatientController.php";
require_once "app/components/MessageContainer.php";
require_once "app/components/Base.php";
?>
<html>

<head>
    <?php Base::head("Paciente | Unidade de Saúde"); ?>
    <link rel="stylesheet" type="text/css" href="./public/styles/css/table.css" />
</head>

<body>
    <?php Base::header(); ?>
    <main class="container">
        <section class="quick-access">
            <a href="?page=patient/register" class="home-button">
                <h3>
                    <p>Cadastrar Paciente</p>
                    <img src="./public/styles/img/plus.svg" alt="Imagem de adicionar" />
                </h3>
            </a>
            <a href="?page=patient/search" class="home-button">
                <h3>
                    <p>Procurar Paciente</p>
                    <img src="./public/styles/img/update-patient.svg" alt="Imagem de paciente" />
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

            $result = PatientController::allPatients($start, $total_records);

            if ($result != null && !is_string($result)) {
                $patient_list = $result[1];
                if ($patient_list != null && is_array($patient_list)) {
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
                <?php
                } else {
                    MessageContainer::errorMessage("A lista de pacientes está vazia", "Não há mais nenhum paciente cadastrado.");
                } ?>
                <div class="input-block actions">
                    <?php
                    $total = $result[0];
                    $position = $pagination[2];

                    printTheButtons($total, $total_records, $position, "patient/menu");
                    ?>
                </div>
            <?php
            } else {
                MessageContainer::errorMessage("A lista de pacientes está vazia", "Ainda não há nenhum paciente cadastrado.");
            }
            ?>
        </section>
    </main>
    <?php Base::footer(); ?>
</body>

</html>