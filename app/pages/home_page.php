<!DOCTYPE html>
<html lang="pt-br">

<head>
  <title>Unidade de Saúde</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="../../public/styles/img/doctors-list.svg" type="image/x-icon" />
  <link rel="stylesheet" type="text/css" href="../../public/styles/css/main.css" />
  <link rel="stylesheet" type="text/css" href="../../public/styles/css/home.css" />
  <link rel="stylesheet" type="text/css" href="../../public/styles/css/table.css" />
  <link rel="stylesheet" type="text/css" href="../../public/styles/css/card.css" />
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap" rel="stylesheet" />
</head>

<body>
  <header>
    <h3 class="logo">Unidade de Saúde</h3>
  </header>
  <main class="container">
    <section class="quick-access">
      <a href="./patient/menu.php" class="home-button">
        <h3>
          <p>Paciente</p>
          <img src="../../public/styles/img/questionnaire.svg" alt="Imagem de questionário" />
        </h3>
      </a>
      <a href="./doctor/menu.php" class="home-button">
        <h3>
          <p>Médico</p>
          <img src="../../public/styles/img/doctor.svg" alt="Imagem de médico" />
        </h3>
      </a>
      <a href="./medical_appointment/menu.php" class="home-button">
        <h3>
          <p>Consultas</p>
          <img src="../../public/styles/img/make-an-appointment.svg" alt="Imagem de consulta" />
        </h3>
      </a>
      <a href="./medical_records/menu.php" class="home-button">
        <h3>
          <p>Prontuários</p>
          <img src="../../public/styles/img/medical-records-list.svg" alt="Imagem de prontuário" />
        </h3>
      </a>
    </section>
    <section class="table">
      <h2>Lista de Atendimento</h2>
      <?php

      include_once('../utils/autoload.php');

      spl_autoload_register("autoload");

      use app\controllers\MedicalAppointmentController;

      $medical_appointment_controller = new MedicalAppointmentController();

      $medical_appointment_list = $medical_appointment_controller->allMedicalAppointments();
      if (
        $medical_appointment_list != null &&
        is_array($medical_appointment_list)
      ) { ?>
        <table>
          <tr>
            <th>ID</th>
            <th>Paciente</th>
            <th>Médico(a)</th>
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
              <td>
                <?php echo ($medical_appointment->getDate() . " às
              " . $medical_appointment->getTime()); ?>
              </td>
              <td><?php echo ($medical_appointment->getArrivalTime()); ?></td>
              <td><?php echo ($medical_appointment->getRealized()); ?></td>
            </tr>
          <?php
          }
          ?>
        </table>
      <?php
      } else {
      ?> <div class="card">
          <h3>
            <span>A lista de atendimento está vazia</span>
            <img src="../../public/styles/img/error.svg" alt="Imagem de mensagem de erro">
          </h3>
          <p>Ainda não há nenhuma consulta marcada.</p>
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