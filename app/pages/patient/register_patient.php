<html>
	<head>
		<title>Resultado | Unidade de Saúde</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="shortcut icon" href="#">
	</head>
    <body>
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
