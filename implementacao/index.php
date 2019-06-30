<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <title>It Happens</title>
</head>

<body>
  <div class="container">
    <div class="row align-items-center justify-content-center">
      <a href="index.php"></a>
    </div>
    <div class="row align-items-center justify-content-center" style="margin-top:20%">
      <h2 class="mt-2 ml-3"><strong>Selecione uma Opção</strong> </h2>
    </div>

    <div class="d-flex align-items-center justify-content-center">
      <a href="cadFilial.php"><img src="imagens/casa.png" class="rounded mt-3" alt="..." style="width: 8em; margin-right:20px"></a>
      <a href="cadProduto.php"><img src="imagens/adicionar.png" class="rounded mt-3" alt="..." style="width: 8em; margin-right:20px"></a>
      <a href="cadPedido.php"><img src="imagens/cadastrar.png" class="rounded mt-3" alt="..." style="width: 8em; margin-right:20px"></a>
      <a href="buscarPedido.php"><img src="imagens/pesquisar.png" class="rounded mt-3" alt="..." style="width: 8em; margin-right:18px"></a>
    </div>
  </div>
  <div class="container comfortaa">
    <?php if (!empty($_GET['cancelado'])) { ?>
      <div class="alert alert-success alert-dismissible fade show " role="alert">
        <strong>Pedido cancelado! <i class="fas fa-thumbs-up"></i></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php }elseif (!empty($_GET['done'])) {?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Pedido realizado! <i class="fas fa-thumbs-up"></i></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php } ?>
  </div>
  <!-- JavaScript (Opcional) -->
  <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
