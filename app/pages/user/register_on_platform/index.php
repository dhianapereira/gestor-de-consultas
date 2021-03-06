<?php
require_once "app/components/MessageContainer.php";
require_once "app/components/Base.php";
?>
<html>

<head>
    <?php Base::head("Cadastrar | Unidade de Saúde"); ?>
    <link rel="stylesheet" type="text/css" href="./public/styles/css/form.css" />
</head>

<body>
    <?php Base::header(); ?>
    <main class="container">
        <section class="up">
            <div class="form">
                <h2>Cadastrar</h2>
                <form method="POST" action="?class=User&action=save">
                    <div class="input-block">
                        <label for="cpf">CPF</label>
                        <input id="cpf" name="cpf" required />
                    </div>
                    <div class="input-block">
                        <label for="username">USERNAME</label>
                        <input id="username" name="username" required />
                    </div>
                    <div class="input-block">
                        <label for="password">SENHA</label>
                        <input id="password" type="password" name="password" required />
                    </div>
                    <div class="input-block">
                        <label for="confirm_password">CONFIRMAR SENHA</label>
                        <input id="confirm_password" type="password" name="confirm_password" required />
                    </div>
                    <button type="submit" class="primary-button">Cadastrar</button>
                </form>
            </div>
        </section>
        <?php
        if (isset($_SESSION["errorMessage"])) {
            MessageContainer::errorMessage("Não foi possível realizar esta operação", $_SESSION["errorMessage"]);
            $_SESSION["errorMessage"] = null;
        } else if (isset($_SESSION["successMessage"])) {
            MessageContainer::successMessage("Operação realizada", $_SESSION["successMessage"]);
            $_SESSION["successMessage"] = null;
        }
        ?>

        <section class="box">
            <a href="?page=user/login">
                Já possui uma conta? <strong>Entrar</strong>
            </a>
        </section>
    </main>
    <?php Base::footer(); ?>
</body>

</html>