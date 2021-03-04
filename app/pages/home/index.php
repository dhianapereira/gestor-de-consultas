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
  <link rel="stylesheet" type="text/css" href="./public/styles/css/table.css" />
  <link rel="stylesheet" type="text/css" href="./public/styles/css/card.css" />
  <link rel="stylesheet" type="text/css" href="./public/styles/css/buttons.css" />
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap" rel="stylesheet" />
</head>

<body>
  <header>
    <h3 class="logo">Unidade de Saúde</h3>
  </header>
  <main class="container">
    <?php
    require_once "app/utils/pagination.php";
    require_once "app/controllers/MedicalAppointmentController.php";
    require_once "app/components/MessageContainer.php";

    ?>
    <section class="quick-access">
      <a href="?page=patient/menu" class="home-button">
        <h3>
          <p>Paciente</p>
          <img src="./public/styles/img/questionnaire.svg" alt="Imagem de questionário" />
        </h3>
      </a>
      <a href="?page=doctor/menu" class="home-button">
        <h3>
          <p>Médico</p>
          <img src="./public/styles/img/doctor.svg" alt="Imagem de médico" />
        </h3>
      </a>
      <a href="?page=medical_appointment/menu" class="home-button">
        <h3>
          <p>Consultas</p>
          <img src="./public/styles/img/make-an-appointment.svg" alt="Imagem de consulta" />
        </h3>
      </a>
      <a href="?page=medical_records/menu" class="home-button">
        <h3>
          <p>Prontuários</p>
          <img src="./public/styles/img/medical-records-list.svg" alt="Imagem de prontuário" />
        </h3>
      </a>
      <a href="?page=room/menu" class="home-button">
        <h3>
          <p>Salas</p>
          <img src="./public/styles/img/medical-room.svg" alt="Imagem de salas" />
        </h3>
      </a>
      <?php
      if ($_SESSION['loggedUser'] == "Administrador") {
      ?>
        <a href="?page=user/menu" class="home-button">
          <h3>
            <p>Funcionários</p>
            <img src="./public/styles/img/update-patient.svg" alt="Imagem de funcionário" />
          </h3>
        </a>
      <?php
      }
      ?>
      <a href="?class=User&action=logout" class="home-button">
        <h3>
          <p>Sair</p>
          <img src="./public/styles/img/logout.svg" alt="Sair" />
        </h3>
      </a>
    </section>
    <section>
      <?php

      if (!isset($_GET['index'])) {
        $_GET['index'] = "1";
      }

      $pagination = pagination($_GET['index'], "2");

      $start = $pagination[0];
      $total_records = $pagination[1];

      $result = MedicalAppointmentController::allMedicalAppointments($start, $total_records);

      if ($result != null && !is_string($result)) {
        $medical_appointment_list = $result[1];
        if ($medical_appointment_list != null && is_array($medical_appointment_list)) {
      ?>
          <div class="table">

            <h2>Lista de Atendimento</h2>
            <table>
              <tr>
                <th>ID</th>
                <th>Paciente</th>
                <th>Médico(a)</th>
                <th>Sala</th>
                <th>Data e Horário</th>
                <th>Horário de chegada</th>
                <th>Consulta Realizada?</th>
              </tr>
              <?php
              foreach ($medical_appointment_list as $medical_appointment) {
              ?>
                <tr>
                  <td><?php echo ($medical_appointment->getId()); ?></td>
                  <td><?php echo ($medical_appointment->getPatientCpf()); ?></td>
                  <td><?php echo ($medical_appointment->getIdDoctor()); ?></td>
                  <td><?php echo ("id: " . $medical_appointment->getIdRoom()[0] . " " . $medical_appointment->getIdRoom()[1]); ?></td>
                  <td><?php echo ($medical_appointment->getDate() . " às " . $medical_appointment->getTime()); ?></td>
                  <td><?php echo ($medical_appointment->getArrivalTime()); ?></td>
                  <td><?php echo ($medical_appointment->getStatus()); ?></td>
                </tr>
              <?php
              }
              ?>
            </table>
          </div>
        <?php
        } else {
          MessageContainer::errorMessage("A lista de atendimento está vazia", "Não há mais registros de consulta.");
        }
        ?>
        <div class="input-block actions">
          <?php
          $total = $result[0];
          $position = $pagination[2];

          printTheButtons($total, $total_records, $position, "home");
          ?>
        </div>
      <?php
      } else {
        MessageContainer::errorMessage("A lista de atendimento está vazia",  "Ainda não há nenhuma consulta marcada.");
      }
      ?>
    </section>
  </main>
  <footer>
    <p>2021 - Unidade de Saúde</p>
  </footer>
</body>

</html>