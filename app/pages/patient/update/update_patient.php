<html>

<head>
  <title>Unidade de Saúde | Atualização</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="../../../public/styles/img/doctors-list.svg" type="image/x-icon" />
  <link rel="stylesheet" type="text/css" href="../../../public/styles/css/main.css" />
  <link rel="stylesheet" type="text/css" href="../../../public/styles/css/buttons.css" />
  <link rel="stylesheet" type="text/css" href="../../../public/styles/css/form.css" />
  <link rel="stylesheet" type="text/css" href="../../../public/styles/css/card.css" />
  <link rel="stylesheet" type="text/css" href="../../../public/styles/css/home.css" />
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap" rel="stylesheet" />
</head>

<body>
  <header>
    <h3 class="logo">Unidade de Saúde</h3>
  </header>
  <main class="container">
    <section class="quick-access">

      <a href="search_patient.html" class="home-button">
        <h3>
          <p>Procurar Paciente</p>
          <img src="../../../public/styles/img/update-patient.svg" alt="Imagem de paciente" />
        </h3>
      </a>
      <a href="register_page.html" class="home-button">
        <h3>
          <p>Cadastrar Paciente</p>
          <img src="../../../public/styles/img/plus.svg" alt="Imagem de cadastro de pacientes" />
        </h3>
      </a>
      <a href="./list_page.php" class="home-button">
        <h3>
          <p>Listar Paciente</p>
          <img src="../../../public/styles/img/doctors-list.svg" alt="Imagem de lista de pacientes" />
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

      spl_autoload_register("autoload");

      use app\controllers\PatientController;
      use app\models\Patient;
      use app\components\MessageContainer;

      $patient_controller = new PatientController();
      $cpf = $_POST["cpf"];
      $full_name = $_POST["full_name"];
      $date_of_birth = $_POST["date_of_birth"];
      $mother_name = $_POST["mother_name"];
      $genre = $_POST["genre"];
      $companion = $_POST["companion"];
      $address = $_POST["address"];
      $naturalness = $_POST["naturalness"];
      $active = $_POST["active"];

      if (
        isset($cpf) && isset($full_name) && isset($genre) && isset($date_of_birth) && isset($mother_name)
        && isset($companion) && isset($address) && isset($naturalness)  && isset($active)
      ) {
        $patient = new Patient($cpf, $full_name, $genre, $date_of_birth, $mother_name, $companion, $address, $naturalness, $active);

        $result = $patient_controller->update($patient);

        if ($result == null || !is_bool($result)) {

          MessageContainer::errorMessage("Mensagem de Erro", "../../../public/styles/img/error.svg", $result);
        } else {
          MessageContainer::successMessage("Operação realizada", "../../../public/styles/img/success.svg", "As atualizações foram realizadas com sucesso!");
        }
      } else {
        MessageContainer::errorMessage("Não foi possível realizar esta operação", "../../../public/styles/img/error.svg", "Você precisa alterar alguma informação para que a operação seja realizada.");
      }

      ?>

    </section>
  </main>
  <footer>
    <p>2021 - Unidade de Saúde</p>
  </footer>
</body>

</html>