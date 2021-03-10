<?php
if (!isset($_SESSION["loggedUser"])) {
    header("Location: ./");
}

require_once "app/controllers/MedicalAppointmentController.php";
require_once "app/controllers/DoctorController.php";
require_once "app/controllers/RoomController.php";
require_once "app/components/MessageContainer.php";
require_once "app/components/Base.php";

?>
<html>

<head>
    <?php Base::head("Dados da Consulta | Unidade de Saúde") ?>
    <link rel="stylesheet" type="text/css" href="./public/styles/css/select.css" />
    <link rel="stylesheet" type="text/css" href="./public/styles/css/form.css" />
</head>

<script src="./public/scripts/toggle.js"></script>

<body>
    <?php Base::header(); ?>
    <main class="container">
        <section class="quick-access">
            <a href="?page=medical_appointment/search" class="home-button">
                <h3>
                    <p>Procurar Consulta</p>
                    <img src="./public/styles/img/update-medical-appointment.svg" alt="Imagem de pesquisa" />
                </h3>
            </a> <a href="?page=medical_appointment/register" class="home-button">
                <h3>
                    <p>Marcar Consulta</p>
                    <img src="./public/styles/img/make-an-appointment.svg" alt="Imagem de marcar consulta" />
                </h3>
            </a><a href="?page=medical_appointment/list" class="home-button">
                <h3>
                    <p>Lista de Atendimento</p>
                    <img src="./public/styles/img/medical-appointments-list.svg" alt="Imagem de lista de atendimento" />
                </h3>
            </a><a href="?page=medical_appointment/reports" class="home-button">
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
                    <h2>Dados da Consulta</h2>
                    <form method="POST" action="?class=MedicalAppointment&action=update">
                        <div class="input-block">
                            <label for="id">ID</label>
                            <input id="id" value="<?php echo ($medical_appointment->getId()) ?>" disabled />
                            <input type="hidden" name="id" value="<?php echo ($medical_appointment->getId()) ?>" required />
                        </div>
                        <div class="input-block">
                            <label for="patient_cpf">Paciente</label>
                            <input id="patient_cpf" name="patient_cpf" value="<?php echo ($medical_appointment->getPatientCpf()) ?>" required />
                        </div>
                        <div class="input-block">
                            <label for="doctor">Médico(a)</label>
                            <input id="doctor" value="<?php echo ($medical_appointment->getIdDoctor()[0]) ?>" disabled />
                        </div>
                        <div class="input-block">
                            <label for="genre">Gênero</label>
                            <input type="hidden" name="genre" id="genre" value="<?php echo ($medical_appointment->getIdDoctor()[2]) ?>" required />

                            <div class="button-select">
                                <button data-value="Feminino" onclick="toggle(event, 'active-genre', 'genre')" type="button" <?php
                                                                                                                                if ($medical_appointment->getIdDoctor()[2] == "Feminino") {
                                                                                                                                ?> class="active-genre" <?php
                                                                                                                                                    }
                                                                                                                                                        ?>>
                                    Feminino
                                </button>
                                <button data-value="Masculino" onclick="toggle(event, 'active-genre', 'genre')" type="button" <?php
                                                                                                                                if ($medical_appointment->getIdDoctor()[2] == "Masculino") {
                                                                                                                                ?> class="active-genre" <?php
                                                                                                                                                    }
                                                                                                                                                        ?>>
                                    Masculino
                                </button>
                            </div>
                        </div>
                        <div class="custom-select">
                            <select id="specialty" name="specialty" required>
                                <option value="<?php echo ($medical_appointment->getIdDoctor()[1]); ?>" selected><?php echo ($medical_appointment->getIdDoctor()[1]); ?></option>
                                <?php
                                $list_of_specialties = DoctorController::listOfSpecialties();

                                foreach ($list_of_specialties as $specialty) {
                                ?>
                                    <option value="<?php echo ($specialty['specialty']); ?>"><?php echo ($specialty['specialty']); ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>


                        <h2>Sala</h2>
                        <div class="custom-select">
                            <select id="room" name="room" required>
                                <option value="<?php echo ($medical_appointment->getIdRoom()[0]); ?>" selected><?php echo ("id: " . $medical_appointment->getIdRoom()[0] . " - " . $medical_appointment->getIdRoom()[1]); ?></option>
                                <?php
                                $list_of_types = RoomController::listOfTypes();

                                foreach ($list_of_types as $type) {
                                ?>
                                    <option value="<?php echo ($type['id']); ?>"><?php echo ("id: " . $type['id'] . " - " . $type['type']); ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <br>
                        <br>
                        <span class="line">
                            <span class="input-block">
                                <label for="date" class="sr-only">Data</label>
                                <input type="date" id="date" name="date" value="<?php echo ($medical_appointment->getDate()) ?>" required />
                            </span>
                            <span class="input-block">
                                <label for="time" class="sr-only">Horário</label>
                                <input type="time" id="time" name="time" value="<?php echo ($medical_appointment->getTime()) ?>" required />
                            </span>
                        </span>
                        <br>
                        <br>
                        <div class="input-block">
                            <label for="arrival_time">Horário de Chegada: </label>
                            <input type="time" id="arrival_time" name="arrival_time" value="<?php echo ($medical_appointment->getArrivalTime()) ?>" required />
                        </div>
                        <div class="custom-select">
                            <select id="status" name="status" required>
                                <option value="<?php echo ($medical_appointment->getStatus()); ?>" selected><?php echo ($medical_appointment->getStatus()); ?></option>
                                <?php
                                require_once "app/utils/constants.php";

                                foreach ($allStatus as $status) {
                                ?>
                                    <option value="<?php echo ($status); ?>"><?php echo ($status); ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <script src="./public/scripts/selection_box.js"></script>

                        <button type="submit" class="primary-button">Salvar Alterações</button>
                    </form>
                </div>

            </section>
        <?php
        } ?>

    </main>

    <?php Base::footer(); ?>

</body>

</html>