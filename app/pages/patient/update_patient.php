<html>
<head>
<title>Unidade de Saúde | Atualização</title>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="shortcut icon" href="../../../public/styles/img/doctors-list.svg" type="image/x-icon" />
  <link rel="stylesheet" type="text/css" href="../../../public/styles/css/main.css" />
  <link rel="stylesheet" type="text/css" href="../../../public/styles/css/buttons.css" />
  <link rel="stylesheet" type="text/css" href="../../../public/styles/css/form.css" />
  <link rel="stylesheet" type="text/css" href="../../../public/styles/css/card.css" />
  <link rel="stylesheet" type="text/css" href="../../../public/styles/css/home.css" />
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap" rel="stylesheet" />
</head>
<body>
  <header>
    <h3 class="logo">Unidade de Saúde</h3>
  </header>
  <main class="container">
    <section class="quick-access">

        <a href="search_patient.html" class="home-button">
            <h3>
                <p>Procurar Paciente</p>
                <img src="../../../public/styles/img/update-patient.svg" alt="Imagem de paciente"/>
            </h3>
        </a>
        <a href="register_page.html" class="home-button">
            <h3>
                 <p>Cadastrar Paciente</p>
                 <img src="../../../public/styles/img/plus.svg" alt="Imagem de cadastro de pacientes" />
            </h3>
        </a>
        <a href="./list_page.php" class="home-button">
            <h3>
               <p>Listar Paciente</p>
               <img src="../../../public/styles/img/doctors-list.svg" alt="Imagem de lista de pacientes"/>
            </h3>
        </a>
      <a href="../home_page.php" class="home-button">
        <h3>
          <p>Home</p>
          <img src="../../../public/styles/img/home.svg" alt="Imagem de Home" />
        </h3>
      </a>
    </section>
    <section class="box">
    <?php
      include_once('../../utils/autoload.php');

      spl_autoload_register("autoload");

      use app\controllers\PatientController;
      use app\models\Patient;

      $patient_controller = new PatientController();
      $cpf = $_POST["cpf"];
      $full_name = $_POST["full_name"];
      echo $full_name;
      $date_of_birth = $_POST["date_of_birth"];
      echo $date_of_birth;
      $mother_name = $_POST["mother_name"];
      echo $mother_name;
      $genre = $_POST["genre"];
      echo $genre;
      $companion = $_POST["companion"];
      echo $companion;
      $address = $_POST["address"];
      echo $address;
      $naturalness = $_POST["naturalness"];
      echo $naturalness;
      
      if (isset($cpf) && isset($full_name) && isset($genre) && isset($date_of_birth) && isset($mother_name)
        && isset($companion)&& isset($address)&& isset($naturalness)) {
        $patient = new Patient($cpf, $full_name, $genre, $date_of_birth, $mother_name,$companion,$address,$naturalness);

        $result = $patient_controller->update($patient);

        if ($result == null || !is_bool($result)) {
      ?>
          <div class="card">
            <h3>
              <span>Mensagem de Erro</span>
              <img src="../../../public/styles/img/error.svg" alt="Imagem de mensagem de erro">
            </h3>
            <p><?php echo "$result" ?></p>
          </div>
        <?php
        } else {
        ?>
          <div class="card">
            <h3>
              <span>Operação realizada</span>
              <img src="../../../public/styles/img/success.svg" alt="Imagem de mensagem de sucesso">
            </h3>
            <p>As atualizações foram realizadas com sucesso!</p>
          </div>
        <?php
        }
      } else {
        ?>
        <div class="card">
          <h3>
            <span>Não foi possível realizar esta operação</span>
            <img src="../../../public/styles/img/error.svg" alt="Imagem de mensagem de erro">
          </h3>
          <p>Você precisa alterar alguma informação para que a operação seja realizada.</p>
        </div>
      <?php
      }

    ?>   

    </section>
</body>
</html>