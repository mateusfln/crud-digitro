<?php 
use App\Controller\FuncionariosController;
require_once('vendor/autoload.php');
require_once('src/config/env.php');


$controller = new FuncionariosController();
if (isset($_POST['ds_nome']) && isset($_POST['dt_nascimento']) && isset($_POST['ds_cpf']) && isset($_POST['ds_email']) && isset($_POST['ds_estadocivil'])) {
  $table = $controller->create();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Adicionar Funcionario</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <h1>Adicionar Funcionario</h1>
<div class="card p-4">
<form id="form-create-funcionario" action="create.php" method="post">

      <div class="row">
        <div class="col-4 mb-3">
          <label for="Nome" class="form-label">Nome:</label>
          <input required type="text" class="form-control" name="ds_nome" id="Nome" placeholder="Digite o nome do funcionario">
        </div>
        <div class="col-4 mb-3">
          <label for="CPF" class="form-label">CPF:</label>
          <input required type="text" class="form-control" name="ds_cpf" id="CPF" placeholder="Digite o cpf do funcionario">
        </div>
        <div class=" col-4 mb-3">
        <label for="nascimento" class="form-label">Data de Nascimento:</label>
        <input required type="date" class="form-control" id="nascimento" name="dt_nascimento"
          placeholder="Digite a data de nascimento do funcionario">
      </div>
      </div>
      <div class="row">
        <div class="col-6 mb-3">
          <label for="Email" class="form-label">Email:</label>
          <input required type="email" class="form-control" id="Email" name="ds_email" placeholder="Digite o Email do funcionario">
        </div>
        <div class="col-6 mb-3">
          <label for="estado-civil" class="form-label">Estado civil:</label>
          <input required type="text" class="form-control" id="estado-civil" name="ds_estadocivil" placeholder="Digite o estado civil do funcionario">
        </div>
      </div>

      <button type="submit" class="btn btn-primary">Adicionar</button>
    </form>
</div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

  <script src="script.js"></script>
</body>

</html>