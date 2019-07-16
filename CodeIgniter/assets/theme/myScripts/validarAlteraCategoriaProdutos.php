<?php

include ("conexao.php");
include ("controllers.php");
				
$errorInput = "";
$errorMessage = "";

/* NAME */
if (empty($_POST["nome"])) {
    $errorInput = "nome ";
	$errorMessage = "Os campos não devem ser vazios";
} 

$resultado = GetIndicatorNumberIndex($conexao,"categoriasproduto","id_categoria",$_POST["id"]);
$nomeCategoria = mysqli_fetch_array($resultado);

$resultado = GetIndicatorStringIndex($conexao,"categoriasproduto","nome",$_POST["nome"]);
$categoria = mysqli_fetch_array($resultado);
if($categoria["nome"] != $nomeCategoria["nome"] && $categoria != null){
	$errorInput = "nome ";
	$errorMessage = "A categoria do produto já existe no sistema";	
}

if(empty($errorInput)){
	$msg = "nome ";
	echo json_encode(['code'=>200, 'msg'=>$msg]);
	exit;
}

echo json_encode(['code'=>404, 'msg'=>$errorInput, 'error' => $errorMessage]);
?>