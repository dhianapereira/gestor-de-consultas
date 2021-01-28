<html>

<head>
    <title>Unidade de Saúde | Cadastro</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../../../public/styles/img/doctors-list.svg" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/main.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/home.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/card.css" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap" rel="stylesheet" />
</head>

<body>

    <header>
        <h3 class="logo">Unidade de Saúde</h3>
    </header>
    <main class="container">
        <section class="quick-access">
            <a href="./register_page.html" class="home-button">
                <h3>
                    <p>Cadastrar Médico(a)</p>
                    <img src="../../../public/styles/img/add-doctor.svg" alt="Imagem de cadastro de médicos" />
                </h3>
            </a>
            <a href="./list_page.php" class="home-button">
                <h3>
                    <p>Listar Médicos</p>
                    <img src="../../../public/styles/img/doctors-list.svg" alt="Imagem de lista de médicos" />
                </h3>
            </a>
            <a href="./search_doctor.html" class="home-button">
                <h3>
                    <p>Procurar Médico(a)</p>
                    <img src="../../../public/styles/img/doctor.svg" alt="Imagem de pesquisa" />
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

            use app\controllers\DoctorController;

            $doctor_controller = new DoctorController();

            $name = $_POST["name"];
            $genre = $_POST["genre"];
            $specialty = $_POST["specialty"];

            if (!isset($specialty) || !isset($name) || !isset($genre)) {
            ?>

                <div class="card">
                    <h3>
                        <span>Não foi possível realizar esta operação</span>
                        <img src="../../../public/styles/img/error.svg" alt="Imagem de mensagem de erro">
                    </h3>
                    <p>Você precisa preencher todos os campos para realizar esta operação!</p>
                </div>
                <?php
            } else {

                $result = $doctor_controller->register($name, $genre, $specialty);

                if (!is_bool($result)) {
                ?>
                    <div class="card">
                        <h3>
                            <span>Mensagem de Erro</span>
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
                        <p>O cadastro foi realizado com sucesso!</p>
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