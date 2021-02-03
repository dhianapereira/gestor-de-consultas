<html>

<head>
    <title>Unidade de Saúde | Entrar</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../styles/img/doctors-list.svg" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="../styles/css/main.css" />
    <link rel="stylesheet" type="text/css" href="../styles/css/home.css" />
    <link rel="stylesheet" type="text/css" href="../styles/css/card.css" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap" rel="stylesheet" />
</head>

<body>
    <header>
        <h1 class="logo">Unidade de Saúde</h1>
    </header>
    <main class="container">
        <section class="up">
            <?php
            include_once('../../app/utils/autoload.php');

            spl_autoload_register("autoload");

            error_reporting(E_ALL);
            ini_set('display_errors', 'On');

            use src\data\repository\Connection;

            $conn = new Connection();

            $username = $_POST["username"];
            $password = $_POST["password"];

            $sql = 'SELECT * FROM user WHERE username = :username 
                            AND password = :password';

            $stmt = $conn->connect()->prepare($sql);

            $stmt->execute(array(
                ':username' => $username,
                ':password' => $password,
            ));

            $user = $stmt->fetchAll();

            $conn = null;

            if ($user == null) {
            ?> <div class="card">
                    <h3>
                        <span>Erro ao tentar acessar a plataforma</span>
                        <img src="../styles/img/error.svg" alt="Imagem de mensagem de erro">
                    </h3>
                    <p>O usuário inserido não possui permissão para acessar a plataforma.</p>
                </div>
            <?php
            } else {
                header('Location:../../app/pages/home_page.php');
            }
            ?>
        </section>
    </main>
    <footer>
        <p>2021 - Unidade de Saúde</p>
    </footer>
</body>

</html>