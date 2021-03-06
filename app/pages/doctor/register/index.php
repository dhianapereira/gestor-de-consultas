<?php
if (!isset($_SESSION["loggedUser"])) {
  header("Location: ./");
}

require_once "app/components/MessageContainer.php";
require_once "app/components/Base.php";
?>
<html>

<head>
  <?php Base::head("Cadastro | Unidade de Saúde"); ?>
  <link rel="stylesheet" type="text/css" href="./public/styles/css/form.css" />
</head>
<script src="./public/scripts/toggle.js"></script>

<body>

  <?php Base::header(); ?>

  <main class="container">
    <section class="quick-access">
      <a href="?page=doctor/list" class="home-button">
        <h3>
          <p>Listar Médicos</p>
          <img src="./public/styles/img/doctors-list.svg" alt="Imagem de lista de médicos" />
        </h3>
      </a>
      <a href="?page=doctor/search" class="home-button">
        <h3>
          <p>Procurar Médico(a)</p>
          <img src="./public/styles/img/doctor.svg" alt="Imagem de pesquisa" />
        </h3>
      </a> <a href="?page=home" class="home-button">
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
    } else if (isset($_SESSION["successMessage"])) {
      MessageContainer::successMessage("Operação realizada", $_SESSION["successMessage"]);
      $_SESSION["successMessage"] = null;
    }
    ?>
    <section class="box">
      <div class="form">
        <h2>Cadastrar Médico(a)</h2>
        <form method="POST" action="?class=Doctor&action=register">
          <div class="input-block">
            <label for="name" class="sr-only">Nome</label>
            <input id="name" name="name" placeholder="Nome" required />
          </div>
          <div class="input-block">
            <label for="specialty" class="sr-only">Especialidade</label>
            <input id="specialty" name="specialty" placeholder="Especialidade" required />
          </div>

          <div class="input-block">
            <label for="genre" class="sr-only">Gênero</label>
            <input type="hidden" name="genre" id="genre" value="Feminino" required />

            <div class="button-select">
              <button data-value="Feminino" onclick="toggle(event, 'active-genre', 'genre')" type="button" class="active-genre">
                Feminino
              </button>
              <button data-value="Masculino" onclick="toggle(event, 'active-genre', 'genre')" type="button">
                Masculino
              </button>
            </div>
          </div>

          <button type="submit" class="primary-button">Confirmar</button>
        </form>
      </div>
    </section>
  </main>

  <?php Base::footer(); ?>
</body>

</html>