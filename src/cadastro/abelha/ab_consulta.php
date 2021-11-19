<?php 
require_once("../../conexao/conexao.php");

$sql="select a.codabelha, a.nome
        from abelhas a 
        order by a.codabelha desc";
$consulta = mysqli_query($oMysql->handle,$sql);


if (isset($_POST['btnpesquisar'])) {

  $sql="select a.codabelha, a.nome
        from abelhas a
       where a.nome like'%$_POST[pesquisa]%' ";
  $consulta = mysqli_query($oMysql->handle,$sql);

}	

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Teste Backend</title>
<style type="text/css">

body {
	background-color: #CCCCCC;
}
#abelha {
}
.style4 {font-size: 16px}

</style>
</head>

<body>
<?php 
include_once '../../menu/menu.php';
?>
<div id="abelha">
  <table width="564" border="1" align="center" cellspacing="0" bordercolor="#000000" bgcolor="#FFFFFF">
    <tr>
      <td colspan="5"><p align="center">Consulta de abelhas</p></td>
    </tr>

    <tr>
      <td colspan="5">
        <form id="frmPesquisa" name="frmPesquisa" method="post" action="">
          <input style="width:80%" type="text" name="pesquisa" placeholder="Pesquisar"/>
          <input name="btnpesquisar" type="submit" id="btnpesquisar" value="Pesquisar" />
        </form>
      </td>
    </tr>
    <tr>
      <td width="92"><div align="center">Identifica&ccedil;&atilde;o</div></td>
      <td width="219"><div align="center">Nome</div></td>
      <td colspan="2"> <div align="center"><a href="ab_alteracao.php">Inserir</a></div></td>
    </tr>
    <?php while($resposta = mysqli_fetch_array($consulta)) {?>
    <tr>
      <td><div align="center"><?php echo $resposta['codabelha'];?></div></td>
      <td><?php echo $resposta['nome'];?></td>
      <td width="69"><div align="center"><a href = "ab_alteracao.php?id=<?php echo $resposta['codabelha'];?>&acao=alterar">alterar</a></div></td>
      <td width="69"><div align="center"><a href = "ab_excluir.php?id=<?php echo $resposta['codabelha'];?>&acao=excluir">excluir</a></div></td>
    </tr>
    <?php }?>
   </table>
</div>
<p align="center">&nbsp;</p>
</body>
</html>