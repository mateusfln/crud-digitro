<?php 
use App\Controller\FuncionariosController;
require_once('vendor/autoload.php');
require_once('src/config/env.php');

$controller = new FuncionariosController();
$feedbackMessage = '';
if (isset($_POST['ds_nome']) && isset($_POST['dt_nascimento']) && isset($_POST['ds_cpf']) && isset($_POST['ds_email']) && isset($_POST['ds_estadocivil'])) {
  $feedbackMessage = $controller->update($_GET['id']);
}

$funcionario = $controller->read($_GET['id']);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Funcionario</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>

<body>
  <div class="container">
  <a href="index.php" class="btn btn-info mt-5"><h><i class="bi bi-arrow-left"></i></h5></a>
    <h1 class="text-center h1 font-weight-bold m-5">Editar dados de: <?= $funcionario->getNome()?></h1>
    <?= $feedbackMessage?>
<div class="card p-4 shadow-sm ">
<form id="form-edit-funcionario" method="post">

      <div class="row">
        <div class="col-4 mb-3">
          <label for="Nome" class="form-label">Nome:</label>
          <input type="text" class="form-control" id="Nome" name="ds_nome" placeholder="Digite o nome do funcionario" value="<?= $funcionario->getNome()?>">
        </div>
        <div class="col-4 mb-3">
          <label for="CPF" class="form-label">CPF:</label>
          <input type="text" class="form-control" id="CPF" name="ds_cpf" placeholder="Digite o cpf do funcionario" value="<?= $funcionario->getCpf()?>">
        </div>
        <div class=" col-4 mb-3">
        <label for="nascimento" class="form-label">Data de Nascimento:</label>
        <input type="date" class="form-control" id="nascimento" name="dt_nascimento"
          placeholder="Digite a data de nascimento do funcionario" value="<?= $funcionario->getDataDeNascimento()->format('Y-m-d')?>">
      </div>
      </div>
      <div class="row">
        <div class="col-6 mb-3">
          <label for="Email" class="form-label">Email:</label>
          <input type="email" class="form-control" id="Email" name="ds_email" placeholder="Digite o Email do funcionario" value="<?= $funcionario->getEmail()?>">
        </div>
        <div class="col-6 mb-3">
          <label for="estado-civil" class="form-label">Estado civil:</label>
          <input type="text" class="form-control" id="estado-civil" name="ds_estadocivil" placeholder="Digite o estado civil do funcionario" value="<?= $funcionario->getEstadoCivil()?>">
        </div>
      </div>

      <input type="submit" class="btn btn-primary" value="Editar">
    </form>
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