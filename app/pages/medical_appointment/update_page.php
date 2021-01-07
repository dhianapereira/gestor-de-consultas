<html>
  <head>
    <title>Unidade de Saúde | Dados da Consulta</title>
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
      href="../../../public/styles/css/buttons.css"
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
  <script src="../../../public/scripts/script.js"></script>
  <body>
    <div class="page-pattern">
    <aside class="animate-right sidebar">
      <footer>
          <button class="sidebar-buttons" onclick="history.back()" title="Voltar">
            <img src="../../../public/styles/img/arrow-back.svg" alt="Voltar" />
          </button>
          <a class="sidebar-buttons" href="./consultation_page.html" title="Marcar Consulta">
            <img src="../../../public/styles/img/make-an-appointment.svg" alt="Marcar COnsulta" />
          </a>
          <a class="sidebar-buttons" href="./list_page.php" title="Lista de Atendimento">
            <img src="../../../public/styles/img/medical-appointments-list.svg" alt="Lista de Atendimento" />
          </a>
        </footer>
      </aside>
      <main class="animate-appear with-sidebar">
        <?php
          include_once('../../utils/autoload.php');

          use app\controllers\MedicalAppointmentController;

          $medical_appointment_controller = new MedicalAppointmentController();

          $id = $_POST["id"];

          if(isset($id)){  
            $medical_appointment = $medical_appointment_controller->fetchMedicalAppointment($id);    

            if($medical_appointment == null || !is_object($medical_appointment)){
        ?>
            <div class='info'>
              <p>Não há nenhuma consulta com o ID: <?php echo "$id" ?> </p>
            </div>
        <?php 
            }else{
        ?>
                <form method="POST" action="update_medical_appointment.php">
                    <fieldset>
                        <legend>Dados da Consulta</legend>
                        <div class="input-block">
                            <label for="id">ID</label>
                            <input id="id" value="<?php echo ($medical_appointment->getId()) ?>" disabled/>
                            <input
                                type="hidden"
                                name="id"
                                value="<?php echo ($medical_appointment->getId()) ?>"
                                required
                            />
                        </div>
                        <div class="input-block">
                            <label for="patient_cpf">Paciente</label>
                            <input id="patient_cpf" name="patient_cpf" value="<?php echo ($medical_appointment->getPatientCpf()) ?>" required/>
                        </div>
                        <div class="input-block">
                            <label for="doctor">Médico(a)</label>
                            <input id="doctor" value="<?php echo ($medical_appointment->getIdDoctor()[0]) ?>" disabled/>
                        </div>
                        <div class="input-block">
                            <label for="specialty">Especialidade</label>
                            <input id="specialty" name="specialty" value="<?php echo ($medical_appointment->getIdDoctor()[1]) ?>" required/>
                        </div>
                        <div class="input-block">
                            <label for="genre">Gênero</label>
                            <input
                                type="hidden"
                                name="genre"
                                id="genre"
                                value="<?php echo ($medical_appointment->getIdDoctor()[2]) ?>"
                                required
                            />

                            <div class="button-select">
                                <button
                                data-value="Feminino"
                                onclick="toggleGenre(event)"
                                type="button"
                                <?php
                                    if($medical_appointment->getIdDoctor()[2]=="Feminino"){
                                ?>
                                class="active-genre"
                                <?php
                                    }
                                ?>
                                >
                                Feminino
                                </button>
                                <button
                                data-value="Masculino"
                                onclick="toggleGenre(event)"
                                type="button"
                                <?php
                                    if($medical_appointment->getIdDoctor()[2]=="Masculino"){
                                ?>
                                class="active-genre"
                                <?php
                                    }
                                ?>
                                >
                                Masculino
                                </button>
                            </div>
                        </div>
                        <br>
                        <br>
                        <span class="line">
                            <span class="input-block">
                                <label for="date">Data: </label>
                                <input id="date" name="date" value="<?php echo ($medical_appointment->getDate())?>" required />
                            </span>
                            <span class="input-block">
                                <label for="time">Horário: </label>
                                <input id="time" name="time" value="<?php echo ($medical_appointment->getTime())?>" required />
                            </span>
                        </span>
                        <br>
                        <br>
                        <div class="input-block">
                            <label for="arrival_time">Horário de Chegada: </label>
                            <input id="arrival_time" name="arrival_time" value="<?php echo ($medical_appointment->getArrivalTime())?>" required />
                        </div>
                        <div class="input-block">
                            <label for="realized">Consulta realizada?</label>
                            <input
                                type="hidden"
                                name="active"
                                id="realized"
                                value="<?php echo ($medical_appointment->getRealized()) ?>"
                                required
                            />

                            <div class="button-select">
                                <button
                                data-value=1
                                onclick="toggleActive(event)"
                                type="button"
                                <?php
                                    if($medical_appointment->getRealized()==1){
                                ?>
                                class="active"
                                <?php
                                    }
                                ?>
                                >
                                Sim
                                </button>
                                <button
                                data-value=0
                                onclick="toggleActive(event)"
                                type="button"
                                <?php
                                    if($medical_appointment->getRealized()==0){
                                ?>
                                class="active"
                                <?php
                                    }
                                ?>
                                >
                                Não
                                </button>
                            </div>
                        </div>
                    </fieldset>
                                
                    <button type="submit" class="primary-button">Salvar Alterações</button>
                </form>
        <?php
            }
          }else{
        ?>
                <div class='info'>
                  <p>Você precisa inserir o ID da consulta!</p>
                </div> 
        <?php
            }
        ?>
      </main>
    </div>
  </body>
</html>
