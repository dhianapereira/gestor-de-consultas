<html>

<head>
    <title> Unidade de Saúde | Buscar Sintomas</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width initial-scale=1.0" />
    <link rel="shortcut icon" href="../../../public/styles/img/doctors-list.svg" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/main.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/form.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/buttons.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/home.css" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap" rel="stylesheet" />
</head>

<body>
    <header>
        <h3 class="logo">Unidade de Saúde</h3>
    </header>
    <main class="container">
        <section class="quick-access">
            <a href="./search_by_month.php" class="home-button">
                <h3>
                    <p>Sintomas mais recorrentes</p>
                    <img src="../../../public/styles/img/search.svg" alt="Imagem da pesquisa por sintomas mais recorrentes" />
                </h3>
            </a>
            <a href="../symptom/questionnaire_page.html" class="home-button">
                <h3>
                    <p>Questionário (Dengue)</p>
                    <img src="../../../public/styles/img/questionnaire.svg" alt="Imagem de questionário" />
                </h3>
            </a>
            <a href="./list_page.php" class="home-button">
                <h3>
                    <p>Listar Prontuários</p>
                    <img src="../../../public/styles/img/medical-records-list.svg" alt="imagem da lista de prontuários" />
                </h3>
            </a>
            <a href="./search_medical_records.html" class="home-button">
                <h3>
                    <p>Procurar Prontuário</p>
                    <img src="../../../public/styles/img/file-search.png" alt="Imagem de Prontuário">
                </h3>
            </a>
            <a href="../home_page.php" class="home-button">
                <h3>
                    <p>Home</p>
                    <img src="../../../public/styles/img/home.svg" alt="Imagem de Home" />
                </h3>

            </a>
        </section>
        <section>
            <?php
            include_once('../../utils/autoload.php');
            include_once('../../utils/pagination.php');

            spl_autoload_register("autoload");
            spl_autoload_register("pagination");

            $month = explode(' ', $_POST["months"]);

            $total_days = intval($month[0]);
            $month_in_number = intval($month[1]);

            echo ("Total de dias: " . $total_days . " " . "Mês: " . $month_in_number);
            ?>

        </section>
    </main>
</body>

</html>