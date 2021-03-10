<?php
if (!isset($_SESSION["loggedUser"])) {
    header("Location: ./");
}

require_once "app/utils/pagination.php";
require_once "app/controllers/MedicalAppointmentController.php";
require_once "app/components/MessageContainer.php";
require_once "app/components/Base.php";
?>
<html>

<head>
    <?php Base::head("Consulta | Unidade de Saúde"); ?>
    <link rel="stylesheet" type="text/css" href="./public/styles/css/table.css" />
</head>

<body>
    <?php Base::header(); ?>
    <main class="container">
        <section class="quick-access">
            <a href="?page=medical_appointment/register" class="home-button">
                <h3>
                    <p>Marcar Consulta</p>
                    <img src="./public/styles/img/make-an-appointment.svg" alt="Imagem de marcar consulta" />
                </h3>
            </a>
            <a href="?page=medical_appointment/search" class="home-button">
                <h3>
                    <p>Procurar Consulta</p>
                    <img src="./public/styles/img/update-medical-appointment.svg" alt="Imagem de pesquisa" />
                </h3>
            </a> <a href="?page=medical_appointment/reports" class="home-button">
                <h3>
                    <p>Registros</p>
                    <img src="./public/styles/img/questionnaire.svg" alt="Imagem de questionário" />
                </h3>
            </a><a href="?page=home" class="home-button">
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

            $result = MedicalAppointmentController::allMedicalAppointments($start, $total_records);

            if ($result != null && !is_string($result)) {
                $medical_appointment_list = $result[1];
                if ($medical_appointment_list != null && is_array($medical_appointment_list)) {
            ?>
                    <div class="table">

                        <h2>Lista de Atendimento</h2>
                        <table>
                            <tr>
                                <th>ID</th>
                                <th>Paciente</th>
                                <th>Médico(a)</th>
                                <th>Sala</th>
                                <th>Data e Horário</th>
                                <th>Horário de chegada</th>
                                <th>Consulta Realizada?</th>
                            </tr>
                            <?php
                            foreach ($medical_appointment_list as $medical_appointment) {
                            ?>
                                <tr>
                                    <td><?php echo ($medical_appointment->getId()); ?></td>
                                    <td><?php echo ($medical_appointment->getPatientCpf()); ?></td>
                                    <td><?php echo ($medical_appointment->getIdDoctor()); ?></td>
                                    <td><?php echo ("id: " . $medical_appointment->getIdRoom()[0] . " " . $medical_appointment->getIdRoom()[1]); ?></td>
                                    <td><?php echo ($medical_appointment->getDate() . " às " . $medical_appointment->getTime()); ?></td>
                                    <td><?php echo ($medical_appointment->getArrivalTime()); ?></td>
                                    <td><?php echo ($medical_appointment->getStatus()); ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </div>
                <?php
                } else {
                    MessageContainer::errorMessage("A lista de atendimento está vazia", "Não há mais registros de consulta.");
                }
                ?>
                <div class="input-block actions">
                    <?php
                    $total = $result[0];
                    $position = $pagination[2];

                    printTheButtons($total, $total_records, $position, "medical_appointment/menu");
                    ?>
                </div>
            <?php
            } else {
                MessageContainer::errorMessage("A lista de atendimento está vazia",  "Ainda não há nenhuma consulta marcada.");
            }
            ?>
        </section>
    </main>
    <?php Base::footer(); ?>
</body>

</html>