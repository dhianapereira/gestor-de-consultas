<?php
if (!isset($_SESSION["loggedUser"])) {
  header("Location: ./");
}
?>
<html>

<head>
  <title>Unidade de Saúde | Prontuário</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="./public/styles/img/doctors-list.svg" type="image/x-icon" />
  <link rel="stylesheet" type="text/css" href="./public/styles/css/main.css" />
  <link rel="stylesheet" type="text/css" href="./public/styles/css/form.css" />
  <link rel="stylesheet" type="text/css" href="./public/styles/css/home.css" />
  <link rel="stylesheet" type="text/css" href="./public/styles/css/card.css" />
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap" rel="stylesheet" />
</head>

<body>
  <header>
    <h3 class="logo">Unidade de Saúde</h3>
  </header>
  <main class="container">
    <section class="quick-access">
      <a href="?page=medical_records/search" class="home-button">
        <h3>
          <p>Procurar Prontuário</p>
          <img src="./public/styles/img/file-search.png" alt="Imagem de prontuário" />
        </h3>
      </a>
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
    require_once "app/components/MessageContainer.php";

    if (isset($_SESSION["errorMessage"])) {
      MessageContainer::errorMessage("Mensagem de Erro", $_SESSION["errorMessage"]);
      $_SESSION["errorMessage"] = null;
    } else if (isset($_SESSION["successMessage"])) {
      MessageContainer::successMessage("Operação realizada", $_SESSION["successMessage"]);
      $_SESSION["successMessage"] = null;
    } else {
    ?>
      <section class="box">
        <div class="form">
          <h2>Dados Pessoais</h2>
          <form>
            <div class="input-block">
              <label for="full_name">Nome</label>
              <input id="full_name" value="<?php echo ($patient->getName()) ?>" disabled />
            </div>
            <div class="input-block">
              <label for="cpf">CPF </label>
              <input id="cpf" value="<?php echo ($patient->getCpf()) ?>" disabled />
            </div>
            <div class="input-block">
              <label for="date_of_birth">Data de nascimento </label>
              <input id="date_of_birth" value="<?php echo ($patient->getDateOfBirth()) ?>" disabled />
            </div>
            <div class="input-block">
              <label for="genre">Gênero: </label>
              <input id="genre" value="<?php echo ($patient->getGenre()) ?>" disabled />
            </div>
            <div class="input-block">
              <label for="naturalness">Naturalidade: </label>
              <input id="naturalness" value="<?php echo ($patient->getNaturalness()) ?>" disabled />
            </div>
            <div class="input-block">
              <label for="mother_name">Nome da Mãe</label>
              <input id="mother_name" value="<?php echo ($patient->getMotherName()) ?>" disabled />
            </div>
            <div class="input-block">
              <label for="companion">Acompanhante</label>
              <input id="companion" value="<?php echo ($patient->getCompanion()) ?>" disabled />
            </div>
            <div class="input-block">
              <label for="patient_address">Endereço</label>
              <input id="patient_address" value="<?php echo ($patient->getAddress()) ?>" disabled />
            </div>
            <h2>Resultados</h2>
            <div class="input-block">
              <label for="start_date">Data de início dos sintomas</label>
              <input id="start_date" value="<?php echo ($medical_records->getStartDate()) ?>" disabled />
            </div>
            <div class="input-block">
              <label for="result">Resultado (%) </label>
              <input id="result" value="<?php echo (number_format($medical_records->getResult(), 2)) ?>" disabled />
            </div>
            <div class="input-block">
              <label for="gravity">Gravidade </label>
              <input id="gravity" value="<?php echo ($medical_records->getGravity()) ?>" disabled />
            </div>
            <h2>Sintomas</h2>
            <?php
            if ($symptoms == null || !is_array($symptoms)) {
            ?>
              <ul>
                <li>Este paciente não possui nenhum sintoma de Dengue.</li>
              </ul>
              <?php
            } else {
              foreach ($symptoms as $symptom) {
              ?>
                <ul>
                  <li><?php echo ($symptom->getName()); ?></li>
                </ul>
            <?php
              }
            }
            ?>
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