<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Cadastro de Cliente e Caso</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="icon" type="image/x-icon" href="./assets/images/favicon_io/favicon.ico">
  <link rel="stylesheet" href="./css/menu.css">
  <link rel="stylesheet" href="./css/index.css">

</head>

<body>
  <section id="menu-section">
    <div id="menu-container">
      <nav class="menu-sublinhado">
        <ul>
          <li>
            <div class="animation">
              <div></div>
              <div></div>
              <div></div>
              <div></div>
              <div></div>
              <div></div>
            </div>
            <div id="sysname">S.L.I.M</div>
          </li>
          <li><a class="active-nav" href="#" title="Cadastrar Cliente">Cadastrar Cliente</a></li>
          <li><a href="../src/pages/cadastrar_ativo.php" title="Cadastrar Ativo">Cadastrar Ativo</a></li>
          <li><a href="#" title="Consultar Ativo">Consultar Ativo</a></li>
          <li><a href="#" title="Inserir Tabela">Inserir Tabela</a></li>
        </ul>
      </nav>
    </div>
  </section>

  <div id="msgerro">
    <?php
    // Verifica se há uma mensagem na URL
    if (isset($_GET['mensagem'])) {
      $mensagem = $_GET['mensagem'];
      echo "<span class='msgerro'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-exclamation-triangle' viewBox='0 0 16 16'>
    <path d='M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.15.15 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.2.2 0 0 1-.054.06.1.1 0 0 1-.066.017H1.146a.1.1 0 0 1-.066-.017.2.2 0 0 1-.054-.06.18.18 0 0 1 .002-.183L7.884 2.073a.15.15 0 0 1 .054-.057m1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767z'/>
    <path d='M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z'/>
    </svg> $mensagem</span>";
    }
    ?>
  </div>

  <form action="../src/includes/inserir_dados.php" method="post">
    <div class="form-container">
      <div class="form">
        <a class="heading">Cadastrar cliente e caso</a>
        <div class="inputBox">
          <input type="text" name="cliente_nome" id="cliente_nome" required>
          <span>Cliente</span>
        </div>

        <div class="inputBox">
          <input type="text" name="caso_nome" id="caso_nome" required>
          <span>Caso</span>
        </div>

        <div class="button-container">
          <div class="cad-button-container">
            <button class="cadastrar">Cadastrar</button>
          </div>
        </div>
      </div>
    </div>

  </form>

  <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>

</body>

</html>