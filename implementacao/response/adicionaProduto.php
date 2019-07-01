<?php

require_once('../DAO/usuario.php');
$addProd = new UsuarioDAO();
$addProd->addProdutoCarrinho($_POST['id_pedido'],$_POST['id_produto'],$_POST['qtde'],$_POST['valor_un'],$_POST['tipo_ped']);
echo "<script language=\"javascript\">window.history.back();</script>";

?>
