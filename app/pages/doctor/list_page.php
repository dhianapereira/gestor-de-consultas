<html>

<head>
    <title>Unidade de Saúde | Lista de Médicos</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../../../public/styles/img/doctors-list.svg" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/main.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/card.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/home.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/styles/css/table.css" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap" rel="stylesheet" />
</head>

<body>
    <header>
        <h3 class="logo">Unidade de Saúde</h3>
    </header>
    <main class="container">
        <section class="quick-access">

            <a href="./search_doctor.html" class="home-button">
                <h3>
                    <p>Procurar Médico(a)</p>
                    <img src="../../../public/styles/img/doctor.svg" alt="Imagem de pesquisa" />
                </h3>
            </a>
            <a href="./register_page.html" class="home-button">
                <h3>
                    <p>Cadastrar Médico(a)</p>
                    <img src="../../../public/styles/img/add-doctor.svg" alt="Imagem de cadastro de médicos" />
                </h3>
            </a>
            <a href="../home_page.php" class="home-button">
                <h3>
                    <p>Home</p>
                    <img src="../../../public/styles/img/home.svg" alt="Imagem de Home" />
                </h3>
            </a>
        </section>
        <section class="table">
            <?php
            include_once('../../utils/autoload.php');
            
            spl_autoload_register("autoload");

            use app\controllers\DoctorController;

            $doctor_controller = new DoctorController();

            $doctor_list = $doctor_controller->allDoctors();

            if ($doctor_list != null && is_array($doctor_list)) {

            ?>
                <h2>Lista de Médicos</h2>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Gênero</th>
                        <th>Especialidade</th>
                        <th>Status</th>
                    </tr>
                    <?php
                    foreach ($doctor_list as $doctor) {
                    ?>
                        <tr>
                            <td><?php echo ($doctor->getId()); ?></td>
                            <td><?php echo ($doctor->getName()); ?></td>
                            <td><?php echo ($doctor->getGenre()); ?></td>
                            <td><?php echo ($doctor->getSpecialty()); ?></td>
                            <td><?php echo ($doctor->getActive()); ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            <?php
            } else {
            ?>
                <div class="card">
                    <h3>
                        <span>A lista de médicos está vazia</span>
                        <img src="../../../public/styles/img/error.svg" alt="Imagem de mensagem de erro">
                    </h3>
                    <p>Ainda não há nenhum médico cadastrado.</p>
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