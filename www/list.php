<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detalhes do Funcionário</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>

<body>
  <div class="container">
  <a href="<?= $_SERVER['HTTP_REFERER'];?>" class="btn btn-info mt-5"><h><i class="bi bi-arrow-left"></i></h5></a>

    <h1>Detalhes do Funcionário</h1>

    <div class="card p-4">
      <div class="row">
        <div class="card col-md-6 mb-3">
            <div class="">
              <label for="nome">Nome:</label>
              <span id="nome" class="form-control-plaintext"></span>
            </div>
        </div>
        <div class="col-md-6 mb-3">
          <label for="cpf">CPF:</label>
          <span id="cpf" class="form-control-plaintext"></span>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="nascimento">Data de Nascimento:</label>
          <span id="nascimento" class="form-control-plaintext"></span>
        </div>
        <div class="col-md-6 mb-3">
          <label for="email">Email:</label>
          <span id="email" class="form-control-plaintext"></span>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="estadoCivil">Estado Civil:</label>
          <span id="estadoCivil" class="form-control-plaintext"></span>
        </div>
      </div>
    </div>
    </div>
</div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

  <script src="script.js"></script>
</body>

</html>
