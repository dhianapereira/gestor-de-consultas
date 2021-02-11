<html>

<head>
    <title>Unidade de Saúde | Marcar Consulta</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../../../public/styles/img/doctors-list.svg" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/main.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/home.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/buttons.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/select.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/form.css" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap" rel="stylesheet" />
</head>

<body>
    <script src="../../../public/scripts/script.js"></script>

    <header>
        <h3 class="logo">Unidade de Saúde</h3>
    </header>
    <main class="container">
        <section class="quick-access">
            <a href="./list_page.php" class="home-button">
                <h3>
                    <p>Lista de Atendimento</p>
                    <img src="../../../public/styles/img/medical-appointments-list.svg" alt="Imagem de lista de atendimento" />
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
        <section class="box">
            <div class="form">
                <h2>Marcar Consulta</h2>
                <form method="POST" action="make_an_appointment.php">
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
                            include_once('../../utils/autoload.php');

                            spl_autoload_register("autoload");

                            use app\controllers\DoctorController;

                            $doctor_controller = new DoctorController();

                            $list_of_specialties = $doctor_controller->listOfSpecialties();

                            foreach ($list_of_specialties as $specialty) {
                            ?>
                                <option value="<?php echo ($specialty['specialty']); ?>"><?php echo ($specialty['specialty']); ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <script src="../../../public/scripts/selection_box.js"></script>
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