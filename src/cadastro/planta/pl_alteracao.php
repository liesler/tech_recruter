<?php
extract($_GET);
require_once("../../conexao/conexao.php");

if (isset($_POST['incluir'])) {
      $sql = "INSERT INTO plantas (nome, mes_floracao, codabelha)
              VALUES ('$_POST[nome]', '$_POST[mes]', '$_POST[abelha]')";

    
    mysqli_query($oMysql->handle, $sql);

	$saida = "pl_consulta.php";
	header("location:".$saida);
}	

if (isset($_POST['alterar'])) {
    $sql = "UPDATE plantas SET nome = '$_POST[nome]',
                               mes_floracao ='$_POST[mes]',
                               codabelha= '$_POST[abelha]'
                         WHERE codplanta = '$_GET[id]'";


  mysqli_query($oMysql->handle, $sql);

  $saida = "pl_consulta.php";
  header("location:".$saida);
}	


if (isset($_GET['acao'])) {
    if($_GET['acao'] == 'alterar'){
        $sql=" SELECT p.codplanta, p.nome, p.mes_floracao,p.codabelha,
                      a.nome AS abelha  
                 FROM plantas p 
                 LEFT JOIN abelhas a ON a.codabelha =  p.codabelha
                WHERE p.codplanta = '$_GET[id]'";
        $consulta = mysqli_query($oMysql->handle,$sql);
        $oRes = mysqli_fetch_array($consulta);
    }
}

$months = array(
    "01" => 'Janeiro',
    "02" =>'Fevereiro',
    "03" =>'Março',
    "04" =>'Abril',
    "05" =>'Maio',
    "06" =>'Junho',
    "07" =>'Julho ',
    "08" =>'Agosto',
    "09" =>'Setembro',
    "10" =>'Outubro',
    "11" =>'Novembro',
    "12" =>'Desembro',
);

$sqlAbelhas="select a.codabelha, a.nome
        from abelhas a ";
$consultaAbelhas = mysqli_query($oMysql->handle,$sqlAbelhas);

?>
<?= "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt" xml:lang="pt">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <meta http-equiv="Pragma" content="no-cache" />
        <title>Teste Backend</title>
        
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
                    <td><div align="right">Mês: </div></td>
                    <td>
                    <?php
                        echo "<select name='mes' id='mes'>\n";
                            foreach($months as $key =>$value){
                                if(isset($_GET['acao'])){
                                    $bChecked = '';
                                    if($oRes['mes_floracao'] == $key){
                                        $bChecked = 'selected';
                                    }                                    
                                }
                                echo "<option value='$key' $bChecked >$value</option>\n";
                            }
                        echo "</select>";
                    ?>
                    </td>
                </tr>
                <tr>
                    <td><div align="right">Abelha: </div></td>
                    <td>
                        <?php
                            echo "<select name='abelha' id='abelha'>\n";
                            while($resposta = mysqli_fetch_array($consultaAbelhas)) {
                                if(isset($_GET['acao'])){
                                    $bChecked = '';
                                    if($oRes['codabelha'] == $resposta['codabelha']){
                                        $bChecked = 'selected';
                                    }                                    
                                }
                                echo "<option value='$resposta[codabelha]' $bChecked >$resposta[nome]</option>\n";
                            }
                            echo "</select>";
                        ?>
                    </td>
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