<?php
require_once("../../conexao/conexao.php");

if(isset($_GET['id']))
{
	$sql = "delete from abelhas where codabelha = '$_GET[id]';";

	mysqli_query($oMysql->handle,$sql);
	mysqli_close($oMysql->handle);
}
	$saida = "ab_consulta.php";
	header("location:".$saida);