<html>
    <head>
		<title>Unidade de Saúde | Entrar</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="shortcut icon" href="#"> 
        <link
            rel="stylesheet"
            type="text/css"
            href="../styles/css/main.css"
        /> 
        <link
            rel="stylesheet"
            type="text/css"
            href="../styles/css/sidebar.css"
        />
        <link
            rel="stylesheet"
            type="text/css"
            href="../styles/css/animations.css"
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
                    <button class="sidebar-buttons" onclick="history.back()">
                        <img src="../styles/img/arrow-back.svg" alt="Voltar" />
                    </button>
                </footer>
            </aside> 
            <main class="animate-appear with-sidebar">
                <?php
                    include_once('../../app/utils/autoload.php');

                    use src\data\repository\Connection;

                    $conn = new Connection();

                    $username = $_POST["username"];
                    $password = $_POST["password"];
                    
                    $sql = 'SELECT * FROM user WHERE username = :username 
                            AND password = :password';

                    $stmt = $conn->connect()->prepare($sql);

                    $stmt->execute(array(
                        ':username' => $username,
                        ':password' => $password,
                    ));

                    $user = $stmt->fetchAll();

                    $conn = null;

                    if($user == null){
                ?>
                        <div class='info'>
                            <p>
                                ERRO AO TENTAR ACESSAR A PLATAFORMA
                                <br>
                                <br>
                                O usuário inserido não possui permissão para acessar a plataforma.
                            </p>
                        </div> 
                <?php
                    }else{
                        header('Location:../../app/pages/home_page.html');
                    }
                ?>
            </main> 
        </div>      
    </body>
</html>