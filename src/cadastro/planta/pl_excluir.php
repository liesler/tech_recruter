<?php
require_once("../../conexao/conexao.php");

if(isset($_GET['id']))
{
	$sql = "delete from plantas where codplanta = '$_GET[id]';";

	mysqli_query($oMysql->handle,$sql);
	mysqli_close($oMysql->handle);
}
	$saida = "pl_consulta.php";
	header("location:".$saida);