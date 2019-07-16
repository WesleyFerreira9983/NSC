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

if (empty($_POST["superiorresponsavel"])) {
    $errorInput .= "superiorresponsavel ";
	$errorMessage = "Os campos não devem ser vazios";
}  

$resultado = GetIndicatorStringIndex($conexao,"departamentos","nome",$_POST["nome"]);
$departamento = mysqli_fetch_array($resultado);
if($departamento != null){
	$errorInput .= "nome ";
	$errorMessage = "O departamento já existe no sistema";	
}

if(empty($errorInput)){
	$msg = "nome superiorresponsavel ";
	echo json_encode(['code'=>200, 'msg'=>$msg]);
	exit;
}

echo json_encode(['code'=>404, 'msg'=>$errorInput, 'error' => $errorMessage]);
?>