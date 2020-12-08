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
                    <a class="sidebar-buttons" href="./register_page.html" title="Cadastrar um novo paciente">
                        <img src="../../../public/styles/img/plus.svg" alt="Cadastrar um novo paciente" />
                    </a>
                    <a class="sidebar-buttons" href="./list_page.php" title="Lista de pacientes">
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

                    use app\controllers\PatientController;

                    $patient_controller = new PatientController();

                    $cpf = addslashes($_POST["cpf"]);
                    $full_name = addslashes($_POST["full_name"]);
                    $genre = $_POST["genre"];
                    $date_of_birth = addslashes($_POST["date_of_birth"]);
                    $mother_name = addslashes($_POST["mother_name"]);
                    $companion = addslashes($_POST["companion"]);
                    $patient_address = addslashes($_POST["patient_address"]);
                    $naturalness = $_POST["naturalness"];

                    if(!isset($cpf) || !isset($full_name)
                    || !isset($genre) || !isset($date_of_birth) 
                    || !isset($mother_name) || !isset($companion)
                    || !isset($patient_address) || !isset($naturalness)){
                ?>
                        <div class='info'>
                        <p>Você precisa preencher todos os campos para realizar esta operação!</p>
                        </div> 
                <?php
                    }
                    else{

                        $result = $patient_controller->registerPatient($cpf, $full_name, 
                        $genre, $date_of_birth, $mother_name, $companion, $patient_address,
                        $naturalness);

                        if(!is_object($result)){
                ?>
                            <div class='info'>
                                <p><?php echo "$result" ?></p>
                            </div>    
                <?php 
                        } 
                        else{
                ?>
                            <div class='info'>
                            <p>O cadastro do paciente foi realizado com sucesso!</p>
                            </div>    
                <?php 
                        }
                    }
                ?>
            </main>
        </div>
    </body>
</html>
