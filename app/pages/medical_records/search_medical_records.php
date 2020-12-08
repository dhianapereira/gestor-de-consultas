<html>
  <head>
    <title>Unidade de Saúde | Buscar prontuários</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="#" />
    <link
      rel="stylesheet"
      type="text/css"
      href="../../../public/styles/css/main.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="../../../public/styles/css/form.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="../../../public/styles/css/buttons.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="../../../public/styles/css/animations.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="../../../public/styles/css/sidebar.css"
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
          <button onclick="history.back()">
            <img src="../../../public/styles/img/arrow-back.svg" alt="Voltar" />
          </button>
        </footer>
      </aside>
      <main class="animate-appear with-sidebar">
        <form method="POST" action="medical_records_page.php">
          <fieldset>
            <legend>Pesquisar prontuários</legend>
            <div class="input-block">
              <label for="cpf">CPF</label>
              <input id="cpf" name="cpf" required />
            </div>
            </fieldset>
            <button type="submit" class="primary-button">Confirmar</button>
        </form>
      </main>
    </div>
  </body>
</html>
