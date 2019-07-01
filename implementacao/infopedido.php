<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.18/datatables.min.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Pedidos</title>
  </head>
  <body>
    <div class="container">
      <div class="row align-items-center justify-content-center">
        <a href="index.php"></a>
      </div>
      <div class="row align-items-center justify-content-center" style="margin-top:5%">
        <h2 class="mt-2 ml-3"><strong>Selecione uma Opção</strong> </h2>
      </div>

      <div class="d-flex align-items-center justify-content-center">
        <a href="filial.php"><img src="imagens/casa.png" class="rounded img-fluid mt-3" alt="Responsive image" style="width: 8em; margin-right:20px"></a>
        <a href="produto.php"><img src="imagens/adicionar.png" class="rounded img-fluid mt-3" alt="Responsive image" style="width: 8em; margin-right:20px"></a>
        <a href="pedido.php"><img src="imagens/cadastrar.png" class="rounded img-fluid mt-3" alt="Responsive image" style="width: 8em; margin-right:20px"></a>
        <a href="buscarPedido.php"><img src="imagens/pesquisar.png" class="rounded img-fluid mt-3" alt="Responsive image" style="width: 8em; margin-right:18px"></a>
      </div>
    </div>
    <hr>
    <div class="container">
      <!-- Primeiro for para pegar apenas o "header" do pedido -->
      <?php
        require_once('DAO/usuario.php');
        $header = new UsuarioDAO();
        $l = $header->headerPedido($_GET['idp']);
        foreach ($l as $v) {
          @$valorT += $v->valor_un;
          @$totalI += $v->qtde_pedido;
        }
        ?>
        <div class="shadow p-3 mb-2 bg-shadow-it text-dark rounded comfortaa">
          <p>
            <strong>Pedido Nº</strong> - <?=$_GET['idp']?><br>
            <strong>Tipo:</strong> <?=$v->tipo_pedido ?><br>
            <strong>Filial:</strong> <?=$v->Nome ?><br>
            <strong>Quantidade de itens pedidos:</strong> <?=$totalI?><br>
            <strong>Valor total: </strong> R$<?=$valorT?><br>
            <strong>Forma de pagamento:</strong> <?=$v->forma_pagamento?> <br>
            <strong>Status:</strong> <?=$v->status?>
          </p>
        </div>


        <p class="h4 comfortaa mt-3">Destalhes <i class="fas fa-info-circle"></i></p>
      <?php
      require_once('DAO/usuario.php');
      $detalhes_pedido = new UsuarioDAO();
      $l = $detalhes_pedido->itenDetalhesPedido($_GET['idp']);
      foreach ($l as $v) {
      ?>
      <div class="shadow p-3 mb-2 bg-white rounded varela-round">
        <p>
          <h6><strong>Produto:</strong> <?=$v->produto ?></h6>
          <h6><strong>Quantidade pedida:</strong> <?=$v->qtde_pedido?></h6>
          <h6><strong>Valor Unitário:</strong> R$<?=$v->valor_un?></h6>
          <h6><strong>Valor Total:</strong> R$<?=$v->valor_total?></h6>
        </p>

      </div>
      <?php } ?>
    </div>
    <!-- JavaScript utilizados (jquery, propperjs e bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
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
