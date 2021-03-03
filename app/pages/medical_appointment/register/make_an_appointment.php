<html>

<head>
    <title>Unidade de Saúde | Marcar consulta</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../../../public/styles/img/doctors-list.svg" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/main.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/card.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/home.css" />
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
            <?php
            include_once('../../utils/autoload.php');

            spl_autoload_register("autoload");

            use app\controllers\MedicalAppointmentController;
            use app\components\MessageContainer;

            $medical_appointment_controller = new MedicalAppointmentController();

            $patient_cpf = $_POST["patient_cpf"];
            $specialty = $_POST["specialty"];
            $genre = $_POST["genre"];
            $date = $_POST["date"];
            $time = $_POST["time"];
            $room = $_POST["room"];

            if (
                !isset($specialty) || !isset($patient_cpf) || !isset($genre)
                || !isset($date) || !isset($time) || !isset($room)
            ) {
                MessageContainer::errorMessage("Não foi possível realizar esta operação", "../../../public/styles/img/error.svg", "Você precisa preencher todos os campos para realizar esta operação!");
            } else {

                $result = $medical_appointment_controller->makeAnAppointment(
                    $patient_cpf,
                    $genre,
                    $specialty,
                    $date,
                    $time,
                    $room
                );

                if (!is_bool($result)) {
                    MessageContainer::errorMessage("Mensagem de Erro", "../../../public/styles/img/error.svg",  $result);
                } else {
                    MessageContainer::successMessage("Operação realizada", "../../../public/styles/img/success.svg", "A consulta foi marcada com sucesso!");
                }
            }
            ?>
        </section>
    </main>

    <footer>
        <p>2021 - Unidade de Saúde</p>
    </footer>
</body>

</html>