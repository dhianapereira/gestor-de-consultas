<?php
if (!isset($_SESSION["loggedUser"])) {
    header("Location: ./");
}
?>
<html>

<head>
    <title>Unidade de Saúde | Marcar Consulta</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="./public/styles/img/doctors-list.svg" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="./public/styles/css/main.css" />
    <link rel="stylesheet" type="text/css" href="./public/styles/css/home.css" />
    <link rel="stylesheet" type="text/css" href="./public/styles/css/buttons.css" />
    <link rel="stylesheet" type="text/css" href="./public/styles/css/select.css" />
    <link rel="stylesheet" type="text/css" href="./public/styles/css/form.css" />
    <link rel="stylesheet" type="text/css" href="./public/styles/css/card.css" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap" rel="stylesheet" />
</head>

<body>
    <script src="./public/scripts/toggle.js"></script>

    <header>
        <h3 class="logo">Unidade de Saúde</h3>
    </header>
    <main class="container">
        <?php
        require_once "app/controllers/DoctorController.php";
        require_once "app/controllers/RoomController.php";
        ?>
        <section class="quick-access">
            <a href="?page=medical_appointment/list" class="home-button">
                <h3>
                    <p>Lista de Atendimento</p>
                    <img src="./public/styles/img/medical-appointments-list.svg" alt="Imagem de lista de atendimento" />
                </h3>
            </a>
            <a href="?page=medical_appointment/search" class="home-button">
                <h3>
                    <p>Procurar Consulta</p>
                    <img src="./public/styles/img/update-medical-appointment.svg" alt="Imagem de pesquisa" />
                </h3>
            </a> <a href="?page=home" class="home-button">
                <h3>
                    <p>Home</p>
                    <img src="./public/styles/img/home.svg" alt="Imagem de Home" />
                </h3>
            </a>
        </section>
        <?php
        require_once "app/components/MessageContainer.php";

        if (isset($_SESSION["errorMessage"])) {
            MessageContainer::errorMessage("Mensagem de Erro", $_SESSION["errorMessage"]);
            $_SESSION["errorMessage"] = null;
        } else if (isset($_SESSION["successMessage"])) {
            MessageContainer::successMessage("Operação realizada", $_SESSION["successMessage"]);
            $_SESSION["successMessage"] = null;
        }
        ?>
        <section class="box">
            <div class="form">
                <h2>Marcar Consulta</h2>
                <form method="POST" action="?class=MedicalAppointment&action=makeAnAppointment">
                    <div class="input-block">
                        <label for="patient_cpf">Paciente</label>
                        <input id="patient_cpf" placeholder="Insira o CPF" name="patient_cpf" required />
                    </div>

                    <h2>Escolher Médico(a)</h2>
                    <div class="input-block">
                        <label for="genre">Gênero</label>
                        <input type="hidden" name="genre" id="genre" value="Feminino" required />

                        <div class="button-select">
                            <button data-value="Feminino" onclick="toggleGenre(event)" type="button" class="active-genre">
                                Feminino
                            </button>
                            <button data-value="Masculino" onclick="toggleGenre(event)" type="button">
                                Masculino
                            </button>
                        </div>
                    </div>


                    <div class="custom-select">
                        <select id="specialty" name="specialty" required>
                            <option disabled selected>Selecione a especialidade: </option>
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


                    <h2>Escolher Sala</h2>
                    <div class="custom-select">
                        <select id="room" name="room" required>
                            <option disabled selected>Selecione a sala: </option>
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

                    <script src="./public/scripts/selection_box.js"></script>
                    <br />
                    <span class="line">
                        <span class="input-block">
                            <label for="date" class="sr-only">Data</label>
                            <input type="date" id="date" name="date" required />
                        </span>
                        <span class="input-block">
                            <label for="time" class="sr-only">Horário</label>
                            <input type="time" id="time" name="time" required />
                        </span>
                    </span>

                    <button type="submit" class="primary-button">Confirmar</button>
                </form>
            </div>
        </section>

    </main>
    <footer>
        <p>2021 - Unidade de Saúde</p>
    </footer>
</body>

</html>