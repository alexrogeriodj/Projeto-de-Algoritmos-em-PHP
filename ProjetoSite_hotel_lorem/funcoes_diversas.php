<?php
require_once("configuracao.php");
require_once("classBancoDados.inc");
require_once("classCadastro.inc");
require_once("classUsuario.inc");
require_once("classApartamento.inc");

function DataInvertida($DataNormal) {
    $Dia = substr($DataNormal,0,2);
    $Mes = substr($DataNormal,3,2);
    $Ano = substr($DataNormal,6,4);
    $DataInvertida = $Ano."/".$Mes."/".$Dia;
    return $DataInvertida;
}

function Estados($OrdemTabulacao,$ItemSelecionado = "") {
    $ListaEstados = "<select name='Estado' size='1' tabindex=$OrdemTabulacao>";
    
    $conexao_bd = new classBancoDados($GLOBALS["ServidorMySQL"]);
    
    if ($conexao_bd->AbrirConexao()) {
        $conexao_bd->SetSELECT("UF,Estado","estados");
        $conexao_bd->SetORDER("Estado");

        if($conexao_bd->ExecSELECT()) {
            $NumeroRegistros = $conexao_bd->TotalRegistros();
            $DataSet = $conexao_bd->GetDataSet();
                
            if($NumeroRegistros > 0) {
                while($Registros = $DataSet->fetch_assoc()) {
                    $ItemLista = "<option";

                    if ($ItemSelecionado != "") {
                        if($Registros["UF"] === $ItemSelecionado) {
                            $ItemLista .= " selected='selected'";
                        }
                    }
                    
                    $ItemLista .= " value='".$Registros["UF"]."'>".$Registros["Estado"]."</option>";

                    $ListaEstados .= $ItemLista;
                }
            }
        }
    }
        
    $conexao_bd->FecharConexao();
    
    $ListaEstados .= "</select>";
    
    return $ListaEstados;
}

function SoDigito($Valor) {
    $Tamanho = strlen($Valor);
    $NovoValor = "";

    for($Contador = 0;$Contador < $Tamanho;$Contador++) {
        $Digito = $Valor[$Contador];

        if((ord($Digito) >= 48) && (ord($Digito) <= 57)) {
            $NovoValor .= $Digito;
        }
    };

    return trim($NovoValor);
}

function ValidaCPF($NumeroCPF) {
    $CPF = SoDigito($NumeroCPF);

    if($CPF == "") {
        $Retorno = FALSE;
    }
    else {
        if (strlen($CPF) == 11) {
            $Soma = 0;

            for($Contador = 0;$Contador < 9;$Contador++) {
                $Calculo = $CPF[8-$Contador]*($Contador+2);
                $Soma += $Calculo;
            }

            $Digito1 = 11 - ($Soma % 11);

            if($Digito1 > 9) {
                $Digito1 = 0;
            }
                     
            $CPFNovo = substr($CPF,0,9);
            $CPFNovo .= $Digito1;
            $Soma = 0;

            for($Contador = 0;$Contador < 10;$Contador++) {
                $Calculo = $CPFNovo[9-$Contador]*($Contador+2);
                $Soma += $Calculo;
            }
            
            $Digito2 = 11 - ($Soma % 11);

            if($Digito2 > 9) {
                $Digito2 = 0;
            }

            $Retorno = ($Digito1 == ((int)$CPF[9])) && ($Digito2 == ((int)$CPF[10]));
        }
        else
            $Retorno = FALSE;
    }

    return $Retorno;
}

function ValidaCEP($CEP) {
    $NovoCEP = SoDigito($CEP);
    
    if(strlen($NovoCEP) < 8) {
        $Retorno = FALSE;
    }
    else {
        $Retorno = ereg("^([0-9]){5}-?([0-9]){3}$",$CEP);
    }
    
    return $Retorno;
}

function CampoTexto($Valor) {
    return "'".$Valor."'";
}

function ListaHoteis() {
    $Hoteis = "<select name='Hotel' size='1'>";
    
    $conexao_bd = new classBancoDados($GLOBALS["ServidorMySQL"]);
    
    if ($conexao_bd->AbrirConexao()) {
        $conexao_bd->SetSELECT("Codigo_Hotel,Endereco,Cidade,UF","hoteis");
        $conexao_bd->SetORDER("Endereco,Cidade,UF");

        if($conexao_bd->ExecSELECT()) {
            $NumeroRegistros = $conexao_bd->TotalRegistros();
            $DataSet = $conexao_bd->GetDataSet();
                
            if($NumeroRegistros > 0) {
                while($Registros = $DataSet->fetch_assoc()) {
                    $ConteudoLista = $Registros["Endereco"]." | ".$Registros["Cidade"]."/".$Registros["UF"];
                    $Hoteis .= "<option value='".$Registros["Codigo_Hotel"]."'>$ConteudoLista</option>";
                }
            }
        }
    }
        
    $conexao_bd->FecharConexao();
    
    $Hoteis .= "</select>";
    
    return $Hoteis;
}

function Dia_Data($Data)  {
    date_default_timezone_set('UTC');
    return date("d",strtotime($Data));
}

function Mes_Data($Data)  {
    date_default_timezone_set('UTC');
    return date("m",strtotime($Data));
}

function Ano_Data($Data)  {
    date_default_timezone_set('UTC');
    return date("Y",strtotime($Data));
}

function RecuperaCadastroHospede($CodigoHospede) {
    $Cadastro = new classCadastro();
    
    $conexao_bd = new classBancoDados($GLOBALS["ServidorMySQL"]);
        
    if (!$conexao_bd->AbrirConexao()) {
       echo "<h2>Não foi possível conectar com o banco de dados do site</h2><br>";
       echo $conexao_bd->CodigoErro() . " -> " . $conexao_bd->MensagemErro();
    }
    else {
        $conexao_bd->SetSELECT("*","hospedes");
        $conexao_bd->SetWHERE("Codigo_Hospede = $CodigoHospede");

        if($conexao_bd->ExecSELECT()) {
            $NumeroRegistros = $conexao_bd->TotalRegistros();
            $DataSet = $conexao_bd->GetDataSet();
            
            if($NumeroRegistros > 0) {
                $Registros = $DataSet->fetch_assoc();
                
                $Cadastro->SetNome($Registros["Nome_Hospede"]);
                $Cadastro->SetDataNascimento($Registros["Data_Nascimento"]);
                $Cadastro->SetCPF($Registros["CPF"]);
                $Cadastro->SetRG($Registros["RG"]);
                $Cadastro->SetEndereco($Registros["Endereco"],$Registros["Numero"]);
                $Cadastro->SetComplemento($Registros["Complemento"]);
                $Cadastro->SetBairro($Registros["Bairro"]);
                $Cadastro->SetCidade($Registros["Cidade"]);
                $Cadastro->SetEstado($Registros["UF"]);
                $Cadastro->SetCEP($Registros["CEP"]);
                $Cadastro->SetTelefone($Registros["Telefone"]);
                $Cadastro->SetCelular($Registros["Celular"]);
                $Cadastro->SetEmpresa($Registros["Empresa"]);
                $Cadastro->SetUsuario($Registros["Nome_Usuario"]);
                $Cadastro->SetSenha($Registros["Senha_Acesso"]);
                $Cadastro->SetEmail($Registros["Email"]);
            }
        }
        else {
            echo "<h2>Erro na execução comando SELECT...</h2>";
        }
    }
        
    $conexao_bd->FecharConexao();
    
    return $Cadastro;
}

function ListaUsuarios($CodigoHotel) {
    $conexao_bd = new classBancoDados($GLOBALS["ServidorMySQL"]);

    if ($conexao_bd->AbrirConexao()) {
        $conexao_bd->SetSELECT("*","usuarios");
        $conexao_bd->SetWHERE("Codigo_Hotel = ".$CodigoHotel);
        $conexao_bd->SetORDER("Nome_Usuario");

        if($conexao_bd->ExecSELECT()) {
            $NumeroRegistros = $conexao_bd->TotalRegistros();
            $DataSet = $conexao_bd->GetDataSet();
            
            if($NumeroRegistros > 0) {
                $LinhaTabela = "";
                
                while($Registros = $DataSet->fetch_assoc()) {
                    $LinhaTabela .= "<tr>";
                    $LinhaTabela .= "<td>".$Registros["Nome_Usuario"]."</td>";
                    
                    if($Registros["Nivel_Acesso"] == 1) {
                        $LinhaTabela .=  "<td>Gerência</td>";
                    }
                    else {
                        $LinhaTabela .=  "<td>Atendimento</td>";
                    }

                    $Pagina = "ger_editar_usuario.php?CodigoUsuario=".$Registros["Codigo_Usuario"];
                   
                    $LinhaTabela .= "<td><button onclick=\"carregar('$Pagina')\">Editar</button></td>";
                    $LinhaTabela .= "</tr>";
                }
            }
        }
    }
        
    $conexao_bd->FecharConexao();
    
    return $LinhaTabela;
}

function RecuperaDadosUsuario($CodigoUsuario) {
    $Cadastro = new classUsuario();
    
    $conexao_bd = new classBancoDados($GLOBALS["ServidorMySQL"]);
        
    if (!$conexao_bd->AbrirConexao()) {
       echo "<h2>Não foi possível conectar com o banco de dados do site</h2><br>";
       echo $conexao_bd->CodigoErro() . " -> " . $conexao_bd->MensagemErro();
    }
    else {
        $conexao_bd->SetSELECT("*","usuarios");
        $conexao_bd->SetWHERE("Codigo_Usuario = $CodigoUsuario");

        if($conexao_bd->ExecSELECT()) {
            $NumeroRegistros = $conexao_bd->TotalRegistros();
            $DataSet = $conexao_bd->GetDataSet();
            
            if($NumeroRegistros > 0) {
                $Registros = $DataSet->fetch_assoc();
                
                $Cadastro->SetNomeUsuario($Registros["Nome_Usuario"]);
                $Cadastro->SetSenhaAcesso($Registros["Senha_Acesso"]);
                $Cadastro->SetNivelAcesso($Registros["Nivel_Acesso"]);
                $Cadastro->SetHotel($Registros["Codigo_Hotel"]);
            }
        }
        else {
            echo "<h2>Erro na execução comando SELECT...</h2>";
        }
    }
        
    $conexao_bd->FecharConexao();
    
    return $Cadastro;
}

function ListaApartamentos($CodigoHotel) {
    $conexao_bd = new classBancoDados($GLOBALS["ServidorMySQL"]);

    if ($conexao_bd->AbrirConexao()) {
        $conexao_bd->SetSELECT("*","apartamentos");
        $conexao_bd->SetWHERE("Codigo_Hotel = ".$CodigoHotel);
        $conexao_bd->SetORDER("Numero_Apartamento");

        if($conexao_bd->ExecSELECT()) {
            $NumeroRegistros = $conexao_bd->TotalRegistros();
            $DataSet = $conexao_bd->GetDataSet();
            
            if($NumeroRegistros > 0) {
                $LinhaTabela = "";
                
                while($Registros = $DataSet->fetch_assoc()) {
                    $LinhaTabela .= "<tr>";
                    $LinhaTabela .= "<td>".$Registros["Numero_Apartamento"]."</td>";
                    $LinhaTabela .= "<td>".$Registros["Numero_Chave"]."</td>";
                    $LinhaTabela .= "<td>".$Registros["Tem_TV"]."</td>";
                    $LinhaTabela .= "<td>".$Registros["Tem_Frigobar"]."</td>";
                    $LinhaTabela .= "<td>".$Registros["Tem_Banheira"]."</td>";
                    $LinhaTabela .= "<td>".$Registros["Tem_Escrivaninha"]."</td>";

                    $Pagina = "ger_editar_apartamento.php?RegistroApartamento=".$Registros["ID_Registro"];
                   
                    $LinhaTabela .= "<td><button onclick=\"carregar('$Pagina')\">Editar</button></td>";
                    $LinhaTabela .= "</tr>";
                }
            }
        }
    }
        
    $conexao_bd->FecharConexao();
    
    return $LinhaTabela;
}

function RecuperaDadosApartamento($CodigoApartamento) {
    $Cadastro = new classApartamento();
    
    $conexao_bd = new classBancoDados($GLOBALS["ServidorMySQL"]);
        
    if (!$conexao_bd->AbrirConexao()) {
       echo "<h2>Não foi possível conectar com o banco de dados do site</h2><br>";
       echo $conexao_bd->CodigoErro() . " -> " . $conexao_bd->MensagemErro();
    }
    else {
        $conexao_bd->SetSELECT("*","apartamentos");
        $conexao_bd->SetWHERE("ID_Registro = $CodigoApartamento");

        if($conexao_bd->ExecSELECT()) {
            $NumeroRegistros = $conexao_bd->TotalRegistros();
            $DataSet = $conexao_bd->GetDataSet();
            
            if($NumeroRegistros > 0) {
                $Registros = $DataSet->fetch_assoc();
               
                $Cadastro->SetIDApartamento($Registros["ID_Registro"]);
                $Cadastro->SetNumeroApartamento($Registros["Numero_Apartamento"]);
                $Cadastro->SetNumeroChave($Registros["Numero_Chave"]);
                $Cadastro->SetTipoApartamento($Registros["Tipo_Apartamento"]);
                $Cadastro->SetTipoAcomodacao($Registros["Tipo_Acomodacao"]);
                $Cadastro->SetCamas($Registros["Quantidade_Cama"]);
                $Cadastro->SetTV($Registros["Tem_TV"]);
                $Cadastro->SetFrigobar($Registros["Tem_Frigobar"]);
                $Cadastro->SetBanheira($Registros["Tem_Banheira"]);
                $Cadastro->SetEscrivaninha($Registros["Tem_Escrivaninha"]);
            }
        }
        else {
            echo "<h2>Erro na execução comando SELECT...</h2>";
        }
    }
        
    $conexao_bd->FecharConexao();
    
    return $Cadastro;
}
