<?PHP 
  # Dados para a conex�o com o banco de dados
  $servidor = 'localhost'; # Nome DNS ou IP do seu servidor HTTP
  $porta = '5432'; 	   # Porta do servidor PostgreSQL
  $usuario = 'root';       # Nome de usu�rio para acesso ao PostgreSQL
  $senha = '*******';      # Senha de acesso
  $banco = 'INTEGRACAO';   # Nome do banco de dados

  # Executa a conex�o com o PostgreSQL
  $link = pg_connect("host=$servidor port=$porta dbname=$banco user=$usuario password=$senha");

  # Cria a express�o SQL de consulta aos registros
  $sql = "SELECT * FROM LIVROS";
?>
 <HTML>
  <TABLE border=1>
   <TR>
    <TD>C�d.</TD>
    <TD>Livro</TD>
    <TD>Autor</TD>
    <TD>Editora</TD>
   </TR>

<?
  # Exibe os resultados de novidades e not�cias
  $result = pg_query($sql);
  while ($tbl = pg_fetch_array($result)) 
  {
    $Codigo  = $tbl["id"];
    $Livro   = $tbl["livro"];
    $Autor   = $tbl["autor"];
    $Editora = $tbl["editora"];

    echo "<TR>";
    echo "<TD>$Codigo ";
    echo "<A href=\"inserir.php?acao=editar&buscacodigo=$Codigo\">";
    echo "(Editar)</A>";
    echo "<A href=\"gerencia-registro.php?acao=excluir&buscacodigo=$Codigo\">";
    echo "(Excluir)</A>";
    echo "</TD>";
    echo "<TD>$Livro</TD>";
    echo "<TD>$Autor</TD>";
    echo "<TD>$Editora</TD>";
    echo "</TR>";
  }
?>
  </TABLE>
  <BR><A href="inserir.php">Clique aqui para inserir um novo registro.</A>
 </HTML>
