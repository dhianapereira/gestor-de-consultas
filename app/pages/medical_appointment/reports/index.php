<?php
if (!isset($_SESSION["loggedUser"])) {
    header("Location: ./");
}

require_once "app/components/MessageContainer.php";
?>
<html>

<head>
    <title>Unidade de Saúde | Sintomas</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width initial-scale=1.0" />
    <link rel="shortcut icon" href="./public/styles/img/doctors-list.svg" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="./public/styles/css/main.css" />
    <link rel="stylesheet" type="text/css" href="./public/styles/css/form.css" />
    <link rel="stylesheet" type="text/css" href="./public/styles/css/buttons.css" />
    <link rel="stylesheet" type="text/css" href="./public/styles/css/home.css" />
    <link rel="stylesheet" type="text/css" href="./public/styles/css/select.css" />
    <link rel="stylesheet" type="text/css" href="./public/styles/css/card.css" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap" rel="stylesheet" />
</head>

<body>
    <header>
        <h3 class="logo">Unidade de Saúde</h3>
    </header>
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
            </a>
            <a href="?page=medical_appointment/list" class="home-button">
                <h3>
                    <p>Lista de Atendimento</p>
                    <img src="./public/styles/img/medical-appointments-list.svg" alt="Imagem de lista de atendimento" />
                </h3>
            </a>
            <?php
            if (isset($_SESSION['errorMessage'])) {
            ?>
                <a href="?page=medical_appointment/reports" class="home-button">
                    <h3>
                        <p>Registros</p>
                        <img src="./public/styles/img/questionnaire.svg" alt="Imagem de questionário" />
                    </h3>
                </a>
            <?php
            }
            ?>
            <a href="?page=home" class="home-button">
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
        } else {
        ?>
            <section class="box">
                <div class="form">
                    <h2>Pesquisa por Mês</h2>
                    <form method="POST" action="?class=MedicalAppointment&action=listOfReportsByMonth">
                        <?php
                        require_once "app/utils/constants.php";
                        require_once "app/components/SelectionBox.php";

                        SelectionBox::months($months);

                        ?>

                        <button type="submit" class="primary-button">Confirmar</button>
                    </form>
                </div>
            </section>
        <?php
        }
        ?>
    </main>
    <footer>
        <p>2021 - Unidade de Saúde</p>
    </footer>
</body>

</html>