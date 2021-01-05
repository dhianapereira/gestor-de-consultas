<html>
	<head>
		<title>Unidade de Saúde | Marcar consulta</title>
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
                    <a class="sidebar-buttons" href="./consultation_page.html" title="Marcar uma nova consulta">
                        <img src="../../../public/styles/img/plus.svg" alt="Marcar uma nova consulta" />
                    </a>
                    <a class="sidebar-buttons" href="../doctor/register_page.html" title="Cadastrar um novo médico(a)">
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

                    use app\controllers\MedicalAppointmentController;

                    $medical_appointment_controller = new MedicalAppointmentController();

                    $patient_cpf = $_POST["patient_cpf"];
                    $specialty = $_POST["specialty"];
                    $genre = $_POST["genre"];
                    $date = $_POST["date"];
                    $time = $_POST["time"];
                    
                    if(!isset($specialty) || !isset($patient_cpf) || !isset($genre)
                    || !isset($date) || !isset($time)){
                ?>
                        <div class='info'>
                        <p>Você precisa preencher todos os campos para realizar esta operação!</p>
                        </div> 
                <?php
                    }
                    else{

                        $result = $medical_appointment_controller->makeAnAppointment($patient_cpf, 
                        $genre, $specialty, $date, $time);

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
                            <p>A consulta foi marcada com sucesso!</p>
                            </div>    
                <?php 
                        }
                    }
                ?>
            </main>
        </div>
    </body>
</html>
