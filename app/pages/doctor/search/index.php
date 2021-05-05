<?php
if (!isset($_SESSION["loggedUser"])) {
  header("Location: ./");
}
?>
<html>

<head>
  <title>Unidade de Saúde | Buscar Médico</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="./public/styles/img/doctors-list.svg" type="image/x-icon" />
  <link rel="stylesheet" type="text/css" href="./public/styles/css/main.css" />
  <link rel="stylesheet" type="text/css" href="./public/styles/css/home.css" />
  <link rel="stylesheet" type="text/css" href="./public/styles/css/form.css" />
  <link rel="stylesheet" type="text/css" href="./public/styles/css/buttons.css" />
  <link rel="stylesheet" type="text/css" href="./public/styles/css/card.css" />
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap" rel="stylesheet" />
</head>

<body>
  <header>
    <h3 class="logo">Unidade de Saúde</h3>
  </header>

  <main class="container">
    <section class="quick-access">
      <a href="?page=doctor/register" class="home-button">
        <h3>
          <p>Cadastrar Médico(a)</p>
          <img src="./public/styles/img/add-doctor.svg" alt="Imagem de cadastro de médicos" />
        </h3>
      </a>
      <a href="?page=doctor/list" class="home-button">
        <h3>
          <p>Listar Médicos</p>
          <img src="./public/styles/img/doctors-list.svg" alt="Imagem de lista de médicos" />
        </h3>
      </a>
      <a href="?page=home" class="home-button">
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
    }
    ?>
    <section class="box">
      <div class="form">
        <h2>Procurar Médico(a)</h2>
        <form method="POST" action="?class=Doctor&action=fetchDoctor">

          <div class="input-block">
            <label for="id" class="sr-only">ID do Médico</label>
            <input id="id" type="number" name="id" placeholder="Insira o ID do Médico" required />
          </div>
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