<html>

<head>
  <title>Unidade de Saúde | Prontuário</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="../../../public/styles/img/doctors-list.svg" type="image/x-icon" />
  <link rel="stylesheet" type="text/css" href="../../../public/styles/css/main.css" />
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

      <a href="./search_medical_records.html" class="home-button">
        <h3>
          <p>Procurar Prontuário</p>
          <img src="../../../public/styles/img/file-search.png" alt="Imagem de prontuário" />
        </h3>
      </a>
      <a href="./list_page.php" class="home-button">
        <h3>
          <p>Listar Prontuários</p>
          <img src="../../../public/styles/img/medical-records-list.svg" alt="Imagem de lista de prontuários" />
        </h3>
      </a>
      <a href="../symptom/questionnaire_page.html" class="home-button">
        <h3>
          <p>Questionário (Dengue)</p>
          <img src="../../../public/styles/img/questionnaire.svg" alt="Imagem de questionário" />
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
      <div class="form">
        <?php
        include_once('../../utils/autoload.php');

        spl_autoload_register("autoload");

        use app\controllers\MedicalRecordsController;
        use app\controllers\PatientController;
        use app\controllers\SymptomController;

        $medical_records_controller = new MedicalRecordsController();
        $patient_controller = new PatientController();
        $symptom_controller = new SymptomController();

        $cpf = $_POST["cpf"];

        if (isset($cpf)) {
          $medical_records = $medical_records_controller->fetchMedicalRecords($cpf);

          if ($medical_records == null || !is_object($medical_records)) {
        ?>
            <div class="card">
              <h3>
                <span>Mensagem de Erro</span>
                <img src="../../../public/styles/img/error.svg" alt="Imagem de mensagem de erro">
              </h3>
              <p>Não há nenhum prontuário com o CPF: <?php echo "$cpf" ?> </p>
            </div>
            <?php
          } else {
            $patient = $patient_controller->fetchPatient($cpf);

            if ($patient == null || !is_object($patient)) {
            ?>

              <div class="card">
                <h3>
                  <span>Mensagem de Erro</span>
                  <img src="../../../public/styles/img/error.svg" alt="Imagem de mensagem de erro">
                </h3>
                <p>Não há nenhum prontuário com o CPF: <?php echo "$cpf" ?> </p>
              </div>
            <?php
            } else {
              $symptoms = $symptom_controller->fetchSymptoms($cpf);
            ?>
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
          <?php
            }
          }
        } else {
          ?>
          <div class="card">
            <h3>
              <span>Não foi possível realizar esta operação</span>
              <img src="../../../public/styles/img/error.svg" alt="Imagem de mensagem de erro">
            </h3>
            <p>Você precisa inserir um CPF!</p>
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