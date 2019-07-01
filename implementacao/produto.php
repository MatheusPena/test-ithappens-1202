<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Cadastrar Produto</title>
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
    <div class="container mt-5">
        <p class="h4 comfortaa text-center">Cadastrar Produto</p>
        <?php if (!empty($_GET['cadprod'])) { ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong class="comfortaa">Produto cadastro com sucesso!! <i class="fas fa-thumbs-up"></i></strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <?php } ?>

      <form class="needs-validation" action="response/cadastraProduto.php" method="post">
        <div class="form-row">
          <div class="col-md-6 mb-3">
            <label for="validationTooltip03" class="varela-round azul-mateus">Produto</label>
            <input type="text" name="produto" class="form-control" id="validationTooltip03" placeholder="" required>
          </div>
          <div class="col-md-6 mb-3">
            <label for="exampleInputEmail1" class="varela-round azul-mateus">Filial</label>
            <select class="custom-select" id="inputGroupSelect01" name="filial">
              <option selected>Escolher...</option>
              <?php
                require_once('DAO/usuario.php');
                $listar_filial = new UsuarioDAO();
                $l =  $listar_filial->listarFilial();
                foreach ($l as $v) {
              ?>
              <option value="<?=$v->ID?>"><?=$v->Nome?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-6 mb-3">
            <label for="validationTooltip03" class="varela-round azul-mateus">Quantidade</label>
            <input type="number" name="qtde" class="form-control" id="validationTooltip03" placeholder="" required>
          </div>
          <div class="col-md-6 mb-3">
            <label for="validationTooltip03" class="varela-round azul-mateus">Valor Unitário</label>
            <input type="number" name="v_un" class="form-control" id="validationTooltip03" placeholder="" required>
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-12 mb-3">
            <label for="validationTooltip03" class="varela-round azul-mateus">Cod. Barras</label>
            <input type="number" name="cod_barras" class="form-control" id="validationTooltip03" placeholder="" required>
          </div>
        </div>

        <button class="btn bg-success form-control text-light" type="submit">INICIAR PEDIDO</button>
      </form>
    </div>
    <!-- JavaScript utilizados (jquery, propperjs e bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
