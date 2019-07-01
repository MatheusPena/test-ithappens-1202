<?php
require_once('../DAO/usuario.php');
$cad_produto = new UsuarioDAO();
$cad_produto->cadastarProduto($_POST['produto'],$_POST['qtde'],$_POST['v_un'],$_POST['filial'],$_POST['cod_barras']);
?>
