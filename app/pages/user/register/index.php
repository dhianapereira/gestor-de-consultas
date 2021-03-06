<?php
if (!isset($_SESSION["loggedUser"])) {
  header("Location: ./");
}

require_once "app/components/MessageContainer.php";
require_once "app/components/Base.php";
?>
<html>

<head>
  <?php Base::head("Cadastro | Unidade de Saúde"); ?>
  <link rel="stylesheet" type="text/css" href="./public/styles/css/form.css" />
</head>
<script src="./public/scripts/toggle.js"></script>

<body>
  <?php Base::header(); ?>
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
              <button data-value="Feminino" onclick="toggle(event, 'active-genre', 'genre')" type="button" class="active-genre">
                Feminino
              </button>
              <button data-value="Masculino" onclick="toggle(event, 'active-genre', 'genre')" type="button">
                Masculino
              </button>
            </div>
          </div>
          <div class="input-block">
            <label for="naturalness">Nacionalidade</label>
            <input type="hidden" name="naturalness" id="naturalness" value="Brasileiro(a)" required />

            <div class="button-select">
              <button data-value="Brasileiro(a)" onclick="toggle(event, 'active-naturalness', 'naturalness')" type="button" class="active-naturalness">
                Brasileiro(a)
              </button>
              <button data-value="Estrangeiro(a)" onclick="toggle(event, 'active-naturalness', 'naturalness')" type="button">
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
  <?php Base::footer(); ?>
</body>

</html>