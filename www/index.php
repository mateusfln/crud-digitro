<?php
use App\Controller\FuncionariosController;
require_once('vendor/autoload.php');
require_once('src/config/env.php');
$controller = new FuncionariosController();

$table = $controller->index();
$delete = $controller->delete();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD de Funcionarios</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<body>
  <h class="container">
    <h1>CRUD de Funcionarios</h1>

    <div class="row mt-3">
      <a href="create.php" class="btn btn-primary">Novo Funcionario</a>
    </div>

    <div class="container">
    <table class="table table-hover progress-table text-center">
        <thead class="text-uppercase">
        <tr>
            <th scope="col"> ID </th>
            <th scope="col"> Nome </th>
            <th scope="col"> Cpf </th>
            <th scope="col"> E-mail </th>
            <th scope="col"> Data de Nascimento </th>
            <th scope="col"> Estado Civil </th>
            <th scope="col"> Actions </th>
        </tr>
        </thead>
        <tbody>
    <?php foreach($table as $funcionario):?>
        <tr>
            <td><?=$funcionario->getId()?></td>
            <td><?=$funcionario->getNome()?></td>
            <td><?=$funcionario->getCpf()?></td>
            <td><?=$funcionario->getEmail()?></td>
            <td><?=$funcionario->getDataDeNascimento()->format('d-m-Y')?></td>
            <td><?=$funcionario->getEstadoCivil()?></td>
            <td>
                <ul class="d-flex justify-content-center gap-3">
                    <a href="update.php?id=<?=$funcionario->getId()?>" class="btn btn-warning text-light"><i class="bi bi-pencil-square mr-1"></i>Edit</a>
                    <form method="POST">
                        <input type="hidden" name="id" value="<?=$funcionario->getId()?>">
                        <button type="submit" class="btn btn-danger"><i class="bi bi-trash mr-3"></i>Delete</button>
                    </form>
                </ul>
            </td>
        </tr>
    <?php endforeach;?>
        </tbody>
    </table>
    </div>
    </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
