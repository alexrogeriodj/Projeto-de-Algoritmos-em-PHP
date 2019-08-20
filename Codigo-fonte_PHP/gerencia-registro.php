<?PHP 
  # Dados para a conex�o com o banco de dados
  $servidor = 'localhost'; # Nome DNS ou IP do seu servidor HTTP
  $porta = '5432'; 	   # Porta do servidor PostgreSQL
  $usuario = 'root';       # Nome de usu�rio para acesso ao PostgreSQL
  $senha = '*******';      # Senha de acesso
  $banco = 'INTEGRACAO';   # Nome do banco de dados

  # Executa a conex�o com o PostgreSQL
  $link = pg_connect("host=$servidor port=$porta dbname=$banco user=$usuario password=$senha");

  # Verifica se o arquivo foi chamado a partir de um formul�rio
  if($acao == "adicionar")
  {
    # Cria a express�o SQL de inser��o
    $sql = "INSERT INTO LIVROS (LIVRO, AUTOR, EDITORA) VALUES (";
    $sql .= "'$FormNomeLivro', ";
    $sql .= "'$FormNomeAutor', ";
    $sql .= "'$FormNomeEditora'";
    $sql .= ")";

    # Executa a express�o SQL no servidor, e armazena o resultado
    $result = pg_query($sql);

    # Verifica o sucesso da opera��o
    if (!$result) 
    { die('Erro: '.pg_last_error($link)); }

    # Se a opera��o foi realizada com sucesso, informa na tela
    else
    { echo 'A opera��o foi realizada com sucesso.'; }
  }
  else if($acao == "alterar")
  {
    # Cria a express�o SQL de altera��o
    $sql = "UPDATE LIVROS SET ";
    $sql .= "LIVRO = '$FormNomeLivro', ";
    $sql .= "AUTOR = '$FormNomeAutor', ";
    $sql .= "EDITORA = '$FormNomeEditora'";
    $sql .= " WHERE ID = $FormCodigoLivro";

    # Executa a express�o SQL no servidor, e armazena o resultado
    $result = pg_query($sql);

    # Verifica o sucesso da opera��o
    if (!$result) 
    { die('Erro: '.pg_last_error($link)); }

    # Se a opera��o foi realizada com sucesso, informa na tela
    else
    { echo 'A opera��o foi realizada com sucesso.'; }
  }
  else if($acao == "excluir")
  {
    # Cria a express�o SQL de exclus�o
    $sql = "DELETE FROM LIVROS WHERE ID = $buscacodigo";

    # Executa a express�o SQL no servidor, e armazena o resultado
    $result = pg_query($sql);

    # Verifica o sucesso da opera��o
    if (!$result) 
    { die('Erro: '.pg_last_error($link)); }

    # Se a opera��o foi realizada com sucesso, informa na tela
    else
    { echo 'A opera��o foi realizada com sucesso.'; }
  }
?>
  <BR><A href="inserir.php">Clique aqui para inserir um novo registro.</A>
  <BR><A href="lista.php">Clique aqui para visualizar os registros.</A>