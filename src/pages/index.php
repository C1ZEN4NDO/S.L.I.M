<?php
require_once '../conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Cadastro de Cliente e Caso</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="icon" type="image/x-icon" href="../images/favicon_io/favicon.ico">
	<link rel="stylesheet" href="../css/menu.css">
	<link rel="stylesheet" href="../css/index_sec.css">

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
					<li><a href="../index_pri/index.php" title="Cadastrar Cliente">Cadastrar Cliente</a></li>
					<li><a class="active-nav" href="#" title="Cadastrar Ativo">Cadastrar Ativo</a></li>
					<li><a href="#" title="Consultar Ativo">Consultar Ativo</a></li>
					<li><a href="#" title="Inserir Tabela">Inserir Tabela</a></li>
				</ul>
			</nav>
		</div>
	</section>

	<?php
	// Verifica se há uma mensagem na URL
	if (isset($_GET['mensagem'])) {
		$mensagem = $_GET['mensagem'];

		// Verificar o valor da mensagem e definir a cor correspondente
		$cor = ($mensagem === 'Cliente e caso inseridos com sucesso!') ? 'green' : 'red';

		// Exibir a mensagem com a cor definida
		echo "<div class='mensagem' style='color: $cor;'><h2>$mensagem</h2></div>";
	}
	?>

	<div class="form-container">
		<div class="form">
			<form action='buscar.php' method='POST'>
				<?php
				// Consulta SQL para obter os nomes dos clientes
				$sql = "SELECT ID, Nome FROM Cliente";
				$result = $conexao->query($sql);

				// Verifica se a consulta retornou resultados
				if ($result->num_rows > 0) {

					echo "<a class='heading'>Selecione um Cliente</a>";
					echo "<div class='inputBox'>";
					echo "<select class='cliente_id' id='cliente_id' name='cliente_id' required>";
					echo "<option value=''></option>";
					// Exibe os nomes dos clientes em um elemento select
					while ($row = $result->fetch_assoc()) {
						$cliente_id = $row['ID'];
						$cliente_nome = $row['Nome'];
						echo "<option value=\"$cliente_id\">$cliente_nome</option>";
					}

					echo "</select>";
					echo "<span>Cliente</span>";
					echo "</div>";
					echo "<div class='button-container'>
							<div class='cad-button-container'>";
					echo "<div class='botao'><input class='selbtn' id='selbtn' type='submit' value='Selecionar'></div>";
					echo "</div>
							</div>";
				} else {
					header('Location: ../cad_pri/?mensagem=Nenhum cliente encontrado.');
				}

				// Fecha a conexão com o banco de dados
				$conexao->close();
				?>
			</form>
		</div>
	</div>
	</div>
	</div>
</body>

</html>