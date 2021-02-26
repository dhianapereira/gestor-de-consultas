<!DOCTYPE htm>
<html>

<head>
  <title>Unidade de Saúde | Sintomas</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width initial-scale=1.0" />
  <link rel="shortcut icon" href="../../../public/styles/img/doctors-list.svg" type="image/x-icon" />
  <link rel="stylesheet" type="text/css" href="../../../public/styles/css/main.css" />
  <link rel="stylesheet" type="text/css" href="../../../public/styles/css/form.css" />
  <link rel="stylesheet" type="text/css" href="../../../public/styles/css/buttons.css" />
  <link rel="stylesheet" type="text/css" href="../../../public/styles/css/home.css" />
  <link rel="stylesheet" type="text/css" href="../../../public/styles/css/select.css" />
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap" rel="stylesheet" />
</head>

<body>
  <header>
    <h3 class="logo">Unidade de Saúde</h3>
  </header>
  <main class="container">
    <section class="quick-access">
      <a href="../symptom/questionnaire_page.html" class="home-button">
        <h3>
          <p>Questionário (Dengue)</p>
          <img src="../../../public/styles/img/questionnaire.svg" alt="Imagem de questionário" />
        </h3>
      </a>
      <a href="./list_page.php" class="home-button">
        <h3>
          <p>Listar Prontuários</p>
          <img src="../../../public/styles/img/medical-records-list.svg" alt="imagem da lista de prontuários" />
        </h3>
      </a>
      <a href="./search_medical_records.html" class="home-button">
        <h3>
          <p>Procurar Prontuário</p>
          <img src="../../../public/styles/img/file-search.png" alt="Imagem de Prontuário" />
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
      <div class="form">
        <h2>Pesquisa por Mês</h2>
        <form method="POST" action="symptoms_list.php">
          <?php
          include_once('../../utils/autoload.php');
          include_once('../../utils/constants.php');

          spl_autoload_register("autoload");

          use app\components\SelectionBox;

          SelectionBox::months($months);

          ?>

          <button type="submit" class="primary-button">Confirmar</button>
        </form>
      </div>
    </section>
  </main>

  <footer>
    <p>2021 - Unidade de Saúde</p>
  </footer>
</body>

</html>