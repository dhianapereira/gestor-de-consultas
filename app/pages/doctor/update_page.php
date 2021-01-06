<html>
  <head>
    <title>Unidade de Saúde | Dados do Médico(a)</title>
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

          $doctor_controller = new DoctorController();

          $id = $_POST["id"];

          if(isset($id)){  
            $doctor = $doctor_controller->fetchDoctor($id);    

            if($doctor == null || !is_object($doctor)){
        ?>
            <div class='info'>
              <p>Não há nenhum médico com o ID: <?php echo "$id" ?> </p>
            </div>
        <?php 
            }else{
        ?>
                <form method="POST" action="update_doctor.php">
                    <fieldset>
                        <legend>Dados do Médico(a)</legend>
                        <div class="input-block">
                            <label for="id">ID</label>
                            <input id="id" value="<?php echo ($doctor->getId()) ?>" disabled/>
                            <input
                                type="hidden"
                                name="id"
                                value="<?php echo ($doctor->getId()) ?>"
                                required
                            />
                        </div>
                        <div class="input-block">
                            <label for="name">Nome</label>
                            <input id="name" name="name" value="<?php echo ($doctor->getName()) ?>" required/>
                        </div>
                        <div class="input-block">
                            <label for="specialty">Especialidade</label>
                            <input id="specialty" name="specialty" value="<?php echo ($doctor->getSpecialty()) ?>" required/>
                        </div>
                        <div class="input-block">
                            <label for="genre">Gênero</label>
                            <input
                                type="hidden"
                                name="genre"
                                id="genre"
                                value="<?php echo ($doctor->getGenre()) ?>"
                                required
                            />

                            <div class="button-select">
                                <button
                                data-value="Feminino"
                                onclick="toggleGenre(event)"
                                type="button"
                                <?php
                                    if($doctor->getGenre()=="Feminino"){
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
                                    if($doctor->getGenre()=="Masculino"){
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
                        <div class="input-block">
                            <label for="active">Status</label>
                            <input
                                type="hidden"
                                name="active"
                                id="active"
                                value="<?php echo ($doctor->getActive()) ?>"
                                required
                            />

                            <div class="button-select">
                                <button
                                data-value=1
                                onclick="toggleActive(event)"
                                type="button"
                                <?php
                                    if($doctor->getActive()==1){
                                ?>
                                class="active-doctor"
                                <?php
                                    }
                                ?>
                                >
                                Ativo
                                </button>
                                <button
                                data-value=0
                                onclick="toggleActive(event)"
                                type="button"
                                <?php
                                    if($doctor->getActive()==0){
                                ?>
                                class="active-doctor"
                                <?php
                                    }
                                ?>
                                >
                                Inativo
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
                  <p>Você precisa inserir um ID!</p>
                </div> 
        <?php
            }
        ?>
      </main>
    </div>
  </body>
</html>
