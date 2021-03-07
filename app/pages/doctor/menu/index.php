<?php
if (!isset($_SESSION["loggedUser"])) {
  header("Location: ./");
}

require_once "app/utils/pagination.php";
require_once "app/controllers/DoctorController.php";
require_once "app/components/MessageContainer.php";
require_once "app/components/Base.php";
?>
<html>

<head>
  <?php Base::head("Médico | Unidade de Saúde") ?>
  <link rel="stylesheet" type="text/css" href="./public/styles/css/table.css" />
</head>

<body>
  <?php Base::header(); ?>
  <main class="container">
    <section class="quick-access">
      <a href="?page=doctor/register" class="home-button">
        <h3>
          <p>Cadastrar Médico(a)</p>
          <img src="./public/styles/img/add-doctor.svg" alt="Imagem de cadastro de um médico" />
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
    <section>
      <?php

      if (!isset($_GET['index'])) {
        $_GET['index'] = "1";
      }

      $pagination = pagination($_GET['index'], "2");

      $start = $pagination[0];
      $total_records = $pagination[1];

      $result = DoctorController::allDoctors($start, $total_records);

      if ($result != null && !is_string($result)) {
        $doctor_list = $result[1];
        if ($doctor_list != null & is_array($doctor_list)) {

      ?>
          <div class="table">

            <h2>Lista de Médicos</h2>
            <table>
              <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Gênero</th>
                <th>Especialidade</th>
                <th>Status</th>
              </tr>
              <?php
              foreach ($doctor_list as $doctor) {
              ?>
                <tr>
                  <td><?php echo ($doctor->getId()); ?></td>
                  <td><?php echo ($doctor->getName()); ?></td>
                  <td><?php echo ($doctor->getGenre()); ?></td>
                  <td><?php echo ($doctor->getSpecialty()); ?></td>
                  <td><?php echo ($doctor->getActive()); ?></td>
                </tr>
              <?php
              }
              ?>
            </table>

          </div>
        <?php
        } else {
          MessageContainer::errorMessage("A lista de médicos está vazia", "Não há mais nenhum médico cadastrado.");
        }
        ?>
        <div class="input-block actions">
          <?php
          $total = $result[0];
          $position = $pagination[2];

          printTheButtons($total, $total_records, $position, "doctor/menu");
          ?>
        </div>
      <?php
      } else {
        MessageContainer::errorMessage("A lista de médicos está vazia", "Ainda não há nenhum médico cadastrado.");
      }
      ?>
    </section>
  </main>
  <?php Base::footer(); ?>
</body>

</html>