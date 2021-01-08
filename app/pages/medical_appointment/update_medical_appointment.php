<html>
  <head>
    <title>Unidade de Saúde | Atualização</title>
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
          <a class="sidebar-buttons" href="./search_medical_appointment.html" title="Procurar Consulta">
            <img src="../../../public/styles/img/update-medical-appointment.svg" alt="Procurar Consulta" />
          </a>
          <a class="sidebar-buttons" href="./consultation_page.html" title="Marcar Consulta">
            <img src="../../../public/styles/img/make-an-appointment.svg" alt="Marcar Consulta" />
          </a>
          <a class="sidebar-buttons" href="./list_page.php" title="Listar Consultas">
            <img src="../../../public/styles/img/medical-appointments-list.svg" alt="Listar Consultas" />
          </a>
          <a class="sidebar-buttons" href="../home_page.html" title="Home">
            <img src="../../../public/styles/img/home.svg" alt="Home" />
          </a>
        </footer>
      </aside>
      <main class="animate-appear with-sidebar">
        <?php
          include_once('../../utils/autoload.php');

          use app\controllers\MedicalAppointmentController;
          use app\models\MedicalAppointment;

          $medical_appointment_controller = new MedicalAppointmentController();

          $id = $_POST["id"];
          $specialty = $_POST["specialty"];
          $genre = $_POST["genre"];
          $patient_cpf = $_POST["patient_cpf"];
          $date = $_POST["date"];
          $time = $_POST["time"];
          $arrival_time = $_POST["arrival_time"];
          $active = $_POST["active"];

          if(isset($id) && isset($specialty) && isset($genre) 
          && isset($patient_cpf) && isset($active) && isset($date) 
          && isset($time) && isset($arrival_time)){

            $medical_appointment = new MedicalAppointment($id, $patient_cpf,[$specialty, $genre],
            $date, $time, $arrival_time, $active);

            $result = $medical_appointment_controller->update($medical_appointment);

            if($result == null || !is_bool($result)){
        ?>
            <div class='info'>
                <p><?php echo "$result" ?></p>
            </div>
        <?php 
            }else{
        ?>
                <div class='info'>
                    <p>As atualizações foram realizadas com sucesso!</p>
                </div>  
        <?php
            }
          }else{
        ?>
                <div class='info'>
                  <p>Você precisa alterar alguma informação da consulta para que a operação seja realizada.</p>
                </div> 
        <?php
            }
        ?>
      </main>
    </div>
  </body>
</html>
