<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Unidade de Saúde | Cadastro</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="shortcut icon"
      href="../../../public/styles/img/doctors-list.svg"
      type="image/x-icon"
    />

    <link
      rel="stylesheet"
      type="text/css"
      href="../../../public/styles/css/main.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="../../../public/styles/css/home.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="../../../public/styles/css/buttons.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="../../../public/styles/css/form.css"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap"
      rel="stylesheet"
    />
  </head>
  <script src="../../../public/scripts/script.js"></script>
  <body>
    <header>
      <h3 class="logo">Unidade de Saúde</h3>
    </header>
    <main class="container">
      <section class="quick-access">
        <a href="./list_page.php" class="home-button">
          <h3>
            <p>Listar Pacientes</p>
            <img
              src="../../../public/styles/img/list.svg"
              alt="Imagem de lista de pacientes"
            />
          </h3>
        </a>
        <a href="./search_patient.html" class="home-button">
          <h3>
            <p>Procurar Paciente</p>
            <img
              src="../../../public/styles/img/update-patient.svg"
              alt="Imagem de paciente"
            />
          </h3>
        </a>
        <a href="../home_page.php" class="home-button">
          <h3>
            <p>Home</p>
            <img
              src="../../../public/styles/img/home.svg"
              alt="Imagem de Home"
            />
          </h3>
        </a>
      </section>
      <section class="box">
        <div class="form">
          <h2>Dados Pessoais</h2>
          <form method="POST" action="register_patient.php">
            <div class="input-block">
              <label for="full_name">Nome Completo</label>
              <input id="full_name" name="full_name" required />
            </div>
            <div class="input-block">
              <label for="cpf">CPF</label>
              <input id="cpf" name="cpf" required />
            </div>

            <div class="input-block">
              <label for="mother_name">Nome da mãe</label>
              <input id="mother_name" name="mother_name" required />
            </div>

            <div class="input-block">
              <label for="companion">Acompanhante</label>
              <input id="companion" name="companion" required />
            </div>

            <div class="input-block">
              <label for="date_of_birth">Data de nascimento</label>
              <input
                type="date"
                id="date_of_birth"
                name="date_of_birth"
                required
              />
            </div>

            <div class="input-block">
              <label for="address">Endereço</label>
              <input id="address" name="address" required />
            </div>

            <div class="input-block">
              <label for="genre">Gênero</label>
              <input
                type="hidden"
                name="genre"
                id="genre"
                value="Feminino"
                required
              />

              <div class="button-select">
                <button
                  data-value="Feminino"
                  onclick="toggleGenre(event)"
                  type="button"
                  class="active-genre"
                >
                  Feminino
                </button>
                <button
                  data-value="Masculino"
                  onclick="toggleGenre(event)"
                  type="button"
                >
                  Masculino
                </button>
              </div>
            </div>
            <div class="input-block">
              <label for="naturalness">Nacionalidade</label>
              <input
                type="hidden"
                name="naturalness"
                id="naturalness"
                value="Brasileiro(a)"
                required
              />

              <div class="button-select">
                <button
                  data-value="Brasileiro(a)"
                  onclick="toggleNaturalness(event)"
                  type="button"
                  class="active-naturalness"
                >
                  Brasileiro(a)
                </button>
                <button
                  data-value="Estrangeiro(a)"
                  onclick="toggleNaturalness(event)"
                  type="button"
                >
                  Estrangeiro(a)
                </button>
              </div>
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
