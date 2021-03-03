<?php
if (!isset($_SESSION["loggedUser"])) {
    header("Location: ./");
}
?>

<html>

<head>
    <title>Unidade de Saúde</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="./public/styles/img/doctors-list.svg" type="image/x-icon" />

    <link rel="stylesheet" type="text/css" href="./public/styles/css/main.css" />
    <link rel="stylesheet" type="text/css" href="./public/styles/css/home.css" />
    <link rel="stylesheet" type="text/css" href="./public/styles/css/card.css" />
    <link rel="stylesheet" type="text/css" href="./public/styles/css/buttons.css" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap" rel="stylesheet" />
</head>

<body>
    <header>
        <h1 class="logo">Unidade de Saúde</h1>
    </header>
    <main class="container">
        <section class="up">
            <div class="card">
                <h3>
                    <span>Acesse a plataforma</span>
                    <img src="./public/styles/img/success.svg" alt="Imagem de mensagem de sucesso" />
                </h3>
                <p>
                    Bem-vindo(a) a plataforma de gerenciamento de pacientes e consultas
                    médicas
                </p>
                <h3>
                    <a href="?page=user/login" class="primary-button">
                        Entrar
                    </a>
                    <a href="?page=user/register_on_platform" class="primary-button">
                        Cadastrar
                    </a>
                </h3>
            </div>
        </section>
    </main>
    <footer>
        <p>2021 - Unidade de Saúde</p>
    </footer>
</body>

</html>