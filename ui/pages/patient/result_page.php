<html>
	<head>
		<title>Unidade de Saúde | Cadastro</title>
        <meta charset="utf-8">
        <link rel="shortcut icon" href="#">
		<link rel="stylesheet" type="text/css" href="../../styles/form_style.css">
		<link rel="stylesheet" type="text/css" href="../../styles/style.css">
	</head>
	<header>
		<h1 class="title">Cadastrar Paciente</h1>
		<div class="menu">
			<a href="../index.html">Home |</a>
			<a href="../symptom/questionnaire.html">Questionário |</a>
			<a href="registration_form.html">Cadastrar Paciente |</a>
			<a href="list_page.php">Lista de Pacientes</a>
		</div>
    </header>
    <body>
        <?php

            include_once('../../../core/utils/autoload.php');

            
            use ui\bloc\PatientBloc;

            $patient_bloc = new PatientBloc();

            $cpf = $_POST["cpf"];
            $full_name = $_POST["full_name"];
            $genre = $_POST["genre"]; 
            $date_of_birth = $_POST["date_of_birth"];
            $mother_name = $_POST["mother_name"];
            $naturalness = $_POST["naturalness"];

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
        <?php }
        ?>
    </body>
</html>
