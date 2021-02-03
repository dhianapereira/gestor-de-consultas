<html>

<head>
  <title>Unidade de Saúde | Atualização</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="../../../public/styles/img/doctors-list.svg" type="image/x-icon" />
  <link rel="stylesheet" type="text/css" href="../../../public/styles/css/main.css" />
  <link rel="stylesheet" type="text/css" href="../../../public/styles/css/buttons.css" />
  <link rel="stylesheet" type="text/css" href="../../../public/styles/css/form.css" />
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
      <a href="./search_medical_appointment.html" class="home-button">
        <h3>
          <p>Procurar Consulta</p>
          <img src="../../../public/styles/img/update-medical-appointment.svg" alt="Imagem de pesquisa" />
        </h3>
      </a> <a href="./consultation_page.html" class="home-button">
        <h3>
          <p>Marcar Consulta</p>
          <img src="../../../public/styles/img/make-an-appointment.svg" alt="Imagem de marcar consulta" />
        </h3>
      </a><a href="./list_page.php" class="home-button">
        <h3>
          <p>Lista de Atendimento</p>
          <img src="../../../public/styles/img/medical-appointments-list.svg" alt="Imagem de lista de atendimento" />
        </h3>
      </a><a href="../home_page.php" class="home-button">
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

      use app\controllers\MedicalAppointmentController;
      use app\models\MedicalAppointment;

      $medical_appointment_controller = new MedicalAppointmentController();

      $id = $_POST["id"];
      $specialty = $_POST["specialty"];
      $genre = $_POST["genre"];
      $patient_cpf = $_POST["patient_cpf"];
      $date = $_POST["date"];
      $time = $_POST["time"];
      $arrival_time = $_POST["arrival_time"];
      $active = $_POST["active"];

      if (
        isset($id) && isset($specialty) && isset($genre)
        && isset($patient_cpf) && isset($active) && isset($date)
        && isset($time) && isset($arrival_time)
      ) {

        $medical_appointment = new MedicalAppointment(
          $id,
          $patient_cpf,
          [$specialty, $genre],
          $date,
          $time,
          $arrival_time,
          $active
        );

        $result = $medical_appointment_controller->update($medical_appointment);

        if ($result == null || !is_bool($result)) {
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
            <p>As atualizações foram realizadas com sucesso!</p>
          </div>
        <?php
        }
      } else {
        ?>
        <div class="card">
          <h3>
            <span>Não foi possível realizar esta operação</span>
            <img src="../../../public/styles/img/error.svg" alt="Imagem de mensagem de erro">
          </h3>
          <p>Você precisa alterar alguma informação da consulta para que a operação seja realizada.</p>

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