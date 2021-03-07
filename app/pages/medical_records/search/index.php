<?php
if (!isset($_SESSION["loggedUser"])) {
  header("Location: ./");
}

require_once "app/components/MessageContainer.php";
require_once "app/components/Base.php";
?>
<html>

<head>
  <?php Base::head("Buscar prontuários | Unidade de Saúde") ?>
  <link rel="stylesheet" type="text/css" href="./public/styles/css/form.css" />
</head>

<body>
  <?php Base::header(); ?>
  <main class="container">
    <section class="quick-access">
      <a href="?page=symptom" class="home-button">
        <h3>
          <p>Questionário (Dengue)</p>
          <img src="./public/styles/img/questionnaire.svg" alt="Imagem de questionário" />
        </h3>
      </a>

      <a href="?page=medical_records/most_recurrent_symptom" class="home-button">
        <h3>
          <p>Sintomas mais recorrentes</p>
          <img src="./public/styles/img/search.svg" alt="Imagem da pesquisa por sintomas mais recorrentes" />
        </h3>
      </a>
      <a href="?page=medical_records/list" class="home-button">
        <h3>
          <p>Listar Prontuários</p>
          <img src="./public/styles/img/medical-records-list.svg" alt="Imagem de lista de prontuários" />
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
    if (isset($_SESSION["errorMessage"])) {
      MessageContainer::errorMessage("Mensagem de Erro", $_SESSION["errorMessage"]);
      $_SESSION["errorMessage"] = null;
    }
    ?>
    <section class="box">
      <div class="form">
        <h2>Pesquisar prontuários</h2>
        <form method="POST" action="?class=MedicalRecords&action=fetchMedicalRecords">
          <div class="input-block">
            <label for="cpf">CPF do paciente</label>
            <input id="cpf" name="cpf" required />
          </div>
          <button type="submit" class="primary-button">Confirmar</button>
        </form>
      </div>
    </section>
  </main>
  <?php Base::footer(); ?>
</body>

</html>