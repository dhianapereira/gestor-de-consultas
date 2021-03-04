<?php
if (!isset($_SESSION["loggedUser"])) {
  header("Location: ./");
}
?>
<html>

<head>
  <title>Unidade de Saúde | Cadastro</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="./public/styles/img/doctors-list.svg" type="image/x-icon" />

  <link rel="stylesheet" type="text/css" href="./public/styles/css/main.css" />
  <link rel="stylesheet" type="text/css" href="./public/styles/css/home.css" />
  <link rel="stylesheet" type="text/css" href="./public/styles/css/buttons.css" />
  <link rel="stylesheet" type="text/css" href="./public/styles/css/form.css" />
  <link rel="stylesheet" type="text/css" href="./public/styles/css/card.css" />
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap" rel="stylesheet" />
</head>
<script src="./public/scripts/toggle.js"></script>

<body>
  <header>
    <h3 class="logo">Unidade de Saúde</h3>
  </header>
  <main class="container">
    <section class="quick-access">
      <a href="?page=user/list" class="home-button">
        <h3>
          <p>Listar Funcionários</p>
          <img src="./public/styles/img/list.svg" alt="Imagem de lista de funcionários" />
        </h3>
      </a>
      <a href="?page=user/search" class="home-button">
        <h3>
          <p>Procurar Funcionário</p>
          <img src="./public/styles/img/update-patient.svg" alt="Imagem de funcionário" />
        </h3>
      </a>
      <a href="?page=home" class="home-button">
        <h3>
          <p>Home</p>
          <img src="./public/styles/img/home.svg" alt="Imagem de Home" />
        </h3>
      </a>
    </section>
    <?php
    require_once "app/components/MessageContainer.php";

    if (isset($_SESSION["errorMessage"])) {
      MessageContainer::errorMessage("Mensagem de Erro", $_SESSION["errorMessage"]);
      $_SESSION["errorMessage"] = null;
    } else if (isset($_SESSION["successMessage"])) {
      MessageContainer::successMessage("Operação realizada", $_SESSION["successMessage"]);
      $_SESSION["successMessage"] = null;
    }
    ?>
    <section class="box">
      <div class="form">
        <h2>Dados Pessoais</h2>
        <form method="POST" action="?class=User&action=register">
          <div class="input-block">
            <label for="name">Nome</label>
            <input id="name" name="name" required />
          </div>

          <div class="input-block">
            <label for="cpf">CPF</label>
            <input id="cpf" name="cpf" required />
          </div>

          <div class="input-block">
            <label for="date_of_birth">Data de nascimento</label>
            <input type="date" id="date_of_birth" name="date_of_birth" required />
          </div>

          <div class="input-block">
            <label for="address">Endereço</label>
            <input id="address" name="address" required />
          </div>

          <div class="input-block">
            <label for="genre">Gênero</label>
            <input type="hidden" name="genre" id="genre" value="Feminino" required />

            <div class="button-select">
              <button data-value="Feminino" onclick="toggleGenre(event)" type="button" class="active-genre">
                Feminino
              </button>
              <button data-value="Masculino" onclick="toggleGenre(event)" type="button">
                Masculino
              </button>
            </div>
          </div>
          <div class="input-block">
            <label for="naturalness">Nacionalidade</label>
            <input type="hidden" name="naturalness" id="naturalness" value="Brasileiro(a)" required />

            <div class="button-select">
              <button data-value="Brasileiro(a)" onclick="toggleNaturalness(event)" type="button" class="active-naturalness">
                Brasileiro(a)
              </button>
              <button data-value="Estrangeiro(a)" onclick="toggleNaturalness(event)" type="button">
                Estrangeiro(a)
              </button>
            </div>
          </div>
          <div class="input-block">
            <label for="responsibility">Cargo</label>
            <input id="responsibility" name="responsibility" required />
          </div>

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