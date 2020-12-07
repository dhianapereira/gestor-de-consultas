<html>
	<head>
		<title>Unidade de Saúde | Questionário</title>
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
            href="../../../public/styles/css/symptom_page.css"
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
        <div id="questionnaire-php">
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

                    use app\controllers\SymptomController;

                    $symptom_controller = new SymptomController();

                    $patient_cpf = $_POST["patient_cpf"];
                    $start_date = $_POST["start_date"];
                    $symptoms = $_POST["symptom"];

                    echo(">>>>>>>>>>>>>>>>>>>>>>>>>>>>>>$symptom[0]");

                    if(!isset($patient_cpf) || !isset($start_date)){
                ?>
                        <div class='info'>
                            <p>Você precisa preencher os campos de informações importantes!</p>
                        </div> 
                <?php
                    }
                    else{

                        $result = $symptom_controller->addSymptoms($patient_cpf, $symptoms);

                        if(!is_bool($result)){
                ?>
                            <div class='info'>
                                <p><?php echo "$result" ?></p>
                            </div>    
                <?php 
                        } 
                        else{
                            header('Location:../home_page.html');
                        }
                    }
                ?>
            </main>
        </div>
    </body>
</html>
