<html>

<head>
  <title>Unidade de Saúde | Dados do Médico(a)</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="../../../public/styles/img/doctors-list.svg" type="image/x-icon" />
  <link rel="stylesheet" type="text/css" href="../../../public/styles/css/main.css" />
  <link rel="stylesheet" type="text/css" href="../../../public/styles/css/home.css" />
  <link rel="stylesheet" type="text/css" href="../../../public/styles/css/buttons.css" />
  <link rel="stylesheet" type="text/css" href="../../../public/styles/css/form.css" />
  <link rel="stylesheet" type="text/css" href="../../../public/styles/css/card.css" />
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap" rel="stylesheet" />
</head>
<script src="../../../public/scripts/script.js"></script>

<body>

  <header>
    <h3 class="logo">Unidade de Saúde</h3>
  </header>
  <main class="container">
    <section class="quick-access">

      <a href="./search_doctor.html" class="home-button">
        <h3>
          <p>Procurar Médico(a)</p>
          <img src="../../../public/styles/img/doctor.svg" alt="Imagem de pesquisa" />
        </h3>
      </a>
      <a href="./register_page.html" class="home-button">
        <h3>
          <p>Cadastrar Médico(a)</p>
          <img src="../../../public/styles/img/add-doctor.svg" alt="Imagem de cadastro de médicos" />
        </h3>
      </a>
      <a href="./list_page.php" class="home-button">
        <h3>
          <p>Listar Médicos</p>
          <img src="../../../public/styles/img/doctors-list.svg" alt="Imagem de lista de médicos" />
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
        <?php
        include_once('../../utils/autoload.php');

        spl_autoload_register("autoload");

        use app\controllers\DoctorController;

        $doctor_controller = new DoctorController();

        $id = $_POST["id"];

        if (isset($id)) {
          $doctor = $doctor_controller->fetchDoctor($id);

          if ($doctor == null || !is_object($doctor)) {
        ?>
            <div class="card">
              <h3>
                <span>Mensagem de Erro</span>
                <img src="../../../public/styles/img/error.svg" alt="Imagem de mensagem de erro">
              </h3>
              <p>Não há nenhum médico com o ID: <?php echo "$id" ?> </p>
            </div>
          <?php
          } else {
          ?>
            <h2>Dados do Médico(a)</h2>
            <form method="POST" action="update_doctor.php">
              <div class="input-block">
                <label for="id">ID</label>
                <input id="id" value="<?php echo ($doctor->getId()) ?>" disabled />
                <input type="hidden" name="id" value="<?php echo ($doctor->getId()) ?>" required />
              </div>
              <div class="input-block">
                <label for="name">Nome</label>
                <input id="name" name="name" value="<?php echo ($doctor->getName()) ?>" required />
              </div>
              <div class="input-block">
                <label for="specialty">Especialidade</label>
                <input id="specialty" name="specialty" value="<?php echo ($doctor->getSpecialty()) ?>" required />
              </div>
              <div class="input-block">
                <label for="genre">Gênero</label>
                <input type="hidden" name="genre" id="genre" value="<?php echo ($doctor->getGenre()) ?>" required />

                <div class="button-select">
                  <button data-value="Feminino" onclick="toggleGenre(event)" type="button" <?php
                                                                                            if ($doctor->getGenre() == "Feminino") {
                                                                                            ?> class="active-genre" <?php
                                                                                                                  }
                                                                                                                    ?>>
                    Feminino
                  </button>
                  <button data-value="Masculino" onclick="toggleGenre(event)" type="button" <?php
                                                                                            if ($doctor->getGenre() == "Masculino") {
                                                                                            ?> class="active-genre" <?php
                                                                                                                  }
                                                                                                                    ?>>
                    Masculino
                  </button>
                </div>
              </div>
              <div class="input-block">
                <label for="active">Status</label>
                <input type="hidden" name="active" id="active" value="<?php echo ($doctor->getActive()) ?>" required />

                <div class="button-select">
                  <button data-value=1 onclick="toggleActive(event)" type="button" <?php
                                                                                    if ($doctor->getActive() == 1) {
                                                                                    ?> class="active" <?php
                                                                                                    }
                                                                                                      ?>>
                    Ativo
                  </button>
                  <button data-value=0 onclick="toggleActive(event)" type="button" <?php
                                                                                    if ($doctor->getActive() == 0) {
                                                                                    ?> class="active" <?php
                                                                                                    }
                                                                                                      ?>>
                    Inativo
                  </button>
                </div>
              </div>
              <button type="submit" class="primary-button">Salvar Alterações</button>
            </form>
          <?php
          }
        } else {
          ?>
          <div class="card">
            <h3>
              <span>Não foi possível realizar esta operação</span>
              <img src="../../../public/styles/img/error.svg" alt="Imagem de mensagem de erro">
            </h3>
            <p>Você precisa inserir um ID!</p>
          </div>
        <?php
        }
        ?>
      </div>
    </section>
  </main>

  <footer>
    <p>2021 - Unidade de Saúde</p>
  </footer>
</body>

</html>