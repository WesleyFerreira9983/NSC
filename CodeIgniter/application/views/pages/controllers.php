  <?php  
	
	function GetDepartamentos($conexao, $nome)
	{
		$comando = "select * from departamentos where nome LIKE '%{$nome}%'";
		$resultado =  mysqli_query ($conexao,$comando);
		return $resultado;
	}
	
	function GetUsuarios($conexao, $nome)
	{
		$comando = "select * from usuarios where nome LIKE '%{$nome}%'";
		$resultado =  mysqli_query ($conexao,$comando);
		return $resultado;
	}
	
	function GetProdutoCategorias($conexao, $nome)
	{
		$comando = "select * from categoriasproduto where nome LIKE '%{$nome}%'";
		$resultado =  mysqli_query ($conexao,$comando);
		return $resultado;
	}
	
	function GetProdutos($conexao, $nome)
	{
		$comando = "select * from produtos where nome LIKE '%{$nome}%'";
		$resultado =  mysqli_query ($conexao,$comando);
		return $resultado;
	}
	
	function GetDepartamentosIndex($conexao, $nome)
	{
		$comando = "select * from departamentos where nome = '{$nome}'";
		$resultado =  mysqli_query ($conexao,$comando);
		return $resultado;
	}
	
	function GetUsuariosIndex($conexao, $id)
	{
		$comando = "select * from usuarios where cpf = {$id}";
		$resultado =  mysqli_query ($conexao,$comando);
		return $resultado;
	}
	
	function GetProdutoCategoriasIndex($conexao, $id)
	{
		$comando = "select * from categoriasproduto where id_categoria = {$id}";
		$resultado =  mysqli_query ($conexao,$comando);
		return $resultado;
	}
	
	function GetProdutosIndex($conexao, $id)
	{
		$comando = "select * from produtos where id_produto = {$id}";
		$resultado =  mysqli_query ($conexao,$comando);
		return $resultado;
	}
	
	function InserirUsuarios($conexao, $cpf, $nome, $sobrenome, $email, $senha, $telefone, $celular, $nivelacesso, $datanascumento, $departamento, $superiorresponsavel)
	{
		$cpf = (str_replace('.', '', $cpf));
		$cpf = (double)(str_replace('-', '', $cpf));
		$superiorresponsavel = (str_replace('.', '', $superiorresponsavel));
		$superiorresponsavel = (double)(str_replace('-', '', $superiorresponsavel));
		
		 mysqli_query($conexao,"insert into usuarios(cpf,nome,sobrenome,email,senha,telefone,celular,nivelacesso
		,datanascimento,departamento,id_superiorresponsavel) values ({$cpf}, '{$nome}', '{$sobrenome}', '{$email}', 
		'{$senha}', '{$telefone}', '{$celular}', {$nivelacesso}, '{$datanascumento}', '{$departamento}', '{$superiorresponsavel}')") or die(mysqli_error($conexao));
	}
	
	function InserirDepartamento($conexao,$nome,$superiorresponsavel)
	{	
		$superiorresponsavel = (str_replace('.', '', $superiorresponsavel));
		$superiorresponsavel = (double)(str_replace('-', '', $superiorresponsavel));
		mysqli_query($conexao,"insert into departamentos(nome,id_funcionarioresponsavel) values ('{$nome}', {$superiorresponsavel})") or die(mysqli_error($conexao));
	}
	
	function InserirProduto($conexao,$nome,$descricao,$quantidade,$preco,$categoriaproduto)
	{	
		mysqli_query($conexao,"insert into produtos(nome,descricao,quantidade,preco,id_categoria) values 
		('{$nome}','{$descricao}',{$quantidade},{$preco},{$categoriaproduto})") or die(mysqli_error($conexao));
	}
	
	function InserirCategoria($conexao,$nome)
	{	
		mysqli_query($conexao,"insert into categoriasproduto(nome) values('{$nome}')") or die(mysqli_error($conexao));
	}
	
	function RemoveUsuario($conexao,$id){
        $comando= "delete from usuarios where cpf = {$id}";
        return mysqli_query($conexao,$comando);
	}
	
	function RemoveDepartamento($conexao,$nome)
	{
        $comando= "delete from departamentos where nome = '{$nome}'";
        return mysqli_query($conexao,$comando);
	}
	
	function RemoveCategoriasProduto($conexao,$id)
	{
        $comando= "delete from categoriasproduto where id_categoria = {$id}";
        return mysqli_query($conexao,$comando);
	}
	
	function RemoveProdutos($conexao,$id)
	{
        $comando= "delete from produtos where id_produto = {$id}";
        return mysqli_query($conexao,$comando);
	}
	
	function AlteraUsuario($conexao,$id, $nome, $sobrenome, $email, $senha, $telefone, $celular, $datanascimento, $departamento, $superiorresponsavel)
	{
       $comando= "update usuarios set nome='{$nome}', sobrenome = '{$sobrenome}', email = '{$email}',
	   senha = '{$senha}', telefone = '{$telefone}', celular = '{$celular}', datanascimento = '{$datanascimento}', departamento = '{$departamento}', id_superiorresponsavel = {$superiorresponsavel} where cpf={$id}" ;
       return mysqli_query ($conexao,$comando);
	}
	
	function AlteraDepartamento($conexao,$id,$nome,$id_funcionarioresponsavel)
	{
        $comando= "update departamentos set nome = '{$nome}',  id_funcionarioresponsavel = {$id_funcionarioresponsavel} where nome='{$id}'" ;
        return mysqli_query ($conexao,$comando);
	}
	
	function AlteraCategoriasProduto($conexao,$id,$nome)
	{
        $comando= "update categoriasproduto set nome='{$nome}' where id_categoria={$id}" ;
        return mysqli_query ($conexao,$comando);
	}
	
	function AlteraProdutos($conexao,$id,$nome,$descricao,$quantidade,$preco,$categoriaproduto)
	{
        $comando= "update produtos set nome = '{$nome}', descricao = '{$descricao}', quantidade = {$quantidade},
		preco = {$preco}, id_categoria = {$categoriaproduto} where id_produto={$id}" ;
        return mysqli_query ($conexao,$comando);
	}
	
	function GetIndicatorNumberIndex($conexao,$table,$campo,$referencia)
	{
		$comando = "select * from ".$table." where ".$campo." = {$referencia}";
		$resultado =  mysqli_query ($conexao,$comando);
		return $resultado;
	}
	
	function GetIndicatorStringIndex($conexao,$table,$campo,$referencia)
	{
		$comando = "select * from ".$table." where ".$campo." = '{$referencia}'";
		$resultado =  mysqli_query ($conexao,$comando);
		return $resultado;
	}

?>