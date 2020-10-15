<html>
	<head>
		<title>Unidade de Saúde | Cadastro</title>
        <meta charset="utf-8">
        <link rel="shortcut icon" href="#">
		<link rel="stylesheet" type="text/css" href="../../styles/main.css">
		<link rel="stylesheet" type="text/css" href="../../styles/form_style.css">
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

            include_once('../../../core/utils/autoload.php');

            
            use ui\bloc\PatientBloc;

            $patient_bloc = new PatientBloc();

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
                    <br>
                    <br>
                    Você precisa preencher todos os campos para realizar esta operação!
                    <br>
                    <br>
                </div> 
        <?php
            }
            else{

                $result = $patient_bloc->registerPatient($cpf, $full_name, $genre, $date_of_birth, $mother_name, $naturalness);

                if(!is_object($result)){
        ?>
                    <div id='info'>
                        <br>
                        <br>
                        <?php echo "$result" ?>  
                        <br>
                        <br>
                    </div>    
        <?php 
                } 
                else{
        ?>
                    <div id='info'>
                        <br>
                        <br>
                        Seu cadastro foi realizado com sucesso!
                        <br>
                        <br>
                    </div>    
        <?php 
                }
            }
        ?>
    </body>
</html>
