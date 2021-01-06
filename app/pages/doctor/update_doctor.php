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
          <a class="sidebar-buttons" href="./search_medical_records.html" title="Visualizar prontuários">
            <img src="../../../public/styles/img/file-search.png" alt="Visualizar prontuários" />
          </a>
          <a class="sidebar-buttons" href="../patient/register_page.html" title="Cadastrar um novo paciente">
            <img src="../../../public/styles/img/plus.svg" alt="Cadastrar um novo paciente" />
          </a>
          <a class="sidebar-buttons" href="../patient/list_page.php" title="Lista de pacientes">
            <img src="../../../public/styles/img/list.svg" alt="Lista de pacientes" />
          </a>
          <a class="sidebar-buttons" href="../symptom/questionnaire_page.html" title="Questionário">
            <img src="../../../public/styles/img/questionnaire.svg" alt="Questionário" />
          </a>
        </footer>
      </aside>
      <main class="animate-appear with-sidebar">
        <?php
          include_once('../../utils/autoload.php');

          use app\controllers\DoctorController;
          use app\models\Doctor;

          $doctor_controller = new DoctorController();

          $id = $_POST["id"];
          $specialty = $_POST["specialty"];
          $genre = $_POST["genre"];
          $name = $_POST["name"];
          $active = $_POST["active"];

          if(isset($id) && isset($specialty) && isset($genre) && isset($name) && isset($active)){  
            $doctor = new Doctor($id, $name, $genre, $specialty, $active);

            $result = $doctor_controller->update($doctor);    

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
                  <p>Você precisa alterar alguma informação do médico para que a operação seja realizada.</p>
                </div> 
        <?php
            }
        ?>
      </main>
    </div>
  </body>
</html>
