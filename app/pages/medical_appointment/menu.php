<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Unidade de Saúde | Consulta</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../../../public/styles/img/doctors-list.svg" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/main.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/home.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/table.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/card.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/buttons.css" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap" rel="stylesheet" />
</head>

<body>
    <header>
        <h3 class="logo">Unidade de Saúde</h3>
    </header>
    <main class="container">
        <section class="quick-access">
            <a href="./consultation_page.php" class="home-button">
                <h3>
                    <p>Marcar Consulta</p>
                    <img src="../../../public/styles/img/make-an-appointment.svg" alt="Imagem de marcar consulta" />
                </h3>
            </a>
            <a href="./search_medical_appointment.html" class="home-button">
                <h3>
                    <p>Procurar Consulta</p>
                    <img src="../../../public/styles/img/update-medical-appointment.svg" alt="Imagem de pesquisa" />
                </h3>
            </a> <a href="../home_page.php" class="home-button">
                <h3>
                    <p>Home</p>
                    <img src="../../../public/styles/img/home.svg" alt="Imagem de Home" />
                </h3>
            </a>
        </section>
        <section class="table">
            <?php
            include_once('../../utils/autoload.php');
            include_once('../../utils/pagination.php');

            spl_autoload_register("autoload");
            spl_autoload_register("pagination");

            use app\controllers\MedicalAppointmentController;

            $medical_appointment_controller = new MedicalAppointmentController();

            if (!isset($_GET['page'])) {
                $_GET['page'] = "1";
            }

            $pagination = pagination($_GET['page']);

            $result =  $medical_appointment_controller->allMedicalAppointments($pagination[0], $pagination[1]);

            if ($result != null && !is_string($result)) {
                $medical_appointment_list = $result[1];
            ?>
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
                            <td><?php echo ($medical_appointment->getStatus()[1]); ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
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
                        <span>A lista de atendimento está vazia</span>
                        <img src="../../../public/styles/img/error.svg" alt="Imagem de mensagem de erro">
                    </h3>
                    <p>Ainda não há nenhuma consulta marcada.</p>
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