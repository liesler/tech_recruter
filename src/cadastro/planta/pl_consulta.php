<?php 
require_once("../../conexao/conexao.php");

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

$sql=" SELECT p.codplanta, p.nome, p.mes_floracao,
              a.nome AS abelha  
         FROM plantas p 
         LEFT JOIN abelhas a ON a.codabelha =  p.codabelha
        order by p.codplanta desc";
$consulta = mysqli_query($oMysql->handle,$sql);

$sqlAbelhas="select a.codabelha, a.nome
        from abelhas a ";
$consultaAbelhas = mysqli_query($oMysql->handle,$sqlAbelhas);

if (isset($_POST['btnpesquisar'])) {
  $aSqlAdd = array();
  $pesquisar  ="";
  if($_POST['pesquisa'] !== ''){
    $aSqlAdd[]="p.nome like'%$_POST[pesquisa]%'";
  }

  if($_POST['abelha'] !== ''){
    $aSqlAdd[]="p.codabelha = '$_POST[abelha]'";
  }

  if (isset($_POST['mes'])) {
    if(count($_POST['mes']) > 0 ){
      $aSqlAdd[]="p.mes_floracao in(".implode(",",$_POST['mes']).")";
      
    }
  }

  if(count($aSqlAdd)){
    $pesquisar .= (" WHERE " . implode(" AND ", $aSqlAdd) ); 
  }

  $sql="SELECT p.codplanta, p.nome, p.mes_floracao,
               a.nome AS abelha  
          FROM plantas p 
          LEFT JOIN abelhas a ON a.codabelha =  p.codabelha
          $pesquisar ";
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
#plantas {
}
.style4 {font-size: 16px}

</style>
</head>

<body>
<?php 
include_once '../../menu/menu.php';
?>
<div id="plantas">
  <table width="564" border="1" align="center" cellspacing="0" bordercolor="#000000" bgcolor="#FFFFFF">
    <tr>
      <td colspan="6"><p align="center">Consulta de plantas</p></td>
    </tr>
    <tr>
      <td colspan="6">
        <form id="frmPesquisa" name="frmPesquisa" method="post" action="">
          <div>
            <input style="width:80%" type="text" name="pesquisa" placeholder="Pesquisar"/>
            
          </div>
          <div>
          <label>Abelhas: </label>
          <?php
              
              echo "<select name='abelha' id='abelha'>\n";
              echo "<option value=''>Selecione</option>\n";
              while($resposta = mysqli_fetch_array($consultaAbelhas)) {
                  echo "<option value='$resposta[codabelha]'>$resposta[nome]</option>\n";
              }
              echo "</select>";
          ?>
          </div>
          <div>
            <label>Mês floração: </label>
            <?php
              $iCt = 0;
              $aAuxGrupo = array();
              echo '<div>';
              foreach($months as $key =>$value){
                  $bChecked = true;

                  if (($iCt > 0) && ($iCt % 3 == 0)) {
                      echo '</div><div>';
                  }
                  $iCt++;
                  echo '<div>';
                  echo "<input type='checkbox' name='mes[$key]' id='mes[]' value='$key'  ;/> $value <br/>";
                  
              }
              echo '</div>';
            ?>
          </div>
          <div align="center">
            <input name="btnpesquisar" type="submit" id="btnpesquisar" value="Pesquisar" />
          <div>
        </form>
      </td>
    </tr>
    <tr>
      <td width="92"><div align="center">Identifica&ccedil;&atilde;o</div></td>
      <td width="219"><div align="center">Nome</div></td>
      <td width="93"><div align="center">Mês floração </div></td>
      <td width="219"><div align="center">Abelha </div></td>
      <td colspan="2"> <div align="center"><a href="pl_alteracao.php">Inserir</a></div></td>
    </tr>
    <?php while($resposta = mysqli_fetch_array($consulta)) {?>
    <tr>
      <td><div align="center"><?php echo $resposta['codplanta'];?></div></td>
      <td><?php echo $resposta['nome'];?></td>
      <td><?php echo $resposta['mes_floracao'];?></td>
      <td><?php echo $resposta['abelha'];?></td>
      <td width="69"><div align="center"><a href = "pl_alteracao.php?id=<?php echo $resposta['codplanta'];?>&acao=alterar">alterar</a></div></td>
      <td width="69"><div align="center"><a href = "pl_excluir.php?id=<?php echo $resposta['codplanta'];?>&acao=excluir">excluir</a></div></td>
    </tr>
    <?php }?>
   </table>
</div>
<p align="center">&nbsp;</p>
</body>
</html>