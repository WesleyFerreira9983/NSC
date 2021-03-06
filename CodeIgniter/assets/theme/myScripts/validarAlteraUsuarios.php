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

if (empty($_POST["sobrenome"])) {
    $errorInput .= "sobrenome ";
	$errorMessage = "Os campos não devem ser vazios";
}

if (empty($_POST["email"])) {
    $errorInput .= "email ";
	$errorMessage = "Os campos não devem ser vazios";
} 

if (empty($_POST["senha"])) {
    $errorInput .= "senha ";
	$errorMessage = "Os campos não devem ser vazios";
} 

if (empty($_POST["confsenha"])){
	$errorInput .= "confsenha ";
	$errorMessage = "Os campos não devem ser vazios";
}  

if (empty($_POST["nivelacesso"])) {
    $errorInput .= "nivelacesso ";
	$errorMessage = "Os campos não devem ser vazios";
}  

if($_POST["senha"] != $_POST["confsenha"])
{
	$errorInput .= "senha ";
	$errorInput .= "confsenha ";
	$errorMessage = "Os campos devem ser iguais";
}

if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
{
	$errorInput .= "email ";
	$errorMessage = "O email não é valido";
}

$resultado = GetIndicatorNumberIndex($conexao,"usuarios","cpf",$_POST["cpf"]);
$user = mysqli_fetch_array($resultado);
$resultado_email = GetIndicatorStringIndex($conexao,"usuarios","email",$_POST["email"]);
$email = mysqli_fetch_array($resultado_email);
if($email["email"] != $user["email"] && $email != null ){
$errorInput .= "email ";
$errorMessage = "O email já existe no sistema";	
}
	

if(empty($errorInput)){
	$msg = "nome sobrenome email senha confsenha nivelacesso datanascimento telefone celular departamaento superiorresponsavel ";
	echo json_encode(['code'=>200, 'msg'=>$msg]);
	exit;
}

echo json_encode(['code'=>404, 'msg'=>$errorInput, 'error' => $errorMessage]);
?>