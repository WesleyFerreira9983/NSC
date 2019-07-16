<?php 
ob_start();
include ("conexao.php");
session_start();
session_destroy ();
mysqli_close($conexao);
header ('location:index.php');
ob_flush (); 
?>

