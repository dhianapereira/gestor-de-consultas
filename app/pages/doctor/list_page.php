<html>
    <head>
		<title>Unidade de Saúde | Lista de Médicos</title>
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
                    <a class="sidebar-buttons" href="./register_page.html" title="Cadastrar Médico(a)">
                        <img src="../../../public/styles/img/add-doctor.svg" alt="Cadastrar Médico(a)" />
                    </a>
                    <a class="sidebar-buttons" href="./search_doctor.html" title="Procurar Médico(a)">
                        <img src="../../../public/styles/img/doctor.svg" alt="Procurar Médico(a)" />
                    </a>
                </footer>
            </aside>
            <main class="animate-appear with-sidebar">
                <div id="list-container">
                    <?php
                        include_once('../../utils/autoload.php');
                        
                        use app\controllers\DoctorController;

                        $doctor_controller = new DoctorController();

                        $doctor_list = $doctor_controller->allDoctors();

                        if($doctor_list!=null && is_array($doctor_list)){

                    ?>
                            <table>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Gênero</th>
                                    <th>Especialidade</th>
                                    <th>Status</th>
                            </tr>
                    <?php
                        foreach ($doctor_list as $doctor) {
                    ?>
                            <tr>
                                <td><?php echo ($doctor->getId());?></td>
                                <td><?php echo ($doctor->getName());?></td>
                                <td><?php echo ($doctor->getGenre());?></td>
                                <td><?php echo ($doctor->getSpecialty());?></td>
                                <td><?php echo ($doctor->getActive());?></td>
                            </tr>
                    <?php
                        }
                    ?>   
                            </table>
                    <?php
                        }else{
                    ?>
                            <p>
                                A lista de médicos está vazia.
                            </p> 
                    <?php
                        }
                    ?> 
                </div>
            </main>
        </div>
    </body>
</html>
