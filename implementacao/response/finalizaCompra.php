<?php
require_once('../DAO/usuario.php');
$finalizar_compra = new UsuarioDAO();
$finalizar_compra->finalizarPedido($_POST['f_pag'],$_POST['idp'],$_POST['tipo_ped']);
?>
