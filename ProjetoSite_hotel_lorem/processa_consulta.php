<?php
require_once("configuracao.php");
require_once("classBancoDados.inc");
require_once("funcoes_diversas.php");

session_start();

if(isset($_SESSION["USUARIO_LOGADO"]) && ($_SESSION["USUARIO_LOGADO"] == 1)) {
    $CodigoHospede = $_SESSION["CODIGO_HOSPEDE"];
}
else {
    $CodigoHospede = "";
}
   
$conexao_bd = new classBancoDados($ServidorMySQL);
        
if (!$conexao_bd->AbrirConexao()) {
    echo "<h2>Não foi possível conectar com o banco de dados do site</h2><br>";
    echo $conexao_bd->CodigoErro() . " -> " . $conexao_bd->MensagemErro();
}
else {
    if($_REQUEST["DataEntrada"] != "") {
        $DataEntrada = DataInvertida($_REQUEST["DataEntrada"]);
        $DataSaida = DataInvertida($_REQUEST["DataSaida"]);
        $Campos = "apartamentos.ID_Registro,apartamentos.Codigo_Hotel,apartamentos.Numero_Apartamento,apartamentos.Valor_Diaria,".
                "hoteis.Endereco,hoteis.Numero,hoteis.Bairro,hoteis.Cidade,hoteis.UF,hoteis.Telefone";
        $Clausula = "((apartamentos.Ocupado = 'N') OR (apartamentos.Fim_Hospedagem < '$DataEntrada'))".
                " AND (apartamentos.Tipo_Apartamento = ".$_REQUEST["TipoApartamento"].")".
                " AND (apartamentos.Tipo_Acomodacao = ".$_REQUEST["TipoAcomodacao"].")".
                " AND (apartamentos.Quantidade_Cama = ".$_REQUEST["Camas"].")";

        if($_REQUEST["TV"] == "S") {
            $Clausula .= " AND (apartamentos.Tem_TV = 'S')";
        }

        if($_REQUEST["Frigobar"] == "S") {
            $Clausula .= " AND (apartamentos.Tem_Frigobar = 'S')";
        }
        
        if($_REQUEST["Banheira"] == "S") {
            $Clausula .= " AND (apartamentos.Tem_Banheira = 'S')";
        }

        if($_REQUEST["Escrivaninha"] == "S") {
            $Clausula .= " AND (apartamentos.Tem_Escrivaninha = 'S')";
        }
        
        $Clausula .= " AND (apartamentos.Codigo_Hotel = hoteis.Codigo_Hotel)";
        
        $conexao_bd->SetSELECT($Campos,"apartamentos,hoteis");
        $conexao_bd->SetWHERE($Clausula);
        $conexao_bd->SetORDER("apartamentos.Codigo_Hotel,apartamentos.Numero_Apartamento");

        if($conexao_bd->ExecSELECT()) {
            $NumeroRegistros = $conexao_bd->TotalRegistros();
            $DataSet = $conexao_bd->GetDataSet();
            
            if($NumeroRegistros > 0) {
                echo "<br><br>";
                echo "<div class='retorno-consulta'>";
                echo "<table>";
                
                if($CodigoHospede == "") {
                    echo "<tr><th>Apto</th><th>Endereço</th><th>Bairro</th><th>Cidade</th><th>UF</th><th>Telefone</th></tr>";
                }
                else {
                    echo "<tr><th>Apto</th><th>Endereço</th><th>Bairro</th><th>Cidade</th><th>UF</th><th></th></tr>";
                }
          
                while($Registros = $DataSet->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$Registros["Numero_Apartamento"]."</td>";
                    echo "<td>".trim($Registros["Endereco"]).", ".trim($Registros["Numero"])."</td>";
                    echo "<td>".$Registros["Bairro"]."</td>";
                    echo "<td>".$Registros["Cidade"]."</td>";
                    echo "<td>".$Registros["UF"]."</td>";

                    if($CodigoHospede == "") {
                        echo "<td>".$Registros["Telefone"]."</td>";
                    }
                    else {
                        echo "<td><a href='registrar_reserva.php?RegistroApartamento=".$Registros["ID_Registro"].
                            "&DataEntrada=$DataEntrada&DataSaida=$DataSaida&Hospede=$CodigoHospede'>Reservar</a></td>";
                    }
                    
                    echo "</tr>";
                }
                
                echo "</table>";
                echo "</div>";
            }
            else {
                echo "<br><br>";
                echo "<h3>Não existem vagas disponíveis...</h3>";
            }
                
        }
        else {
            echo "<h2>Erro na execução comando SELECT...</h2>";
        }
    }
}
        
$conexao_bd->FecharConexao();
