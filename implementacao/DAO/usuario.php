<?php

require_once('conexao.php');
class UsuarioDAO{
  public $conn = null;
  function __construct(){$this->conn = PDOconectar::conectar();}

  /* Método: cadastrarFilial
  Cadastra todos os dados recebidos da tela "cadFilial.php"
  */

  public function cadastarFilial($nome_filial){
    try {
      $this->conn->beginTransaction();
      $query_Sql = "INSERT INTO filial(Nome) VALUES (:Nome)";
      $sql = $this->conn->prepare($query_Sql);
      $sql->bindValue(':Nome', $nome_filial);
      $sql->execute();
      if ($sql) {
        $this->conn->commit();
        echo "<script language=\"javascript\">alert(\"Filial cadastrada com sucesso!\")</script>";
      }
    } catch (PDOException $erro) {
      $this->conn->rollBack();
      echo "<script language=\"javascript\">alert(\"Erro ao cadastrar Filial!\")</script>";
    }
  }

?>
