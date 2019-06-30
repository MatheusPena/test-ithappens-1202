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

  /* Método: listarFilial
  Lista todas as Filiais cadastradas no banco de dados
  */
  public function listarFilial(){
    try {
      $listar_filial = $this->conn->prepare("SELECT * FROM filial");
      $listar_filial->execute();
      $query_result = $listar_filial->fetchAll(PDO::FETCH_OBJ);
      return $query_result;
    } catch (PDOException $erro) {
      echo "<script language=\"javascript\">alert(\"Erro ao listar filiais\")</script>";
    }
  }

  /* Método: estoqueFilial
  Listar o estoque de cada filial
  */
  public function estoqueFilial($id_filial){
    try {
      $est_filial = $this->conn->prepare("SELECT * FROM filial
      INNER JOIN estoque ON filial.ID = estoque.filial
      WHERE filial.ID='$id_filial'");
      $est_filial->execute();
      $query_result = $est_filial->fetchAll(PDO::FETCH_OBJ);
      return $query_result;
    } catch (PDOException $erro) {
      echo "<script language=\"javascript\">alert(\"Erro ao listar filiais\")</script>";
    }
  }






}
?>
