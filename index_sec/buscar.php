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
	<link rel="stylesheet" href="../css/buscar.css">

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

	<div class="form-container">
		<div class="form">

			<?php
			$cliente_id = $_POST['cliente_id'];

			// Consulta para encontrar o cliente
			$sql = "SELECT * FROM Cliente WHERE ID = $cliente_id";
			$result_cliente = $conexao->query($sql);

			if ($result_cliente->num_rows > 0) {
				$row_cliente = $result_cliente->fetch_assoc();
				$cliente_nome = $row_cliente['Nome'];

				// Consulta para buscar casos relacionados
				$sql = "SELECT * FROM Casos WHERE ClienteID = $cliente_id";
				$result_casos = $conexao->query($sql);

				if ($result_casos->num_rows > 0) {
					echo "<a class='heading'>Casos relacionados a $cliente_nome:</a>";
					echo "<div class='menu-container'>";
					while ($row_caso = $result_casos->fetch_assoc()) {
						$caso_id = $row_caso['ID'];
						$nome_caso = $row_caso['NomeCaso'];

						echo "<p id='pcaso'><a class='a' href='inserir_ativos.php?caso_id=$caso_id'>$nome_caso</a></p>";
					}
				} else {
					header('Location: ../index_pri/?mensagem=Nenhum caso encontrado para ' . urlencode($cliente_nome));
				}
			} else {
				header('Location: ../index_pri/?mensagem=Cliente não encontrado.');
			}

			$conexao->close();
			?>
		</div>
		</form>
	</div>
	</div>
	</div>
	</div>
</body>

</html>