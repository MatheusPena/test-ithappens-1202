<?php
require_once('../DAO/usuario.php');
$cancelar_produto = new UsuarioDAO();
$cancelar_produto->cancelarProduto($_GET['id_prod'],null);
?>
