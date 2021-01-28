<!DOCTYPE html>
<html lang="pt-br">

<head>
  <title>Unidade de Saúde | Médico(a)</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="../../../public/styles/img/doctors-list.svg" type="image/x-icon" />
  <link rel="stylesheet" type="text/css" href="../../../public/styles/css/main.css" />
  <link rel="stylesheet" type="text/css" href="../../../public/styles/css/home.css" />
  <link rel="stylesheet" type="text/css" href="../../../public/styles/css/table.css" />
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap" rel="stylesheet" />
</head>

<body>
  <header>
    <h3 id="logo">Unidade de Saúde</h3>
  </header>
  <main class="container">
    <section id="quick-access">
      <a href="./register_page.html" class="home-button">
        <h3>
          <p>Cadastrar Médico(a)</p>
          <img src="../../../public/styles/img/add-doctor.svg" alt="Imagem de cadastro de um médico" />
        </h3>
      </a>
      <a href="./search_doctor.html" class="home-button">
        <h3>
          <p>Procurar Médico(a)</p>
          <img src="../../../public/styles/img/doctor.svg" alt="Imagem de pesquisa" />
        </h3>
      </a>
    </section>
    <section class="table">
      <h2>Lista de Médicos</h2>
      <?php
      include_once('../../utils/autoload.php');

      use app\controllers\DoctorController;

      $doctor_controller = new DoctorController();

      $doctor_list = $doctor_controller->allDoctors();

      if ($doctor_list != null && is_array($doctor_list)) {

      ?>
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
      <?php
      } else {
      ?>
        <p>
          A lista de médicos está vazia.
        </p>
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