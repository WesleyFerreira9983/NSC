<?php 
	
	if(isset($_POST["Logar"]))
	{	
		include ("conexao.php");
	   if((isset($_POST['email'])) && (isset($_POST['senha']))){
		 $result_usuario = "SELECT * FROM usuarios WHERE email = '".$_POST["email"]."' and senha = '".$_POST["senha"]."'  LIMIT 1";
		 $resultado_usuario = mysqli_query( $conexao,$result_usuario);
		 $resultado = mysqli_fetch_array($resultado_usuario);
		 if(isset($resultado)){
         session_start();
         $_SESSION['id'] = $resultado['cpf'];
		 $_SESSION['nome'] = $resultado['nome']." ".$resultado['sobrenome'];
		 $_SESSION['email'] = $resultado['email'];
         $_SESSION['permissao'] = $resultado['nivelacesso'];
		 header("location:index.php"); 
		 }
		 header("location:index.php?error=1"); 
	   }
	}
?>