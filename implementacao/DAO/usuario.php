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

  /*
   Método: cadastrarPedido
   Cadastra os dados que são recebidos da tela "cadPedido.php"
   a funcionalidade da variável $last_id  é pegar o ultimo id cadastrados e já redirecionar para outra página
  */
  public function cadastrarPedido($filial,$usuario,$cliente,$observacao,$tipo_pedido){
    try {
      $this->conn->beginTransaction();
      $query_Sql = "INSERT INTO pedido(filial,usuario,cliente,observacao,tipo_pedido) VALUES (:filial,:usuario,:cliente,:observacao,:tipo_pedido)";
      $sql = $this->conn->prepare($query_Sql);
      $sql->bindValue(':filial', $filial);
      $sql->bindValue(':usuario', $usuario);
      $sql->bindValue(':cliente', $cliente);
      $sql->bindValue(':observacao', $observacao);
      $sql->bindValue(':tipo_pedido', $tipo_pedido);
      $sql->execute();
      $last_id = $this->conn->lastInsertId();
        if ($sql) {
          $this->conn->commit();
          header('Location: ../infoproduto.php?idp='.$last_id.'&tipo_ped='.$tipo_pedido);
        }
      } catch (PDOException $erro) {
        $this->conn->rollBack();
        echo "<script language=\"javascript\">alert(\"Erro ao cadastrar pedido\")</script>";
      }
  }

  /*
   Método: listarProdutos
   Lista os produtos da tablea "estoque" exibidos na tela "produtos.php"
  */
  public function listarProdutos(){
    try {
      $listar_prod = $this->conn->prepare("SELECT * FROM estoque");
      $listar_prod->execute();
      $query_result = $listar_prod->fetchAll(PDO::FETCH_OBJ);
      return $query_result;
    } catch (PDOException $erro) {
      echo "<script language=\"javascript\">alert(\"Erro ao listar produtos\")</script>";
    }
  }

  /*
  Método: cadastarProduto
  Cadastra os dados que são recebidos da tela "produto.php"
  */
  public function cadastarProduto($produto,$qtde,$valor_prod,$filial,$cod_barra){
    try {
      $this->conn->beginTransaction();
      $query_Sql = "INSERT INTO estoque(produto,qtde,valor_prod,filial,cod_barra) VALUES (:produto,:qtde,:valor_prod,:filial,:cod_barra)";
      $sql = $this->conn->prepare($query_Sql);
      $sql->bindValue(':produto', $produto);
      $sql->bindValue(':qtde', $qtde);
      $sql->bindValue(':valor_prod', $valor_prod);
      $sql->bindValue(':filial', $filial);
      $sql->bindValue(':cod_barra', $cod_barra);
      $sql->execute();
        if ($sql) {
          $this->conn->commit();
          header('Location: ../produto.php?cadprod=success');
        }
      } catch (PDOException $erro) {
        $this->conn->rollBack();
        echo "<script language=\"javascript\">alert(\"Erro ao cadastrar produto\")</script>";
      }
  }



}
?>
