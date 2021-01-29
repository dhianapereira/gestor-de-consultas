<html>

<head>
  <title>Unidade de Saúde | Dados da Consulta</title>
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
<script src="../../../public/scripts/script.js"></script>

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
      <div class="form">
        <?php
        include_once('../../utils/autoload.php');

        use app\controllers\MedicalAppointmentController;

        $medical_appointment_controller = new MedicalAppointmentController();

        $id = $_POST["id"];

        if (isset($id)) {
          $medical_appointment = $medical_appointment_controller->fetchMedicalAppointment($id);

          if ($medical_appointment == null || !is_object($medical_appointment)) {
        ?>
            <div class="card">
              <h3>
                <span>Mensagem de Erro</span>
                <img src="../../../public/styles/img/error.svg" alt="Imagem de mensagem de erro">
              </h3>
              <p>Não há nenhuma consulta com o ID: <?php echo "$id" ?> </p>
            </div>
          <?php
          } else {
          ?>
            <h2>Dados da Consulta</h2>
            <form method="POST" action="update_medical_appointment.php">
              <div class="input-block">
                <label for="id">ID</label>
                <input id="id" value="<?php echo ($medical_appointment->getId()) ?>" disabled />
                <input type="hidden" name="id" value="<?php echo ($medical_appointment->getId()) ?>" required />
              </div>
              <div class="input-block">
                <label for="patient_cpf">Paciente</label>
                <input id="patient_cpf" name="patient_cpf" value="<?php echo ($medical_appointment->getPatientCpf()) ?>" required />
              </div>
              <div class="input-block">
                <label for="doctor">Médico(a)</label>
                <input id="doctor" value="<?php echo ($medical_appointment->getIdDoctor()[0]) ?>" disabled />
              </div>
              <div class="input-block">
                <label for="specialty">Especialidade</label>
                <input id="specialty" name="specialty" value="<?php echo ($medical_appointment->getIdDoctor()[1]) ?>" required />
              </div>
              <div class="input-block">
                <label for="genre">Gênero</label>
                <input type="hidden" name="genre" id="genre" value="<?php echo ($medical_appointment->getIdDoctor()[2]) ?>" required />

                <div class="button-select">
                  <button data-value="Feminino" onclick="toggleGenre(event)" type="button" <?php
                                                                                            if ($medical_appointment->getIdDoctor()[2] == "Feminino") {
                                                                                            ?> class="active-genre" <?php
                                                                                                                  }
                                                                                                                    ?>>
                    Feminino
                  </button>
                  <button data-value="Masculino" onclick="toggleGenre(event)" type="button" <?php
                                                                                            if ($medical_appointment->getIdDoctor()[2] == "Masculino") {
                                                                                            ?> class="active-genre" <?php
                                                                                                                  }
                                                                                                                    ?>>
                    Masculino
                  </button>
                </div>
              </div>
              <br>
              <br>
              <span class="line">
                <span class="input-block">
                  <label for="date" class="sr-only">Data</label>
                  <input type="date" id="date" name="date" value="<?php echo ($medical_appointment->getDate()) ?>" required />
                </span>
                <span class="input-block">
                  <label for="time" class="sr-only">Horário</label>
                  <input type="time" id="time" name="time" value="<?php echo ($medical_appointment->getTime()) ?>" required />
                </span>
              </span>
              <br>
              <br>
              <div class="input-block">
                <label for="arrival_time">Horário de Chegada: </label>
                <input type="time" id="arrival_time" name="arrival_time" value="<?php echo ($medical_appointment->getArrivalTime()) ?>" required />
              </div>
              <div class="input-block">
                <label for="realized">Consulta realizada?</label>
                <input type="hidden" name="active" id="realized" value="<?php echo ($medical_appointment->getRealized()) ?>" required />

                <div class="button-select">
                  <button data-value=1 onclick="toggleActive(event)" type="button" <?php
                                                                                    if ($medical_appointment->getRealized() == 1) {
                                                                                    ?> class="active" <?php
                                                                                                    }
                                                                                                      ?>>
                    Sim
                  </button>
                  <button data-value=0 onclick="toggleActive(event)" type="button" <?php
                                                                                    if ($medical_appointment->getRealized() == 0) {
                                                                                    ?> class="active" <?php
                                                                                                    }
                                                                                                      ?>>
                    Não
                  </button>
                </div>
              </div>
              <button type="submit" class="primary-button">Salvar Alterações</button>
            </form>
          <?php
          }
        } else {
          ?>
          <div class="card">
            <h3>
              <span>Não foi possível realizar esta operação</span>
              <img src="../../../public/styles/img/error.svg" alt="Imagem de mensagem de erro">
            </h3>
            <p>Você precisa inserir o ID da consulta!</p>
          </div>
        <?php
        }
        ?>
      </div>

    </section>
  </main>
  <footer>
    <p>2021 - Unidade de Saúde</p>
  </footer>
</body>

</html>