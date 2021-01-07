<html>
	<head>
		<title>Unidade de Saúde | Cadastro</title>
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
                    <a class="sidebar-buttons" href="./register_page.html" title="Cadastrar Médico(a)">
                        <img src="../../../public/styles/img/add-doctor.svg" alt="Cadastrar Médico(a)" />
                    </a>
                    <a class="sidebar-buttons" href="./list_page.php" title="Listar Médicos">
                        <img src="../../../public/styles/img/doctors-list.svg" alt="Listar Médicos" />
                    </a>
                    <a class="sidebar-buttons" href="./search_doctor.html" title="Procurar Médico(a)">
                        <img src="../../../public/styles/img/doctor.svg" alt="Procurar Médico(a)" />
                    </a>
                    <a class="sidebar-buttons" href="../home_page.html" title="Home">
                        <img src="../../../public/styles/img/home.svg" alt="Home" />
                    </a>
                </footer>
            </aside>
            <main class="animate-appear with-sidebar">
                <?php
                    include_once('../../utils/autoload.php');

                    use app\controllers\DoctorController;

                    $doctor_controller = new DoctorController();

                    $name = $_POST["name"];
                    $genre = $_POST["genre"];
                    $specialty = $_POST["specialty"];
                    
                    if(!isset($specialty) || !isset($name) || !isset($genre)){
                ?>
                        <div class='info'>
                        <p>Você precisa preencher todos os campos para realizar esta operação!</p>
                        </div> 
                <?php
                    }
                    else{

                        $result = $doctor_controller->register($name, $genre, $specialty);

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
                            <p>O cadastro foi realizado com sucesso!</p>
                            </div>    
                <?php 
                        }
                    }
                ?>
            </main>
        </div>
    </body>
</html>
