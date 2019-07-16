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

if (empty($_POST["quantidade"])) {
    $errorInput .= "quantidade ";
	$errorMessage = "Os campos não devem ser vazios";
} 

if (empty($_POST["preco"])) {
    $errorInput .= "preco ";
	$errorMessage = "Os campos não devem ser vazios";
} 

if (empty($_POST["categoriaproduto"])) {
    $errorInput .= "categoriaproduto ";
	$errorMessage = "Os campos não devem ser vazios";
} 

$resultado = GetIndicatorStringIndex($conexao,"produtos","nome",$_POST["nome"]);
$produto = mysqli_fetch_array($resultado);
if($produto != null){
	$errorInput .= "nome ";
	$errorMessage = "O produto já existe no sistema";	
}

if(empty($errorInput)){
	$msg = "nome descricao quantidade preco categoriaproduto ";
	echo json_encode(['code'=>200, 'msg'=>$msg]);
	exit;
}

echo json_encode(['code'=>404, 'msg'=>$errorInput, 'error' => $errorMessage]);
?>