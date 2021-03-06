<?php
require_once "app/components/MessageContainer.php";
require_once "app/components/Base.php";
?>
<html>

<head>
  <?php Base::head("Entrar | Unidade de Saúde"); ?>
  <link rel="stylesheet" type="text/css" href="./public/styles/css/form.css" />
</head>

<body>
  <?php Base::header(); ?>
  <main class="container">
    <section class="up">
      <div class="form">
        <h2>Entrar</h2>
        <form method="POST" action="?class=User&action=signIn">
          <div class="input-block">
            <label for="username">LOGIN</label>
            <input id="username" name="username" required />
          </div>
          <div class="input-block">
            <label for="password">SENHA</label>
            <input id="password" type="password" name="password" required />
          </div>
          <button type="submit" class="primary-button">Entrar</button>
        </form>
      </div>
    </section>
    <?php
    if (isset($_SESSION["errorMessage"])) {
      MessageContainer::errorMessage("Erro ao tentar entrar na plataforma", $_SESSION["errorMessage"]);
      $_SESSION["errorMessage"] = null;
    }
    ?>

    <section class="box">
      <a href="?page=user/register_on_platform">
        Ainda não possui uma conta? <strong>Cadastrar</strong>
      </a>
    </section>

  </main>
  <?php Base::footer(); ?>
</body>

</html>