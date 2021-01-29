<html>

<head>
    <title>Unidade de Saúde | Questionário</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../../../public/styles/img/doctors-list.svg" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/main.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/home.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/home.css" />
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
            <a href="./questionnaire_page.html" class="home-button">
                <h3>
                    <p>Questionário (Dengue)</p>
                    <img src="../../../public/styles/img/questionnaire.svg" alt="Imagem de questionário" />
                </h3>
            </a>
            <a href="../medical_records/search_medical_records.html" class="home-button">
                <h3>
                    <p>Procurar Prontuário</p>
                    <img src="../../../public/styles/img/file-search.png" alt="Imagem de prontuário" />
                </h3>
            </a>
            <a href="#" class="home-button">
                <h3>
                    <p>Listar Prontuários</p>
                    <img src="../../../public/styles/img/medical-records-list.svg" alt="Imagem de lista de prontuários" />
                </h3>
            </a>
            <a href="../home_page.php" class="home-button">
                <h3>
                    <p>Home</p>
                    <img src="../../../public/styles/img/home.svg" alt="Imagem de Home" />
                </h3>
            </a>
        </section>
        <section class="box">
            <?php
            include_once('../../utils/autoload.php');

            use app\controllers\SymptomController;
            use app\controllers\PatientController;

            $patient_controller = new PatientController();
            $symptom_controller = new SymptomController();

            $patient_cpf = $_POST["patient_cpf"];
            $start_date = $_POST["start_date"];
            $symptoms = $_POST["symptom"];

            if (!isset($patient_cpf) || !isset($start_date)) {
            ?>
                <div class="card">
                    <h3>
                        <span>Não foi possível realizar esta operação</span>
                        <img src="../../../public/styles/img/error.svg" alt="Imagem de mensagem de erro">
                    </h3>
                    <p>Você precisa preencher os campos de CPF e data de início dos sintomas</p>
                </div>
                <?php
            } else {
                $patient = $patient_controller->fetchPatient($patient_cpf);

                if (is_object($patient)) {
                    $result = $symptom_controller->addSymptoms($patient_cpf, $symptoms, $start_date);
                    if (!is_bool($result)) {
                ?>
                        <div class="card">
                            <h3>
                                <span>Mensagem de erro</span>
                                <img src="../../../public/styles/img/error.svg" alt="Imagem de mensagem de erro">
                            </h3>
                            <p><?php echo "$result" ?></p>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="card">
                            <h3>
                                <span>Operação realizada</span>
                                <img src="../../../public/styles/img/success.svg" alt="Imagem de mensagem de sucesso">
                            </h3>
                            <p>O prontuário médico do paciente de CPF: <?php echo ("$patient_cpf") ?> está pronto!</p>

                            <a href="../medical_records/search_medical_records.html" class="primary-button">
                                Visualizar Prontuários
                            </a>
                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <div class="card">
                        <h3>
                            <span>Mensagem de erro</span>
                            <img src="../../../public/styles/img/error.svg" alt="Imagem de mensagem de erro">
                        </h3>
                        <p>O paciente de CPF: <?php echo ("$patient_cpf") ?> não existe!</p>
                    </div>
            <?php
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