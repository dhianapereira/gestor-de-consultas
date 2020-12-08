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
        <div class="page-pattern">
            <aside class="animate-right sidebar">
                <footer>
                    <button class="sidebar-buttons" onclick="history.back()" title="Voltar">
                        <img src="../../../public/styles/img/arrow-back.svg" alt="Voltar" />
                    </button>
                    <a class="sidebar-buttons" href="./register_page.html" title="Cadastrar um novo paciente">
                        <img src="../../../public/styles/img/plus.svg" alt="Cadastrar um novo paciente" />
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
                <div id="list-container">
                    <?php
                        include_once('../../utils/autoload.php');
                        
                        use app\controllers\PatientController;

                        $patient_controller = new PatientController();

                        $patient_list = $patient_controller->allPatients();

                        if($patient_list!=null && is_array($patient_list)){

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
                        foreach ($patient_list as $patient) {
                    ?>
                            <tr>
                                <td><?php echo ($patient->getCpf());?></td>
                                <td><?php echo ($patient->getName());?></td>
                                <td><?php echo ($patient->getGenre());?></td>
                                <td><?php echo ($patient->getDateOfBirth());?></td>
                                <td><?php echo ($patient->getMotherName());?></td>
                                <td><?php echo ($patient->getCompanion());?></td>
                                <td><?php echo ($patient->getAddress());?></td>
                                <td><?php echo ($patient->getNaturalness());?></td>
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
