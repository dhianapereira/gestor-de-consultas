<html>
  <head>
    <title>Unidade de Saúde | Prontuário</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="#" />
    <link
      rel="stylesheet"
      type="text/css"
      href="../../../public/styles/css/main.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="../../../public/styles/css/form.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="../../../public/styles/css/animations.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="../../../public/styles/css/sidebar.css"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <div class="page-pattern">
    <aside class="animate-right sidebar">
        <footer>
          <a class="sidebar-buttons" href="./search_medical_records.html" title="Visualizar prontuários">
            <img src="../../../public/styles/img/file-search.png" alt="Visualizar prontuários" />
          </a>
          <a class="sidebar-buttons" href="#" title="Listar Prontuários">
            <img src="../../../public/styles/img/list.svg" alt="Listar Prontuários" />
          </a>
          <a class="sidebar-buttons" href="../symptom/questionnaire_page.html" title="Questionário">
            <img src="../../../public/styles/img/questionnaire.svg" alt="Questionário" />
          </a>
          <a class="sidebar-buttons" href="../home_page.html" title="Home">
            <img src="../../../public/styles/img/home.svg" alt="Home" />
          </a>
        </footer>
      </aside>
      <main class="animate-appear with-sidebar">
        <?php
          include_once('../../utils/autoload.php');

          use app\controllers\MedicalRecordsController;
          use app\controllers\PatientController;
          use app\controllers\SymptomController;

          $medical_records_controller = new MedicalRecordsController();
          $patient_controller = new PatientController();
          $symptom_controller = new SymptomController();

          $cpf = $_POST["cpf"];

          if(isset($cpf)){  
            $medical_records = $medical_records_controller->fetchMedicalRecords($cpf);

            if($medical_records == null || !is_object($medical_records)){
        ?>
            <div class='info'>
              <p>Não há nenhum prontuário com o CPF: <?php echo "$cpf" ?> </p>
            </div>
        <?php 
            }else{
              $patient = $patient_controller->fetchPatient($cpf);

              if($patient == null || !is_object($patient)){
        ?>
                <div class='info'>
                  <p>Não há nenhum prontuário com o CPF: <?php echo "$cpf" ?> </p>
                </div>
        <?php 
              } else{
                  $symptoms = $symptom_controller->fetchSymptoms($cpf);
        ?>
                  <form>
                    <fieldset>
                      <legend>Dados Pessoais</legend>
                      <div class="input-block">
                        <label for="full_name">Nome</label>
                        <input id="full_name" value="<?php echo ($patient->getName()) ?>" disabled/>
                      </div>
                      <br>
                      <span class="line">
                        <span class="input-block">
                          <label for="cpf">CPF: </label>
                          <input id="cpf"  value="<?php echo ($patient->getCpf()) ?>"  disabled />
                        </span>
                        <span class="input-block">
                          <label  for="date_of_birth">Data de nascimento: </label>
                          <input id="date_of_birth" value="<?php echo ($patient->getDateOfBirth()) ?>" disabled />
                        </span>
                      </span>
                      <br>
                      <br>
                      <span class="line">
                        <span class="input-block">
                          <label for="genre">Gênero: </label>
                          <input id="genre" value="<?php echo ($patient->getGenre()) ?>" disabled />
                        </span>
                        <span class="input-block">
                          <label for="naturalness">Naturalidade: </label>
                          <input id="naturalness" value="<?php echo ($patient->getNaturalness()) ?>" disabled />
                        </span>
                      </span>
                      <br>
                      <br>
                      <div class="input-block">
                        <label for="mother_name">Nome da Mãe</label>
                        <input id="mother_name" value="<?php echo ($patient->getMotherName()) ?>" disabled/>
                      </div>
                      <div class="input-block">
                        <label for="companion">Acompanhante</label>
                        <input id="companion" value="<?php echo ($patient->getCompanion()) ?>" disabled/>
                      </div>
                      <div class="input-block">
                        <label for="patient_address">Endereço</label>
                        <input id="patient_address" value="<?php echo ($patient->getAddress()) ?>" disabled/>
                      </div>
                    </fieldset>
                    <fieldset>
                      <legend>Resultados</legend>
                      <div class="input-block">
                        <label for="start_date">Data de início dos sintomas</label>
                        <input id="start_date"  value="<?php echo ($medical_records->getStartDate()) ?>"  disabled/>
                      </div>
                      <br>
                      <span class="line">
                        <span class="input-block">
                          <label for="result">Resultado (%): </label>
                          <input id="result"  value="<?php echo (number_format($medical_records->getResult(), 2)) ?>"  disabled/>
                        </span>
                          <span class="input-block">
                            <label for="gravity">Gravidade: </label>
                            <input id="gravity"  value="<?php echo ($medical_records->getGravity()) ?>"  disabled/>
                          </span>
                        </span>
                    </fieldset>
                    <fieldset>
                      <legend>Sintomas</legend>
        <?php
                      if($symptoms == null || !is_array($symptoms)){
        ?>
                        <ul>
                          <li>Este paciente não possui nenhum sintoma de Dengue.</li>
                        </ul>        
        <?php 
                      }else{
                        foreach ($symptoms as $symptom) {
        ?>
                          <ul>
                            <li><?php echo ($symptom->getName());?></li>
                          </ul>
        <?php
                        }
                    }
        ?>
                    </fieldset>
                  </form>
        <?php
              }
            } 
          }else{
        ?>
            <div class='info'>
              <p>Você precisa inserir um CPF!</p>
            </div> 
        <?php
          }
        ?>
      </main>
    </div>
  </body>
</html>
