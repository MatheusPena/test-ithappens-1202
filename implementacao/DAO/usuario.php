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
  Método: cancelarPedido
  Altera o status do pedido e dos itens do pedido para "Cancelado"
  $idp = id do pedido
  */
  public function cancelarPedido($idp){
    try {
      $this->conn->beginTransaction();
      $query_Sql = "UPDATE pedido SET status=:value WHERE ID='$idp'";
      $sql = $this->conn->prepare($query_Sql);
      $sql->bindValue(':value', "Cancelado");
      $sql->execute();
      if ($sql) {
        $this->conn->commit();
        self::cancelarProduto(null,$idp);
        header('Location: ../index.php?cancelado=sucesso');
      }
    } catch (PDOException $erro) {
      $this->conn->rollBack();
      echo "<script language=\"javascript\">alert(\"Erro ao cancelar pedido\")</script>";
    }
  }

  /*
  Método: listarPedidos
  Lista todas os pedidos e exibe na tela "buscarpedido.php"
  */
  public function listarPedidos(){
    try {
      $listar_ped = $this->conn->prepare("SELECT * FROM pedido");
      $listar_ped->execute();
      $query_result = $listar_ped->fetchAll(PDO::FETCH_OBJ);
      return $query_result;
    } catch (PDOException $erro) {
      echo "<script language=\"javascript\">alert(\"Erro ao listar pedidos\")</script>";
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
  Método: cancelarProduto
  Altera o status dos produtos do pedido para o valor "Cancelado"

  Observação: Esse método é ativado ao remover o produto diretamente do carrinho
  também é chamado no método "cancelarPedido" caso o usuário cancele o pedido inteiro

  $id = id do produto dentro do pedido
  $id_pedido = id do pedido em si
  */
  public function cancelarProduto($id,$id_pedido){
    try {
      $this->conn->beginTransaction();
      $query_Sql = "UPDATE itens_pedido SET status=:value WHERE ID='$id' OR id_pedido='$id_pedido'";
      $sql = $this->conn->prepare($query_Sql);
      $sql->bindValue(':value', "Cancelado");
      $sql->execute();
      if ($sql) {
        $this->conn->commit();
        echo "<script language=\"javascript\">window.history.back();</script>";
      }
    } catch (PDOException $erro) {
      $this->conn->rollBack();
      echo "<script language=\"javascript\">alert(\"Erro ao cancelar produto\")</script>";
    }
  }

  /*
    Método: itenDetalhesPedido
    Lista os itens em detalhes do pedido
  */
  public function itenDetalhesPedido($idp){
    try {
      $ver_pedido = $this->conn->prepare("SELECT * FROM pedido
      INNER JOIN itens_pedido ON pedido.ID = itens_pedido.id_pedido
      INNER JOIN estoque ON itens_pedido.id_produto = estoque.ID_estoque
      WHERE pedido.ID='$idp'");
      $ver_pedido->execute();
      $query_result = $ver_pedido->fetchAll(PDO::FETCH_OBJ);
      return $query_result;
    } catch (PDOException $erro) {
      echo "<script language=\"javascript\">alert(\"Erro ao listar filiais\")</script>";
    }
  }

  /**
  * Método: headerPedido
  * Responsabilidade: Listar cabeçado em detalhes do pedido
  */
  public function headerPedido($idp){
    try {
      $ver_pedido = $this->conn->prepare("SELECT * FROM pedido
      INNER JOIN itens_pedido ON pedido.ID = itens_pedido.id_pedido
      INNER JOIN pagamento ON pedido.ID = pagamento.id_pag_pedido
      INNER JOIN filial ON pedido.filial = filial.ID
      WHERE pedido.ID='$idp'");
      $ver_pedido->execute();
      $query_result = $ver_pedido->fetchAll(PDO::FETCH_OBJ);
      return $query_result;
    } catch (PDOException $erro) {
      echo "<script language=\"javascript\">alert(\"Erro ao listar filiais\")</script>";
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

  /*
  Método: verificarQuantidade
  Método chamado no "addProduto()" para validar a quantidade no estoque antes de adicionar o produto ao carrinho

  $id_produto = id do produto dentro do pedido
  $qtde_pedido = quantidade que o usuario selecionou para fazer o pedido
  $validacao = recebe valor para ser validado dentro do método addProduto
  */
  public function verificarQuantidade($id_produto,$qtde_pedido){
    try {
      $veri_qtde = $this->conn->prepare("SELECT * FROM estoque WHERE ID_estoque='$id_produto'");
      $veri_qtde->execute();
      $query_result = $veri_qtde->fetchAll(PDO::FETCH_OBJ);
      foreach ($query_result as $v) {
        if ($v->qtde < $qtde_pedido) {
          $validacao = "fail";
        }elseif($v->qtde >= $qtde_pedido) {
          $validacao = "success";
        }
      }
      return $validacao;
    } catch (PDOException $erro) {
      echo "<script language=\"javascript\">alert(\"Erro ao verificar carrinho\")</script>";
    }
  }

  /*
  Método: verificarCarrinho
  Verifica se o carrinho possui itens repetidos no mesmo pedido

  Observação: Esse método é utilizado para validação antes de adicionar um item ao carrinho

  $id_produto = id do produto dentro do pedido
  $id_pedido = id do pedido em si
  */
  public function verificarCarrinho($id_produto,$id_pedido){
    try {
      $veri_prod_repitido = $this->conn->prepare("SELECT * FROM itens_pedido WHERE id_produto='$id_produto' AND id_pedido='$id_pedido' AND status='Ativo'");
      $veri_prod_repitido->execute();
      $count = $veri_prod_repitido->rowCount();
      return $count;
    } catch (PDOException $erro) {
      echo "<script language=\"javascript\">alert(\"Erro ao verificar carrinho\")</script>";
    }
  }

  /*
   Método: addProdutoCarrinho
   Adiciona produtos ao carrinhos

   $id_pedido = id do pedido que o usuário está realizando
   $id_produto = id do produto selecionado
   $qtde_pedido = quantidade pedida para ser adicionada ao carrinho
   $valor_un = valor unitário desse produto
   $tipo_ped = tipo do pedido (Entrada ou saida)

   Observação: Para realizar uma saída (venda) do estoque,
   o estoque tem que ser maior que a quantidade especificada pelo usuário
  */
  public function addProdutoCarrinho($id_pedido,$id_produto,$qtde_pedido,$valor_un,$tipo_ped){
    try {
      if (self::verificarCarrinho($id_produto,$id_pedido) == 0) {
        $valor_total = $valor_un*$qtde_pedido;
        $this->conn->beginTransaction();
        $query_Sql = "INSERT INTO itens_pedido(id_pedido,id_produto,qtde_pedido,valor_un,valor_total) VALUES (:id_pedido,:id_produto,:qtde_pedido,:valor_un,:valor_total)";
        $sql = $this->conn->prepare($query_Sql);
        $sql->bindValue(':id_pedido', $id_pedido);
        $sql->bindValue(':id_produto', $id_produto);
        $sql->bindValue(':qtde_pedido', $qtde_pedido);
        $sql->bindValue(':valor_un', $valor_un);
        $sql->bindValue(':valor_total', $valor_total);
        if (self::verificarQuantidade($id_produto,$qtde_pedido) == 'success' && $tipo_ped == 'Saida') {
          $sql->execute();
            if ($sql && $qtde_pedido>0) {
              $this->conn->commit();
              echo "<script language=\"javascript\">alert(\"Adicionado com sucesso!\")</script>";
            }else{
              echo "<script language=\"javascript\">alert(\"Digite uma quantidade válida!\")</script>";
            }
        }elseif(self::verificarQuantidade($id_produto,$qtde_pedido) == 'fail' && $tipo_ped == 'Entrada') {
          $sql->execute();
            if ($sql && $qtde_pedido>0) {
              $this->conn->commit();
              echo "<script language=\"javascript\">alert(\"Adicionado com sucesso!\")</script>";
            }else{
              echo "<script language=\"javascript\">alert(\"Digite uma quantidade válida!\")</script>";
            }
        }elseif(self::verificarQuantidade($id_produto,$qtde_pedido) == 'fail' && $tipo_ped == 'Saida'){
          echo "<script language=\"javascript\">alert(\"Quantidade não disponível no estoque!\")</script>";
        }elseif(self::verificarQuantidade($id_produto,$qtde_pedido) == 'success' && $tipo_ped == 'Entrada'){
          $sql->execute();
            if ($sql && $qtde_pedido>0) {
              $this->conn->commit();
              echo "<script language=\"javascript\">alert(\"Adicionado com sucesso!!\")</script>";
            }else{
              echo "<script language=\"javascript\">alert(\"Digite uma quantidade válida\")</script>";
            }
        }
      }else {
        echo "<script language=\"javascript\">alert(\"Item já adicionado ao carrinho\")</script>";
      }
    } catch (PDOException $erro) {
      $this->conn->rollBack();
      echo "<script language=\"javascript\">alert(\"Erro ao adicionar produto ao carrinho\")</script>";
    }
  }

  /*
  Método: verCarrinho
  Mostra os produtos cadastrados em um pedido específico
  */
  public function verCarrinho($id_pedido){
    try {
      $itens_carrinho = $this->conn->prepare("SELECT * FROM itens_pedido
      INNER JOIN estoque ON itens_pedido.id_produto = estoque.ID_estoque
      WHERE itens_pedido.id_pedido='$id_pedido' AND itens_pedido.status='Ativo'");

      $itens_carrinho->execute();
      $query_result = $itens_carrinho->fetchAll(PDO::FETCH_OBJ);
      return $query_result;

    } catch (PDOException $erro) {
      echo "<script language=\"javascript\">alert(\"Erro ao exibir itens do carrinho\")</script>";
    }
  }

  /*
  Método: alterarEstoque
  Método utilizado junto com o outro método "finalizarPedido"
  para alterar o estoque dependendo do tipo do pedido

  $itens_pedido = recebe a consulta do método "verCarrinho"
  $tipo_ped = no caso recebe "Entrada" ou "Saida" para saber se adiciona ou decrementa no estoque

  */
  public function alterarEstoque($id_pedido,$tipo_ped){
    try {
      $itens_pedido = self::verCarrinho($id_pedido);
      foreach ($itens_pedido as $i) {
        if ($tipo_ped == 'Entrada') {
          $novo_estoque = $i->qtde + $i->qtde_pedido;
        }elseif ($tipo_ped == 'Saida') {
          $novo_estoque = $i->qtde - $i->qtde_pedido;
        }
        $alterar_estoque = $this->conn->prepare("UPDATE estoque SET qtde=? WHERE ID_estoque='$i->ID_estoque'");
        $alterar_estoque->bindValue(1, $novo_estoque);
        $alterar_estoque->execute();
      }
    } catch (PDOException $erro) {
      echo "<script language=\"javascript\">alert(\"Erro ao alterar no estoque\")</script>";
    }
  }

  /*
  Método: finalizarCompra
  Finaliza o pedido,alterar o estoque dependendo do tipo do pedido,
  alterar o status do pedido para "Processado"

  $forma_pagamento = forma de pagamendo escolhido na tela do "carrinho.php"
  $idp =  id do produto
  $tipo_ped = tipo do pedido Entrada ou saida
  */
  public function finalizarPedido($forma_pagamento,$idp,$tipo_ped){
    try {
      $this->conn->beginTransaction();
      $query_Sql = "INSERT INTO pagamento(forma_pagamento,id_pag_pedido) VALUES (:forma_pagamento,:id_pag_pedido)";
      $sql = $this->conn->prepare($query_Sql);
      $sql->bindValue(':forma_pagamento', $forma_pagamento);
      $sql->bindValue(':id_pag_pedido', $idp);
      $sql->execute();
        if ($sql) {
          $this->conn->commit();
          self::alterarEstoque($idp,$tipo_ped);
          self::alterarStatusProduto($idp);
          self::alterarStatusPedido($idp);
          header('Location: ../index.php?done=success');
        }
      } catch (PDOException $erro) {
        $this->conn->rollBack();
        echo "<script language=\"javascript\">alert(\"Erro ao finalizar pedido\")</script>";
      }
  }

  /*
  Método: alterarStatusProduto
  Altera status do produto para "processado" após finalizar a compra

  $idp = id do pedido
  */
  public function alterarStatusProduto($idp){
    try {
      $this->conn->beginTransaction();
      $query_Sql = "UPDATE itens_pedido SET status=:value WHERE id_pedido='$idp'";
      $sql = $this->conn->prepare($query_Sql);
      $sql->bindValue(':value', "Processado");
      $sql->execute();
      if ($sql) {
        $this->conn->commit();
      }
    } catch (PDOException $erro) {
      $this->conn->rollBack();
      echo "<script language=\"javascript\">alert(\"Erro ao alterar status do produto\")</script>";
    }
  }

  /*
  Método: alterarStatusPedido
  Altera status do pedido para processado após finalizar a compra

  $idp = id do pedido
  */
  public function alterarStatusPedido($idp){
    try {
      $this->conn->beginTransaction();
      $query_Sql = "UPDATE pedido SET status=:value WHERE ID='$idp'";
      $sql = $this->conn->prepare($query_Sql);
      $sql->bindValue(':value', "Processado");
      $sql->execute();
      if ($sql) {
        $this->conn->commit();
      }
    } catch (PDOException $erro) {
      $this->conn->rollBack();
      echo "<script language=\"javascript\">alert(\"Erro ao alterar status do pedido\")</script>";
    }
  }

}
?>
