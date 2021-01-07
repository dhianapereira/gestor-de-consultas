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
                        <img src="../../../public/styles/img/make-an-appointment.svg" alt="Marcar uma nova consulta" />
                    </a>
                    <a class="sidebar-buttons" href="./list_page.php" title="Lista de Atendimento">
                        <img src="../../../public/styles/img/medical-appointments-list.svg" alt="Lista de Atendimento" />
                    </a>
                    <a class="sidebar-buttons" href="#" title="Atualizar Consulta">
                        <img src="../../../public/styles/img/update-medical-appointment.svg" alt="Atualizar Consulta" />
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
