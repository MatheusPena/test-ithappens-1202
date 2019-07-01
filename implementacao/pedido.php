<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Cadastrar Pedido</title>
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
      <form class="needs-validation" action="response/cadastraPedido.php" method="post">
        <div class="form-row">
          <div class="col-md-6 mb-3">
            <label for="exampleInputEmail1" class="varela-round">Qual tipo do pedido?
            </label>
            <select class="custom-select" id="inputGroupSelect01" name="tipo_pedido">
              <option selected>Escolher...</option>
              <option value="Entrada">Entrada</option>
              <option value="Saida">Saida</option>
            </select>
          </div>
          <div class="col-md-6 mb-3">
            <label for="exampleInputEmail1" class="varela-round">Filial</label>
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
            <label for="validationTooltipUsername" class="varela-round azul-mateus">Usuário</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="validationTooltipUsernamePrepend">@</span>
              </div>
              <input type="text" name="usuario" class="form-control" id="validationTooltipUsername" placeholder="Usuário" aria-describedby="validationTooltipUsernamePrepend" required>
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="validationTooltip03" class="varela-round azul-mateus">Cliente</label>
            <input type="text" name="cliente" class="form-control" id="validationTooltip03" placeholder="Cliente" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-sm-12">
            <label for="exampleFormControlTextarea1" class="varela-round azul-mateus">Observação</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="obs"></textarea>
          </div>
        </div>
        <button class="btn bg-success text-light form-control" type="submit">INICIAR PEDIDO</button>
      </form>
    </div>
    <!-- JavaScript utilizados (jquery, propperjs e bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
