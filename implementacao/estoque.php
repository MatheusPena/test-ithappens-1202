<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.18/datatables.min.css"/>
  <link rel="stylesheet" href="css/style.css">
  <title>Cadastrar Filial</title>
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

    <div class="container col-sm-8">
      <p class="h4 comfortaa azul-mateus">Estoque filial <?=@$_GET['nome_f']?> <a href="JavaScript: window.history.back();" ><i class="fas fa-undo ml-2" style="font-size: 1.0em; color:green;"></i></a></p>
      <table id="example" class="table table-bordered varela-round text-center mt-5 " >
        <thead class="text-dark ">
          <tr>
            <th>Filial</th>
            <th>Produto</th>
            <th>Quantidade</th>
            <th>Valor Unitário</th>
            <th>Cod. Barras</th>
          </tr>
        </thead>
        <tbody>
          <?php
          require_once('DAO/usuario.php');
          $estoque_filial = new UsuarioDAO();
          $l = $estoque_filial->estoqueFilial($_GET['id_filial']);
          foreach ($l as $v) {
          ?>
          <tr>
            <td><?=$v->Nome?></td>
            <td><?=$v->produto?></td>
            <td><?=$v->qtde?></td>
            <td><?=$v->valor_prod?></td>
            <td><?=$v->cod_barra?></td>

          </tr>
        <?php } ?>
        </tbody>
      </table>
    </div>
    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.18/datatables.min.js"></script>
    <script>
    $(document).ready(function() {
      $('#example').DataTable( {
        "language": {
          "sEmptyTable": "Nenhum registro encontrado",
          "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
          "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
          "sInfoFiltered": "(Filtrados de _MAX_ registros)",
          "sInfoPostFix": "",
          "sInfoThousands": ".",
          "sLengthMenu": "_MENU_ <r class='varela-round azul-mateus'>resultados por página</r>",
          "sLoadingRecords": "Carregando...",
          "sProcessing": "Processando...",
          "sZeroRecords": "Nenhum registro encontrado",
          "sSearch": "<r class='varela-round azul-mateus'>Buscar Produto</r>",
          "oPaginate": {
            "sNext": "Próximo",
            "sPrevious": "Anterior",
            "sFirst": "Primeiro",
            "sLast": "Último"
          },
          "oAria": {
            "sSortAscending": ": Ordenar colunas de forma ascendente",
            "sSortDescending": ": Ordenar colunas de forma descendente"
          }
        }
      } );
    } );
    </script>
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
