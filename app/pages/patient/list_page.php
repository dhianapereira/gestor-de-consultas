<html>
    <head>
		<title>Unidade de Saúde | Lista</title>
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
            rel="stylesheet"
            type="text/css"
            href="../../../public/styles/css/table.css"
        />
        <link
            rel="stylesheet"
            type="text/css"
            href="../../../public/styles/css/list_page.css"
        />
        <link
            href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap"
            rel="stylesheet"
        />
	</head>
    <body>
        <div id="patient-list">
            <aside class="animate-right sidebar">
                <footer>
                <button onclick="history.back()">
                    <img src="../../../public/styles/img/arrow-back.svg" alt="Voltar" />
                </button>
                </footer>
            </aside>
            <main class="animate-appear with-sidebar">
                <div class="list-container">
                    <?php
                        include_once('../../utils/autoload.php');
                        
                        use app\controllers\PatientController;

                        $patient_controller = new PatientController();

                        $result = $patient_controller->allPatients();

                        if($result!=null && is_array($result)){

                    ?>
                            <table>
                                <tr>
                                    <th>CPF</th>
                                    <th>Nome Completo</th>
                                    <th>Gênero</th>
                                    <th>Data de nascimento</th>
                                    <th>Nome da Mãe</th>
                                    <th>Acompanhante</th>
                                    <th>Endereço</th>
                                    <th>Naturalidade</th>
                            </tr>
                    <?php
                        foreach ($result as $row) {
                    ?>
                            <tr>
                                <td><?php echo $row['cpf'];?></td>
                                <td><?php echo $row['full_name'];?></td>
                                <td><?php echo $row['genre'];?></td>
                                <td><?php echo $row['date_of_birth'];?></td>
                                <td><?php echo $row['mother_name'];?></td>
                                <td><?php echo $row['companion'];?></td>
                                <td><?php echo $row['patient_address'];?></td>
                                <td><?php echo $row['naturalness'];?></td>
                            </tr>
                    <?php
                        }
                    ?>   
                            </table>
                    <?php
                        }
                    ?> 
                </div>
            </main>
        </div>
    </body>
</html>
