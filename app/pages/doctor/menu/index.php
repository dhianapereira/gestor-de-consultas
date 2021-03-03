<?php
if (!isset($_SESSION["loggedUser"])) {
  header("Location: ./");
}
?>
<html>

<head>
  <title>Unidade de Saúde | Médico(a)</title>
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
    require_once "app/components/MessageContainer.php";
    ?>
    <section class="quick-access">
      <a href="./register_page.html" class="home-button">
        <h3>
          <p>Cadastrar Médico(a)</p>
          <img src="./public/styles/img/add-doctor.svg" alt="Imagem de cadastro de um médico" />
        </h3>
      </a>
      <a href="./search_doctor.html" class="home-button">
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

      $result = $doctor_controller->allDoctors($pagination[0], $pagination[1]);

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
          $total_records = $pagination[1];
          $position = $pagination[2];

          printTheButtons($total, $total_records, $position);
          ?>
        </div>
      <?php
      } else {
        MessageContainer::errorMessage("A lista de médicos está vazia", "Ainda não há nenhum médico cadastrado.");
      }
      ?>
    </section>
  </main>
  <footer>
    <p>2021 - Unidade de Saúde</p>
  </footer>
</body>

</html>