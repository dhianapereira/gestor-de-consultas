<html>
	<head>
		<title>Unidade de Saúde | Cadastro</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="shortcut icon" href="#"> 
        <link
            rel="stylesheet"
            type="text/css"
            href="../../../public/styles/css/main.css"
        />
        <link
            rel="stylesheet"
            type="text/css"
            href="../../../public/styles/css/sidebar.css"
        />
        <link
            rel="stylesheet"
            type="text/css"
            href="../../../public/styles/css/animations.css"
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
                    <a class="sidebar-buttons" href="./register_page.html" title="Cadastrar um novo médico(a)">
                        <img src="../../../public/styles/img/plus.svg" alt="Cadastrar um novo médico(a)" />
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
                    <a class="sidebar-buttons" href="../medical_records/search_medical_records.html" title="Visualizar prontuários">
                        <img src="../../../public/styles/img/file-search.png" alt="Visualizar prontuários" />
                    </a>
                </footer>
            </aside>
            <main class="animate-appear with-sidebar">
                <?php
                    include_once('../../utils/autoload.php');

                    use app\controllers\DoctorController;

                    $doctor_controller = new DoctorController();

                    $name = $_POST["name"];
                    $genre = $_POST["genre"];
                    $specialty = $_POST["specialty"];
                    
                    if(!isset($specialty) || !isset($name) || !isset($genre)){
                ?>
                        <div class='info'>
                        <p>Você precisa preencher todos os campos para realizar esta operação!</p>
                        </div> 
                <?php
                    }
                    else{

                        $result = $doctor_controller->register($name, $genre, $specialty);

                        if(!is_bool($result)){
                ?>
                            <div class='info'>
                                <p><?php echo "$result" ?></p>
                            </div>    
                <?php 
                        } 
                        else{
                ?>
                            <div class='info'>
                            <p>O cadastro foi realizado com sucesso!</p>
                            </div>    
                <?php 
                        }
                    }
                ?>
            </main>
        </div>
    </body>
</html>
