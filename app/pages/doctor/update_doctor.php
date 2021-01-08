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
          <a class="sidebar-buttons" href="./search_doctor.html" title="Procurar Médico(a)">
            <img src="../../../public/styles/img/doctor.svg" alt="Procurar Médico(a)" />
          </a>
          <a class="sidebar-buttons" href="./register_page.html" title="Cadastrar Médico(a)">
            <img src="../../../public/styles/img/add-doctor.svg" alt="Cadastrar Médico(a)" />
          </a>
          <a class="sidebar-buttons" href="./list_page.php" title="Listar Médicos">
            <img src="../../../public/styles/img/doctors-list.svg" alt="Listar Médicos" />
          </a>
          <a class="sidebar-buttons" href="../home_page.html" title="Home">
            <img src="../../../public/styles/img/home.svg" alt="Home" />
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
                  <p>Você precisa alterar alguma informação para que a operação seja realizada.</p>
                </div> 
        <?php
            }
        ?>
      </main>
    </div>
  </body>
</html>
