<html>
    <head>
		<title>Unidade de Saúde | Lista de Atendimento</title>
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
                        
                        use app\controllers\MedicalAppointmentController;

                        $medical_appointment_controller = new MedicalAppointmentController();

                        $medical_appointment_list = $medical_appointment_controller->allMedicalAppointments();

                        if($medical_appointment_list!=null && is_array($medical_appointment_list)){

                    ?>
                            <table>
                                <tr>
                                    <th>ID</th>
                                    <th>Paciente</th>
                                    <th>Médico(a)</th>
                                    <th>Data e Horário</th>
                                    <th>Horário de chegada</th>
                                    <th>Consulta Realizada</th>
                            </tr>
                    <?php
                        foreach ($medical_appointment_list as $medical_appointment) {
                    ?>
                            <tr>
                                <td><?php echo ($medical_appointment->getId());?></td>
                                <td><?php echo ($medical_appointment->getPatientCpf());?></td>
                                <td><?php echo ($medical_appointment->getIdDoctor());?></td>
                                <td><?php echo ($medical_appointment->getDate().' - '.$medical_appointment->getTime());?></td>
                                <td><?php echo ($medical_appointment->getArrivalTime());?></td>
                                <td><?php echo ($medical_appointment->getRealized());?></td>
                            </tr>
                    <?php
                        }
                    ?>   
                            </table>
                    <?php
                        }else{
                    ?>
                            <p>
                                A lista de consultas está vazia.
                            </p> 
                    <?php
                        }
                    ?> 
                </div>
            </main>
        </div>
    </body>
</html>
