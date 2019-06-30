<?php
require_once('../DAO/usuario.php');
 $cad_filial = new UsuarioDAO();
 $cad_filial->cadastarFilial($_POST['filial']);
 echo "<script language=\"javascript\">window.history.back();</script>";
?>
