<html>

<head>
  <title>Unidade de Saúde | Dados do Paciente</title>
  <meta charset="utf-8" />
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="../../../public/styles/img/doctors-list.svg" type="image/x-icon" />
  <link rel="stylesheet" type="text/css" href="../../../public/styles/css/main.css" />
  <link rel="stylesheet" type="text/css" href="../../../public/styles/css/home.css" />
  <link rel="stylesheet" type="text/css" href="../../../public/styles/css/buttons.css" />
  <link rel="stylesheet" type="text/css" href="../../../public/styles/css/form.css" />
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
      <a href="./search_patient.html" class="home-button">
        <h3>
          <p>Procurar Paciente</p>
          <img src="../../../public/styles/img/update-patient.svg">
        </h3>
      </a>
      <a href="./register_page.html" class="home-button">
        <h3>
          <p>Lista de Pacientes</p>
          <img src="../../../public/styles/img/list.svg">
        </h3>
      </a>
      <a href="./menu.php" class="home-button">
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

        use app\controllers\PatientController;

        $patient_controller = new PatientController();

        $cpf = $_POST["cpf"];

        if (isset($cpf)) {
          $patient = $patient_controller->fetchPatient($cpf);
          if ($patient == null || !is_object($patient)) {

        ?>
            <div class="card">
              <h3>
                <span>Mensagem de Erro</span>
                <img src="../../../public/styles/img/error.svg" alt="Imagem de mensagem de erro">
              </h3>
              <p>Nenhum Paciente com o CPF: <?php echo "$cpf" ?> </p>
            </div>
          <?php
          } else {
          ?>
            <h2>Dados do Paciente</h2>
            <form method="POST" action="update_patient.php">
              <div class="input-block">
                <label for="cpf">CPF</label>
                <input id="cpf" value="<?php echo ($patient->getCpf()) ?>" disabled />
                <input type="hidden" name="cpf" value="<?php echo ($patient->getCpf()) ?>" required />
              </div>
              <div class="input-block">
                <label for="full_name">Nome</label>
                <input id="full_name" name="full_name" value="<?php echo ($patient->getName()) ?>" required />
              </div>
              <div class="input-block">
                <label for="date_of_birth">Data de Nascimento</label>
                <input id="date_of_birth" type="date" name="date_of_birth" value="<?php echo ($patient->getDateOfBirth()) ?>" required />
              </div>
              <div class="input-block">
                <label for="mother_name">nome da Mãe</label>
                <input id="mother_name" name="mother_name" value="<?php echo ($patient->getMotherName()) ?>" required />
              </div>
              <div class="input-block">
                <label for="genre">Gênero</label>
                <input type="hidden" name="genre" id="genre" value="<?php echo ($patient->getGenre()) ?>" required />

                <div class="button-select">
                  <button data-value="Feminino" onclick="toggleGenre(event)" type="button" <?php
                                                                                            if ($patient->getGenre() == "Feminino") {
                                                                                            ?> class="active-genre" <?php
                                                                                                                  }
                                                                                                                    ?>>
                    Feminino
                  </button>
                  <button data-value="Masculino" onclick="toggleGenre(event)" type="button" <?php
                                                                                            if ($patient->getGenre() == "Masculino") {
                                                                                            ?> class="active-genre" <?php
                                                                                                                  }
                                                                                                                    ?>>
                    Masculino
                  </button>
                </div>
              </div>
              <div class="input-block">
                <label for="companion"> Acompanhante</label>
                <input id="companion" name="companion" value="<?php echo ($patient->getCompanion()) ?>" required />
              </div>
              <div class="input-block">
                <label for="address"> Endereço </label>
                <input id="address" name="address" value="<?php echo ($patient->getAddress()) ?>" required />
              </div>


              <div class="input-block">
                <label for="naturalness">Naturalidade</label>
                <input type="hidden" name="naturalness" id="naturalness" value="<?php echo ($patient->getNaturalness()) ?>" required />

                <div class="button-select">
                  <button data-value="Brasileiro" onclick="toggleNaturalness(event)" type="button" <?php
                                                                                                    if ($patient->getNaturalness() == "Brasileiro(a)") {
                                                                                                    ?> class="active-naturalness" <?php
                                                                                                                                }
                                                                                                                                  ?>>
                    Brasileiro(a)
                  </button>
                  <button data-value="Estrangeiro" onclick="toggleNaturalness(event)" type="button" <?php
                                                                                                    if ($patient->getNaturalness() == "Estrangeiro(a)") {
                                                                                                    ?> class="active-naturalness" <?php
                                                                                                                                }
                                                                                                                                  ?>>
                    Estrangeiro(a)
                  </button>
                </div>
              </div>



              <!--
                <div class="input-block">
                <label for="active">Status</label>
                <input type="hidden" name="active" id="active" value="<?php /*echo ($doctor->getActive()) ?>" required />

                <div class="button-select">
                  <button data-value=1 onclick="toggleActive(event)" type="button" <?php
                                                                                    if ($doctor->getActive() == 1) {
                                                                                    ?> class="active" <?php
                                                                                                    }
                                                                                                      ?>>
                    Ativo
                  </button>
                  <button data-value=0 onclick="toggleActive(event)" type="button" <?php
                                                                                    if ($doctor->getActive() == 0) {
                                                                                    ?> class="active" <?php
                                                                                                    }*/
                                                                      ?>>
                    Inativo
                  </button>
                </div>
              </div>
              <div class="input-block">
                <label for="active">Status</label>
                <input type="hidden" name="active" id="active" value="<?php /*echo ($doctor->getActive()) ?>" required />

                <div class="button-select">
                  <button data-value=1 onclick="toggleActive(event)" type="button" <?php
                                                                                    if ($doctor->getActive() == 1) {
                                                                                    ?> class="active" <?php
                                                                                                    }
                                                                                                      ?>>
                    Ativo
                  </button>
                  <button data-value=0 onclick="toggleActive(event)" type="button" <?php
                                                                                    if ($doctor->getActive() == 0) {
                                                                                    ?> class="active" <?php
                                                                                                    }*/
                                                                      ?>>
                    Inativo
                  </button>
                </div>
              </div>-->
              <button type="submit" class="primary-button">Salvar Alterações</button>
            </form>
          <?php
          }
        } else {
          ?>
          <div class="card">
            <h3>
              <span>Mensagem de Erro</span>
              <img src="../../../public/styles/img/error.svg" alt="Imagem de mensagem de erro">
            </h3>
            <p>Você precisa inserir um CPF!</p>
          </div>
        <?php
        }
        ?>
      </div>
      </div>

    </section>
  </main>


</body>

</html>