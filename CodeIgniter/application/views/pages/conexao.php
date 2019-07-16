  <?php  
	$servidor = "localhost";
	$usuario = "root";
	$senha = "";
	$dbname = "empresa";
	
	$conexao = mysqli_connect($servidor, $usuario, $senha, $dbname);

	if(!$conexao){
		die("Falha na conexao: " . mysqli_connect_error($conexao));
	}
	
	 if (!$conexao->set_charset("utf8")) {
      printf("Error loading character set utf8: %s\n", $conexao->error);
	} 
?>