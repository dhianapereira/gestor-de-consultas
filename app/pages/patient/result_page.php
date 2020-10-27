<html>
	<head>
		<title>Unidade de Saúde | Cadastro</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="shortcut icon" href="#">
		<link rel="stylesheet" type="text/css" href="../../styles/main.css">
        <link rel="stylesheet" type="text/css" href="../../styles/form_style.css">
        
        <link
        href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap"
        rel="stylesheet"
        />
	</head>
    <body>
        <header>
            <div class="menu">
                <a href="../index.html">Home |</a>
                <a href="#">Questionário |</a>
                <a href="registration_form.html">Cadastrar Paciente |</a>
                <a href="#">Lista de Pacientes</a>
            </div>
        </header>
        <?php
            use app\controllers\PatientController;

            $patient_controller = new PatientController();

            $cpf = addslashes($_POST["cpf"]);
            $full_name = addslashes($_POST["full_name"]);
            $genre = $_POST["genre"];
            $date_of_birth = addslashes($_POST["date_of_birth"]);
            $mother_name = addslashes($_POST["mother_name"]);
            $naturalness = $_POST["naturalness"];

            if(!isset($cpf) || !isset($full_name)
             || !isset($genre) || !isset($date_of_birth) 
             || !isset($mother_name) || !isset($naturalness)){
        ?>
                <div id='info'>
                   <p>Você precisa preencher todos os campos para realizar esta operação!</p>
                </div> 
        <?php
            }
            else{

                $result = $patient_controller->registerPatient($cpf, $full_name, $genre, $date_of_birth, $mother_name, $naturalness);

                if(!is_object($result)){
        ?>
                    <div id='info'>
                        <p><?php echo "$result" ?></p>
                    </div>    
        <?php 
                } 
                else{
        ?>
                    <div id='info'>
                       <p>Seu cadastro foi realizado com sucesso!</p>
                    </div>    
        <?php 
                }
            }
        ?>
    </body>
</html>
