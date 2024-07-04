
<?php
require_once '../config/conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cadastrar Ativo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/x-icon" href="../../images/favicon_io/favicon.ico">
    <link rel="stylesheet" href="../../public/css/menu.css">
    <link rel="stylesheet" href="../../public/css/inserir_ativo.css">
    <link rel="stylesheet" href="../../public/css/inserir_ativo_input.css">
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
                    <li><a href="../../public/index.php" title="Cadastrar Cliente">Cadastrar Cliente</a></li>
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
            if ($conexao->connect_error) {
                die("Conexão falhou: " . $conexao->connect_error);
            }

            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['caso_id'])) {
                $caso_id = $_GET['caso_id'];

                // Consulta para buscar informações do caso
                $sql = "SELECT * FROM Casos WHERE ID = $caso_id";
                $result_caso = $conexao->query($sql);

                if ($result_caso->num_rows > 0) {
                    $row_caso = $result_caso->fetch_assoc();
                    $nome_caso = $row_caso['NomeCaso'];
                    $cliente_id = $row_caso['ClienteID'];



                    // Formulário para inserir informações em Ativos
                    echo "<form class='form' action='processar_insercao.php' method='POST'>";



                    echo "<input type='hidden' name='caso_id' value='$caso_id'>
                        <input type='hidden' name='cliente_id' value='$cliente_id'>

                    <div class='divheading'>
                            <a class='heading'>Inserir informações no Caso $nome_caso</a>
                    </div>

                    <br>
                    <div class='inputBox alvopesquisado'>
                                <input id='alvopesquisado' class='alvopesquisado' type='text' name='alvopesquisado' autocomplete='off' required>
                    <span class='alvopesquisado'>Alvo Pesquisado</span>
                    </div>


                    <div class='inputBox partealvo'>
                    <select id='partealvo' class='partealvo' type='text' name='partealvo' autocomplete='off' required>
                    <option value=''></option>
                    <option value='Devedor'>Devedor</option>
                    <option value='Aval/Fiador'>Aval/Fiador</option>
                    <option value='Sócio'>Sócio</option>
                    <option value='Ex-Sócio'>Ex-Sócio</option>
                    <option value='Diretor'>Diretor</option>
                    <option value='Familiar'>Familiar</option>
                    <option value='Controlada/Grupo'>Controlada/Grupo</option>
                    <option value='Suspeito'>Suspeito</option>
                    <option value='Admnistrador'>Admnistrador</option>
                    <option value='Conselho de Administração'>Conselho de Administração</option>
                    <option value='Procurador'>Procurador</option>
                    <option value='Sociedade Consorciada'>Sociedade Consorciada</option>
                    <option value='Produtor Rural'>Produtor Rural</option>
                    <option value='Presidente'>Presidente</option>
                    <option value='Sócio Oculto'>Sócio Oculto</option>
                    <option value='Outro'>Outro</option>
                    </select>
                    <span>Parte Alvo</span>
                    </div>


                    <div class='inputBox selestrategia'>
                <select id='selestrategia' class='selestrategia' type='text' name='estrategia' autocomplete='off' >
                <option value=''></option>
                <option value='Penhora'>Penhora</option>
                <option value='Arresto Cautelar'>Arresto Cautelar</option>
                <option value='IDJP'>IDJP</option>
                <option value='Sucessão Empresarial'>Sucessão Empresarial</option>
                <option value='Fraude a Execução'>Fraude a Execução</option>
                <option value='Fraude a Credor'>Fraude a Credor</option>
                <option value='Penhora de Quotas'>Penhora de Quotas</option>
                <option value='Desconsiderar'>Desconsiderar</option>
                </select>
                    <span>Estratégia</span>
                    </div>

                    <div class='inputBox proprietarioimovel'>
                    <input id='proprietarioimovel' class='proprietarioimovel' type='text' name='proprietarioimovel' autocomplete='off'>
                    <span>proprietário do imóvel</span>
                    </div>

                    <div class='inputBox docproprietario'> 
                    <input id='docproprietario' class='docproprietario' type='text' name='docproprietario' minlength='14' maxLength='18' autocomplete='off' >
                    <span>doc do proprietário</span>
                    </div>

                    <div class='inputBox porcpropriedade'> 
                    <input id='porcentpropriedade' class='porcentpropriedade' type='text' name='porcentpropriedade' maxLength='5' value='' onchange='calcularValorFração()' required>
                    <span> % imóvel</span>
                    </div>

                <div class='inputBox tipoativo'>
                <select id='tipoativo' class='tipoativo' name='tipoativo' data-width='76' data-value='' >
                <option value=''></option>
                <option value='Imóvel Urbano'>Imóvel Urbano</option>
                <option value='Imóvel Rural'>Imóvel Rural</option>
                </select>
                <span>Tipo Ativo</span>
                </div>

                <div class='inputBox subtipoativo'>
                <select id='subtipoativo' class='subtipoativo' name='subtipoativo' data-width='76' data-value='' >
                <option value=''></option>
                <option value='Apartamento Cobertura'>Apartamento Cobertura</option>
                <option value='Apartamento Padrão'>Apartamento Padrão</option>
                <option value='Barracão'>Barracão</option>
                <option value='Box/Garagem'>Box/Garagem</option>
                <option value='Casa Residencial'>Casa Residencial</option>
                <option value='Complexo Industrial'>Complexo Industrial</option>
                <option value='Flat'>Flat</option>
                <option value='Galpão'>Galpão</option>
                <option value='Gleba Urbana'>Gleba Urbana</option>
                <option value='Hotel'>Hotel</option>
                <option value='Incorporação'>Incorporação</option>
                <option value='Laje Corporativa'>Laje Corporativa</option> 
                <option value='Loja Comercial Rua'>Loja Comercial Rua</option>
                <option value='Loja em Condomínio'>Loja em Condomínio</option>
                <option value='Lote em Condomínio'>Lote em Condomínio</option>
                <option value='Mall'>Mall</option>
                <option value='Obra Inacabada'>Obra Inacabada</option>
                <option value='Prédio Comercial'>Prédio Comercial</option>
                <option value='Prédio Residencial'>Prédio Residencial</option>
                <option value='Sala Comercial'>Sala Comercial</option>
                <option value='Shopping'>Shopping</option>
                <option value='Terreno Urbano'>Terreno Urbano</option>
                <option value='Chácara Urbana'>Chácara Urbana</option>
                <option value='Agroindústria'>Agroindústria</option>
                <option value='Chácara Rural'>Chácara Rural</option>
                <option value='Confinamento'>Confinamento</option>
                <option value='Fazenda'>Fazenda</option>
                <option value='Gleba Rural'>Gleba Rural</option>
                <option value='Sitio'>Sitio</option>
                <option value='Silo'>Silo</option>
                </select>
                <span>subtipo ativo</span>
                </div>

                <div class='inputBox tipologia'>
                <select id='tipologia' class='tipologia' name='tipologia' data-width='76' data-value='' >
                <option value=''></option>
                <option value='Terreno'>Terreno</option>
                <option value='Residência'>Residência</option>
                <option value='Comércio'>Comércio</option>
                </select>
                <span>Tipologia</span>
                </div>

                <div class='inputBox matricula'>
                    <input id='matricula' class='matricula' type='text' name='matricula' autocomplete='off' required>
                    <span>Matrícula</span>
                    </div>

                <div class='inputBox numcartorio'>
                <select id='numcartorio' class='numcartorio' name='numcartorio' data-width='76' data-value='' required>
                <option value=''></option>
                <option value='01º CARTÓRIO'>01º CARTÓRIO</option>
                <option value='02º CARTÓRIO'>02º CARTÓRIO</option>
                <option value='03º CARTÓRIO'>03º CARTÓRIO</option>
                <option value='04º CARTÓRIO'>04º CARTÓRIO</option>
                <option value='05º CARTÓRIO'>05º CARTÓRIO</option>
                <option value='06º CARTÓRIO'>06º CARTÓRIO</option>
                <option value='07º CARTÓRIO'>07º CARTÓRIO</option>
                <option value='08º CARTÓRIO'>08º CARTÓRIO</option>
                <option value='09º CARTÓRIO'>09º CARTÓRIO</option>
                <option value='10º CARTÓRIO'>10º CARTÓRIO</option>
                <option value='11º CARTÓRIO'>11º CARTÓRIO</option>
                <option value='12º CARTÓRIO'>12º CARTÓRIO</option>
                <option value='13º CARTÓRIO'>13º CARTÓRIO</option>
                <option value='14º CARTÓRIO'>14º CARTÓRIO</option>
                <option value='15º CARTÓRIO'>15º CARTÓRIO</option>
                <option value='16º CARTÓRIO'>16º CARTÓRIO</option>
                <option value='17º CARTÓRIO'>17º CARTÓRIO</option>
                <option value='18º CARTÓRIO'>18º CARTÓRIO</option>
                <option value='19º CARTÓRIO'>19º CARTÓRIO</option>
                <option value='20º CARTÓRIO'>20º CARTÓRIO</option>
                </select>
                <span>Cartório</span>
                </div>

                    <div class='inputBox cidcartorio'>
                    <input id=cidcartorio class='cidcartorio' type='text' name='cidcartorio' autocomplete='off' required>
                    <span>Cidade do Cartório</span>
                    </div>

                    <div class='inputBox endereco'>
                    <input id='endereco' class='endereco'type='text' name='endereco' autocomplete='off'>
                    <span>Endereço</span>
                    </div>

                    <div class='inputBox cidade'>
                    <input id='cidade' class='cidade' type='text' name='cidade' autocomplete='off'>
                    <span>Cidade</span>
                    </div>

                <div class='inputBox uf'>
                <select id='uf' class='uf' name='uf' data-width='76' data-value=''>
                <option value=''></option>
                <option value='AC'>AC</option>
                <option value='AL'>AL</option>
                <option value='AP'>AP</option>
                <option value='AM'>AM</option>
                <option value='BA'>BA</option>
                <option value='CE'>CE</option>
                <option value='DF'>DF</option>
                <option value='ES'>ES</option>
                <option value='GO'>GO</option>
                <option value='MA'>MA</option>
                <option value='MT'>MT</option>
                <option value='MS'>MS</option>
                <option value='MG'>MG</option>
                <option value='PA'>PA</option>
                <option value='PB'>PB</option>
                <option value='PR'>PR</option>
                <option value='PE'>PE</option>
                <option value='PI'>PI</option>
                <option value='RJ'>RJ</option>
                <option value='RN'>RN</option>
                <option value='RS'>RS</option>
                <option value='RO'>RO</option>
                <option value='RR'>RR</option>
                <option value='SC'>SC</option>
                <option value='SP'>SP</option>
                <option value='SE'>SE</option>
                <option value='TO'>TO</option>
                </select>
                <span>UF</span>
                </div>

                <div class='inputBox regiao'>
                <select  id='regiao' class='regiao' name='regiao' data-width='76' data-value='' >
                <option value=''></option>
                <option value='Sul'>Sul</option>
                <option value='Sudeste'>Sudeste</option>
                <option value='Centro-oeste'>Centro-oeste</option>
                <option value='Norte'>Norte</option>
                <option value='Nordeste'>Nordeste</option>
                </select>
                <span>Região</span>
                </div>

                <div class='inputBox ham2'> 
                <select id='ham2' class='ham2' name='ham2' data-width='76' data-value='' >
                <option value=''></option>
                <option value='Ha'>Ha</option>
                <option value='M²'>M²</option>
                </select>
                <span>Ha/M²</span>
                </div>

                <div class='inputBox areaterren'>   
                    <input id='areaterreno' class='areaterreno' type='text' name='areaterreno' autocomplete='off'>
                    <span>Área Terreno</span>
                    </div>

                <div class='inputBox areaconstruid'>
                <input id='areaconstruida' class='areaconstruida' type='text' name='areaconstruida' autocomplete='off'>
                <span>Área Construída</span>    
                </div>

                <div class='inputBox valormercad'>
                    <input id='valormercado' class='valormercado' type='text' name='valormercado' onchange='calcularValorFração()'>
                    <span>Valor Mercado</span> 
                    </div>

                <div class='inputBox valormercadf'>
                    <input id='valormercadofracao' class='valormercadofracao' type='text' name='valormercadofracao' >
                    <span>Valor (Fração)</span>     
                    </div>

                <div class='inputBox origemvalor'>
                    <input id='origemvalor' class='origemvalor' type='text' name='origemvalor' autocomplete='off'>
                    <span>Origem Valor</span>  
                    </div>";

                    echo "<div class='input-box'> 
                <select id='transacaorelevante' class='transacaorelevante' name='transacaorelevante' data-width='76' data-value='' >
                <option value=''>Transação Relevante</option>
                <option value='N/A'>N/A</option>
                <option value='Compra e Venda suspeita'>Compra e Venda suspeita</option>
                <option value='Integralização de Capital'>Integralização de Capital</option>
                <option value='Desmembramento'>Desmembramento</option>
                <option value='Unificação'>Unificação</option>
                <option value='Dação'>Dação </option>
                <option value='Inventário (espólio)'>Inventário (espólio)</option>
                <option value='Arrendamento'>Arrendamento</option>
                <option value='Doação'>Doação</option>
                <option value='Encerramento Matricula'>Encerramento Matricula</option>
                </select>
                </div>";

                    echo "<div class='input-box'>
                <label for='datatransacaorelevante'> Data Trans. Relevante: </label>
                    <input id='datatransacaorelevante' class='datatransacaorelevante' type='text' name='datatransacaorelevante' autocomplete='off'>
                    </div>";

                    echo "<div class='input-box'>
                <select id='onustrabalhista' class='onustrabalhista' name='onustrabalhista' data-width='76' data-value='' >
                <option value=''>Ônus Trabalhista</option>
                <option value='Sim'>Sim</option>
                <option value='Não'>Não</option>
                </select>
                </div>";

                    echo "<div class='input-box'>  
                <label for='onustquantidade'> Quantidade: </label>
                    <input id='onustquantidade' class='onustquantidade' type='text' name='onustquantidade' autocomplete='off'>
                        </div>";

                    echo "<div class='input-box'>  
                        <label for='onustvalorhistorico'> Valor Histórico: </label>
                            <input id='onustvalorhistorico' class='onustvalorhistorico' type='text' name='onustvalorhistorico' autocomplete='off'>
                                </div>";



                    echo "<div class='input-box1'>
                <select id='onusfiscal' class='onusfiscal' name='onusfiscal' data-width='76' data-value='' >
                <option value=''>Ônus Fiscal</option>
                <option value='Sim'>Sim</option>
                <option value='Não'>Não</option>
                </select>
                </div>";

                    echo "<div class='input-box'>  
                <label for='onusfquantidade'> Quantidade: </label>
                    <input id='onusfquantidade' class='onusfquantidade' type='text' name='onusfquantidade' autocomplete='off'>
                        </div>";

                    echo "<div class='input-box'>  
                        <label for='onusfvalorhistorico'> Valor Histórico: </label>
                            <input id='onusfvalorhistorico' class='onusfvalorhistorico' type='text' name='onusfvalorhistorico' autocomplete='off'>
                                </div>";

                    echo "<div class='input-box1'>
                <select id='onuscivel' class='onuscivel' name='onuscivel' data-width='76' data-value='' >
                <option value=''>Ônus Cível</option>
                <option value='Sim'>Sim</option>
                <option value='Não'>Não</option>
                </select>
                </div>";

                    echo "<div class='input-box'>  
                <label for='onuscquantidade'> Quantidade: </label>
                    <input id='onuscquantidade' class='onuscquantidade' type='text' name='onuscquantidade' autocomplete='off'>
                        </div>";

                    echo "<div class='input-box'>  
                        <label for='onuscvalorhistorico'> Valor Histórico: </label>
                            <input id='onuscvalorhistorico' class='onuscvalorhistorico' type='text' name='onuscvalorhistorico' autocomplete='off'>
                                </div>";

                    echo "<div class='input-box'>
                <select id='imovelgarantia' class='imovelgarantia' name='imovelgarantia' data-width='76' data-value='' >
                <option value=''>Imóvel em Garantia</option>
                <option value='Alienação Fiduciária'>Alienação Fiduciária</option>
                <option value='Hipoteca'>Hipoteca</option>
                <option value='Não'>Não</option>
                </select>
                </div>";


                    echo "<div class='input-box'>
                <select id='considerarnopreco' class='considerarnopreco' name='considerarnopreco' data-width='76' data-value='' >
                <option value=''>Considerar no Preço?</option>
                <option value='Sim'>Sim</option>
                <option value='Não'>Não</option>
                <option value='Talvez'>Talvez</option>
                </select>
                </div>";

                    echo "<div class='input-box'>
                <label for='comentarios'> Comentários: </label>
                <textarea id='comentarios' class='comentarios' name='comentarios' rows='4' autocomplete='off' style='resize: none;'></textarea>
                </div>";

                    echo "<div class='input-box'>
                <label for='situacaoonus'> Situação de ônus: </label>
                    <input id='situacaoonus' class='situacaoonus' type='text' name='situacaoonus' value='' readonly >
                    </div>";

                    echo "<div class='input-box' style='display: none;'>
                <label for='textoconclusaolivres'> TEXTO CONCLUSÃO - LIVRES: </label>
                    <input id='textoconclusaolivres' class='textoconclusaolivres' type='text' name='textoconclusaolivres' value='' hidden>
                </div>";

                    echo "<div class='input-box'  style='display: none;'>
                <label for='textoconclusaoonerados'> TEXTO CONCLUSÃO - ONERADOS: </label>
                    <input id='textoconclusaoonerados' class='textoconclusaoonerados' type='text' name='textoconclusaoonerados' hidden>
                </div>";
            

                    echo "<div id='botao' class='botao'><input class='cadbtn' type='submit' value='Inserir Ativo'></div>
                    </form></div>
                    </div>";
                } else {
                    header('Location: ../cad_sec/?mensagem=Caso não encontrado.');
                }
            } else {
                echo "Parâmetros ausentes.";
            }

            $conexao->close();
            ?>
        </div>
    </div>

    <script>
    function calcularValorFração() {
        var valorP = document.getElementById("porcentpropriedade").value;
        var valorM = document.getElementById("valormercado").value;

        // Remover pontos e vírgulas e converter para float
        var valorM2 = parseFloat(valorM.replace(/\./g, "").replace(",", "."));
        var valorP2 = parseFloat(valorP.replace(/\,/g, "."));

        // Verificar se o valorP2 é maior que 100
        if (valorP2 > 100) {
            valorP2 = 100; // Limitar o valor a 100
            document.getElementById("porcentpropriedade").value = valorP2; // Atualizar o valor no input
        }

        // Arredondar para cima a porcentagem
        var valorP2Arredondado = Math.ceil(valorP2);

        var resultado = valorM2 * valorP2Arredondado / 100;
        // Formatar o resultado
        var resultadoFormatado = formatNumber(resultado);

        // Inserir o resultado formatado no input e exibi-lo na página
        document.getElementById("valormercadofracao").value = resultadoFormatado;
        document.getElementById("porcentpropriedade").value = valorP2Arredondado;
    }

    function formatNumber(number) {
        return new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(number);
    }
</script>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Obter referências aos elementos do DOM
            const onusTrabalhista = document.getElementById('onustrabalhista');
            const onusFiscal = document.getElementById('onusfiscal');
            const onusCivel = document.getElementById('onuscivel');
            const imovelGarantia = document.getElementById('imovelgarantia');
            const considerarNoPreco = document.querySelector('.considerarnopreco');
            const situacaoonus = document.getElementById('situacaoonus');
            const textoconclusaolivres = document.getElementById('situacaoonus');

            // Adicionar um ouvinte de evento de alteração a todos os campos relevantes
            [onusTrabalhista, onusFiscal, onusCivel, imovelGarantia, considerarNoPreco].forEach(function (element) {
                element.addEventListener('change', atualizarSituacaoOnus);
            });

            // Função para atualizar o valor do campo situacaoonus
            function atualizarSituacaoOnus() {
                if (
                    onusTrabalhista.value === 'Não' &&
                    onusFiscal.value === 'Não' &&
                    onusCivel.value === 'Não' &&
                    imovelGarantia.value === 'Não' &&
                    considerarNoPreco.value === 'Sim'
                ) {
                    situacaoonus.value = 'Livre';
                } else if (considerarNoPreco.value === 'Não') {
                    situacaoonus.value = '-';
                } else {
                    situacaoonus.value = 'Onerado';
                }
            }
        });
    </script>


    <script>
        // Adiciona um ouvinte de evento para cada campo de entrada
        document.querySelectorAll('input').forEach(function (element) {
            element.addEventListener('input', function () {
                // Converter o valor para maiúsculas
                this.value = this.value.toUpperCase();

                // Remover caracteres acentuados
                var valorSemAcentos = this.value.normalize('NFD').replace(/[\u0300-\u036f]/g, '');

                // Verificar se houve mudança no valor após a remoção dos acentos
                if (this.value !== valorSemAcentos) {
                    // Atualizar o valor do campo sem acentos
                    this.value = valorSemAcentos;
                }
            });
        });
    </script>


    <script src='https://code.jquery.com/jquery-3.7.1.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js'></script>
    <script>$('.valormercado').mask('000.000.000.000.000,00', { reverse: true });</script>
    <script>$('.areaterreno').mask('000.000.000.000.000,00', { reverse: true });</script>
    <script>$('.areaconstruida').mask('000.000.000.000.000,00', { reverse: true });</script>
    <script>$('.onustvalorhistorico').mask('000.000.000.000.000,00', { reverse: true });</script>
    <script>$('.onusfvalorhistorico').mask('000.000.000.000.000,00', { reverse: true });</script>
    <script>$('.onuscvalorhistorico').mask('000.000.000.000.000,00', { reverse: true });</script>
    <script>$('.onustquantidade').mask('000000', { reverse: true });</script>
    <script>$('.onusfquantidade').mask('000000', { reverse: true });</script>
    <script>$('.onuscquantidade').mask('000000', { reverse: true });</script>
    <script>$('.porcentpropriedade').mask('000,00', { reverse: true });</script>
    <script>$('.datatransacaorelevante').mask('00/00/0000');</script>

    <script>
        document.getElementById('docproprietario').addEventListener('input', function (e) {
            var value = e.target.value.replace(/\D/g, '');

            if (value.length === 11) {
                // CPF: 000.000.000-00
                value = value.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
            } else if (value.length === 14) {
                // CNPJ: 00.000.000/0000-00
                value = value.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, '$1.$2.$3/$4-$5');
            }

            e.target.value = value;
        });
    </script>

    <script>
        //fromata areaconstruida e areaterreno   
        function formatAreaInput(inputId) {
            var input = document.getElementById(inputId);

            input.addEventListener('blur', function () {
                var value = parseFloat(input.value.replace(/[^\d.,]/g, '').replace(',', '.'));
                input.value = value.toLocaleString('pt-BR');
            })
        }

        formatAreaInput('porcentpropriedade');
    </script>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/jquery.easing.1.3.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/moment.js"></script>
    <script src="../js/bootstrap-datetimepicker.min.js"></script>
    <script src="../js/jquery.waypoints.min.js"></script>
    <script src="../js/jquery.stellar.min.js"></script>
    <script src="../js/jquery.flexslider-min.js"></script>
    <script>
        $(function () {
            $('#date').datetimepicker();
        });
    </script>
    <script src="../js/main.js"></script>

    <script>
        document.getElementById('calcular').addEventListener('click', function () {
            calcular();
        });

        function formatNumber(input) {
            // Utilizei toFixed() para garantir que tenhamos duas casas decimais
            const numberString = input.toFixed(2).toString();

            const parts = numberString.split('.');

            // Adiciona ponto como separador de milhar
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, '.');

            // Limita a duas casas decimais sem arredondar
            parts[1] = parts[1] ? parts[1] : '00';

            return parts.join(',');
        }
    </script>

<script>
  // Seleciona todos os inputs com a classe 'proprietarioimovel'
  const inputs = document.querySelectorAll('.proprietarioimovel input');

  // Para cada input, adiciona um event listener para verificar mudanças
  inputs.forEach(input => {
    input.addEventListener('input', function() {
      const span = this.nextElementSibling; // Seleciona o próximo elemento (o span)

      if (this.value.trim() !== '') {
        span.classList.add('active'); // Adiciona a classe 'active' ao span se o campo não estiver vazio
      } else {
        span.classList.remove('active'); // Remove a classe 'active' se o campo estiver vazio
      }
    });
  });
</script>

<script src="../../public/js/inserir_ativo_input.js"></script>


</body>

</html>