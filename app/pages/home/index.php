<?php
if (!isset($_SESSION["loggedUser"])) {
  header("Location: ./");
}

require_once "app/utils/pagination.php";
require_once "app/controllers/MedicalAppointmentController.php";
require_once "app/components/MessageContainer.php";
require_once "app/components/Base.php";
require_once "app/components/Button.php";

?>
<html>

<head>
  <?php Base::head("Unidade de Saúde"); ?>
  <link rel="stylesheet" type="text/css" href="./public/styles/css/table.css" />
</head>

<body>
  <?php Base::header(); ?>
  <main class="container">
    <section class="quick-access">
      <?php
      Button::quickAccess(
        "?page=patient/menu",
        "Paciente",
        "./public/styles/img/questionnaire.svg",
        "Imagem de questionário"
      );

      Button::quickAccess(
        "?page=doctor/menu",
        "Médico",
        "./public/styles/img/doctor.svg",
        "Imagem de médico"
      );

      Button::quickAccess(
        "?page=medical_appointment/menu",
        "Consultas",
        "./public/styles/img/make-an-appointment.svg",
        "Imagem de consulta"
      );

      Button::quickAccess(
        "?page=medical_records/menu",
        "Prontuários",
        "./public/styles/img/medical-records-list.svg",
        "Imagem de prontuário"
      );

      Button::quickAccess(
        "?page=room/menu",
        "Salas",
        "./public/styles/img/medical-room.svg",
        "Imagem de salas"
      );

      if ($_SESSION['loggedUser'] == "Administrador") {
        Button::quickAccess(
          "?page=user/menu",
          "Funcionários",
          "./public/styles/img/update-patient.svg",
          "Imagem de funcionário"
        );
      }

      Button::quickAccess(
        "?class=User&action=logout",
        "Sair",
        "./public/styles/img/logout.svg",
        "Sair"
      );
      ?>
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
  <?php Base::footer(); ?>
</body>

</html>