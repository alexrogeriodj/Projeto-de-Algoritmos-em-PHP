<?PHP
  # Dados para a conexão com o banco de dados
  $servidor = 'localhost'; # Nome DNS ou IP do seu servidor HTTP
  $porta = '5432'; 	   # Porta do servidor PostgreSQL
  $usuario = 'root';       # Nome de usuário para acesso ao PostgreSQL
  $senha = '*******';      # Senha de acesso
  $banco = 'INTEGRACAO';   # Nome do banco de dados

  # Executa a conexão com o PostgreSQL
  $link = pg_connect("host=$servidor port=$porta dbname=$banco user=$usuario password=$senha");

  if($acao == "editar")
  {
    # Cria a expressão SQL de consulta ao registro a ser alterado
    $sql = "SELECT * FROM LIVROS WHERE ID = $buscacodigo";

    # Realiza a busca pelos dados do registro
    $result = pg_query($sql);

    # Valida se o registro existe no banco de dados
    if($tbl = pg_fetch_array($result)) 
    {
      # Armazena os dados para preencher no formulário a seguir
      $Codigo  = $tbl["id"];
      $Livro   = $tbl["livro"];
      $Autor   = $tbl["autor"];
      $Editora = $tbl["editora"];
    }

    # Exibe mensagem de erro se não existir
    else
    { echo "Registro não encontrado."; }
  }
?>

<HTML>
 <HEAD>
  <TITLE>Gerenciando Registros</TITLE>
 </HEAD>
 <BODY>
  Preencha os campos abaixo:
<?
    if($acao == "editar")
    { $AcaoForm = "alterar"; }
    else
    { $AcaoForm = "adicionar"; }
?>
  <FORM method="POST" action="gerencia-registro.php?acao=<? echo $AcaoForm; ?>">
  <INPUT type="hidden" name="FormCodigoLivro" value="<? echo $Codigo; ?>">
   <TABLE>
    <TR>
     <TD>Nome do Livro:</TD>
     <TD>
      <INPUT name="FormNomeLivro" maxlength=64 value="<? echo $Livro; ?>">
     </TD>
    </TR>
    <TR>
     <TD>Nome do Autor:</TD>
     <TD>
      <INPUT name="FormNomeAutor" maxlength=32 value="<? echo $Autor; ?>">
     </TD>
    </TR>
    <TR>
     <TD>Nome da Editora:</TD>
     <TD>
      <INPUT name="FormNomeEditora" maxlength=16 value="<? echo $Editora; ?>">
     </TD>
    </TR>
    <TR>
     <TD colspan=2 align=right>
      <INPUT type="reset" value="Limpar">
<?
    if($acao == "editar")
    { $NomeBotao = "Alterar"; }
    else
    { $NomeBotao = "Cadastrar"; }
?>
      <INPUT type="submit" value="<? echo $NomeBotao; ?>">
     </TD>
    </TR>
   </TABLE>
  </FORM>
 <BODY>
</HTML>