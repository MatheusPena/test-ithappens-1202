<?php
require_once('../DAO/usuario.php');
$cad_pedido = new UsuarioDAO();
$cad_pedido->cadastrarPedido($_POST['filial'],$_POST['usuario'],$_POST['cliente'],$_POST['obs'],$_POST['tipo_pedido']);
?>
