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
          <button onclick="history.back()">
            <img src="../../../public/styles/img/arrow-back.svg" alt="Voltar" />
          </button>
        </footer>
      </aside>
      <main class="animate-appear with-sidebar">
        <?php
          include_once('../../utils/autoload.php');

          use app\controllers\MedicalRecordsController;

          $medical_records_controller = new MedicalRecordsController();

          $cpf = $_POST["cpf"];

          if(isset($cpf)){  
            $result = $medical_records_controller->fetchMedicalRecords($cpf);

            if($result == null || !is_object($result)){
        ?>
            <div class='info'>
              <p>Não há nenhum prontuário com o CPF: <?php echo "$cpf" ?> </p>
            </div>
        <?php 
            }else{
        ?>
            <form>
              <fieldset>
                <legend>Dados Pessoais</legend>
                <div class="input-block">
                  <label for="full_name">Nome</label>
                  <input id="full_name" disabled/>
                </div>
                <div class="input-block">
                  <label for="cpf">CPF</label>
                  <input id="cpf"  value="<?php echo ($result->getPatientCpf()) ?>"  disabled />
                </div>
                <div class="input-block">
                  <label  for="date_of_birth">Data de nascimento</label>
                  <input id="date_of_birth" disabled />
                </div>
                <br>
                <span class="line">
                    <span class="input-block">
                        <label for="genre">Gênero: </label>
                        <input id="genre" disabled />
                  </span>
                    <span class="input-block">
                        <label for="naturalness">Naturalidade: </label>
                        <input id="naturalness" disabled />
                    </span>
                </span>
                </fieldset>
                <fieldset>
                    <legend>Resultados</legend>
                    <div class="input-block">
                        <label for="start_date">Data de início dos sintomas</label>
                        <input id="start_date"  value="<?php echo ($result->getStartDate()) ?>"  disabled/>
                    </div>
                    <br>
                    <span class="line">
                        <span class="input-block">
                            <label for="result">Resultado (%): </label>
                            <input id="result"  value="<?php echo ($result->getResult()) ?>"  disabled/>
                        </span>
                        <span class="input-block">
                            <label for="gravity">Gravidade: </label>
                            <input id="gravity"  value="<?php echo ($result->getGravity()) ?>"  disabled/>
                        </span>
                    </span>
              </fieldset>
          </form>
        <?php
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
