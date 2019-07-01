<?php
require_once('../DAO/usuario.php');
$cancelar_pedido = new UsuarioDAO();
$cancelar_pedido->cancelarPedido($_GET['idp']);
?>
