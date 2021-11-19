<?php
extract($_GET);
require_once("../../conexao/conexao.php");

if (isset($_POST['incluir'])) {

    $sql = "INSERT INTO abelhas (nome, codplanta) VALUES ('$_POST[nome]')";
    mysqli_query($oMysql->handle, $sql);

	
	$saida = "ab_consulta.php";
	header("location:".$saida);
}	

if (isset($_POST['alterar'])) {
    $sql = "UPDATE abelhas SET nome = '$_POST[nome]'
                         WHERE codabelha = '$_GET[id]'";


  mysqli_query($oMysql->handle, $sql);

  $saida = "ab_consulta.php";
  header("location:".$saida);
}	

if (isset($_GET['acao'])) {
    if($_GET['acao'] == 'alterar'){
        $sql=" SELECT nome, codabelha 
                 FROM abelhas 
                WHERE codabelha = '$_GET[id]'";
        $consulta = mysqli_query($oMysql->handle,$sql);
        $oRes = mysqli_fetch_array($consulta);
    }
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt" xml:lang="pt">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <meta http-equiv="Pragma" content="no-cache" />
        <title>Teste Backend    </title>
        
    </head>
    <body id="container">
        <?php 
            include_once '../../menu/menu.php';
        ?>

        <div id="formulario">
            <form id="frmCadastro" name="frmCadastro" method="post" action="">
                <p>&nbsp;</p>
                <table width="494" border="0" align="center" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
                    <tr>
                        <td width="242"><div align="right">Nome: </div></td>
                        <td width="242"><input type="text" name="nome" value="<?=isset($_GET['acao']) ? $oRes['nome']:"" ?>" /></td>
                    </tr>           
                
                    <tr>
                        <td colspan="2"><div align="center">
                        <?php
                            if(isset($_GET['acao'])){ 
                                echo '<input name="alterar" type="submit" id="alterar" value="alterar" />';   
                            }else{
                                echo '<input name="incluir" type="submit" id="incluir" value="incluir" />';
                            }
                        ?>
                        </div></td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>