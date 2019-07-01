<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.18/datatables.min.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Carrinho</title>
  </head>
  <body>
    <div class="container">
      <div class="row align-items-center justify-content-center">
        <a href="index.php"></a>
      </div>
      <div class="row align-items-center justify-content-center" style="margin-top:8%"></div>

      <div class="d-flex align-items-center justify-content-center float-right">
        <a href="JavaScript: window.history.back();" class="ml-5 varela-round text-success">Voltar <i class="fas fa-undo"></i></a>
        <a href="response/cancelaPedido.php?idp=<?=$_GET['idp']?>" class="ml-5 text-danger varela-round">Cancelar Pedido <i class="fas fa-ban"></i></a>
      </div>
    </div>
    <hr class="mt-4">

    <div class="container mt-5" >
      <div class="shadow p-3 mb-5 bg-shadow-it text-dark rounded comfortaa">
        <h4>Resumo do pedido Nº<?=$_GET['idp']?></h4>
        <hr class="bg-white">
        <p class="roboto-slab">
        Pedido do tipo: <?=$_GET['tipo_ped']?><br>
        <?php
          require_once('DAO/usuario.php');
          $resumo_pedido = new UsuarioDAO();
          $resumo = $resumo_pedido->verCarrinho($_GET['idp']);
          foreach ($resumo as $r) {
            @$valor_t += $r->valor_total;
            @$qtde_itens += $r->qtde_pedido;
          }
        ?>
        Valor total do pedido: R$ <?=@$valor_t?><br>
        Total de itens pedidos: <?=@$qtde_itens?> item(ns)</p>
        <form class="" action="response/finalizaCompra.php" method="post">
          <div class="row mx-auto">
            <input type="hidden" name="idp" value="<?=$_GET['idp']?>">
            <input type="hidden" name="tipo_ped" value="<?=$_GET['tipo_ped']?>">
            <select class="form-control col-sm-4" name="f_pag" required>
              <option>Selecione a forma de pagamento</option>
              <option value="Cartão de crédito">Cartão de crédito</option>
              <option value="Boleto Bancário">Boleto Bancário</option>
              <option value="A vista">A vista</option>
            </select>
            <button type="submit" class="btn btn-success ml-3">Finalizar pedido <i class="fas fa-check"></i></button>
          </div>
        </form>
      </div>
      <hr>
      <p class="h5 mt-3 comfortaa">Detalhes do carrinho <i class="fas fa-info-circle"></i></p>
      <?php
        require_once('DAO/usuario.php');
        $itens_carrinho = new UsuarioDAO();
        $l = $itens_carrinho->verCarrinho($_GET['idp']);
        foreach ($l as $v) {
      ?>
          <div class="shadow p-3 mb-2 text-dark rounded varela-round">
            <a href="response/cancelaProduto.php?id_prod=<?=$v->ID?>"><i style="font-size:25px" class="mt-5 text-danger fas fa-trash float-right"></i></a>
            <h6><strong>Produto: </strong><?=$v->produto?></h6>
            <h6><strong>Valor por unidade: </strong>R$ <?=$v->valor_un?></h6>
            <h6><strong>Quantidade pedida:</strong> <?=$v->qtde_pedido?></h6>
            <h6><strong>Valor total: </strong>R$ <?=$v->valor_total?></h6>
          </div>
        <?php } ?>
    </div>

    <!-- JavaScript utilizados (jquery, propperjs e bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- Função "yoyo" com refresh -->
    <script type='text/javascript'>
    	(function()
    	{
    		if( window.localStorage )
    		{
    			if( !localStorage.getItem( 'firstLoad' ) )
    			{
    				localStorage[ 'firstLoad' ] = true;
    				window.location.reload();
    			}
    			else
    				localStorage.removeItem( 'firstLoad' );
    		}
    	})();
    </script>
  </body>
</html>
