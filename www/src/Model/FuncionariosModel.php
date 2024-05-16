<?php
namespace App\Model;

use App\Model\Database;
use App\Model\Entity\Funcionario;
use Exception;
use PDO;

class FuncionariosModel
{

    private string $table;
    private Database $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance();
        $this->table = 'funcionarios';
    }

    public function findAll(): array|null
    {
        try {
            $query = $this->conn->getConnection()->query("SELECT id, ds_nome, dt_nascimento, ds_cpf, ds_email, ds_estadocivil FROM {$this->table} LIMIT 200;");
            $funcionarios = [];
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $funcionario = new Funcionario();
                $funcionario->setId($row["id"]);
                $funcionario->setNome($row['ds_nome']);
                $funcionario->setCpf($row['ds_cpf']);
                $funcionario->setEmail($row['ds_email']);
                $funcionario->setDataDeNascimento(new \DateTime($row['dt_nascimento']));
                $funcionario->setEstadoCivil($row['ds_estadocivil']);
                $funcionarios[] = $funcionario;
            }

            return $funcionarios;

        } catch (Exception $e) {
            echo 'Não foi possível executar a ação ' . $e->getMessage();
            return null;
        }
    }

    public function insert(): string
    {
        if (!$this->validaCPF($_POST['ds_cpf'])) {
            return '<div class="alert alert-danger" role="alert">
            Não foi possivel cadastrar o funcionario, Cpf inválido!
          </div>';
        }
        if (!$this->validaEmail($_POST['ds_email'])) {
            return '<div class="alert alert-danger" role="alert">
            Não foi possivel cadastrar o funcionario, email inválido!
          </div>';
        }
        try {
            $this->conn
                ->getConnection()
                ->exec(
                    "INSERT INTO {$this->table} 
                    (ds_nome, 
                    dt_nascimento, 
                    ds_cpf, 
                    ds_email, 
                    ds_estadocivil) 
                    VALUES 
                    ('{$_POST['ds_nome']}', 
                    '{$_POST['dt_nascimento']}', 
                    '{$_POST['ds_cpf']}', 
                    '{$_POST['ds_email']}', 
                    '{$_POST['ds_estadocivil']}'
                    )"
                );
                return '<div class="alert alert-success" role="alert">
                Funcionario cadastrado com sucesso!
              </div>'; 
        } catch (Exception $e) {
            return  "<div class='alert alert-danger' role='alert'>
            não foi possvel cadastrar o funcionario! {$e->getMessage()}
          </div>";
        }
    }

    public function read($id)
    {
        $sql =
            "SELECT
            id, 
            ds_nome, 
            dt_nascimento, 
            ds_cpf, 
            ds_email, 
            ds_estadocivil
            FROM {$this->table}
            WHERE id = {$id};";
        $query = $this->conn->getConnection()->query($sql);

        return (new Funcionario())->hydrate($query->fetch(PDO::FETCH_ASSOC));
    }

    public function edit(int $id): string
    {
        if (!$this->validaCPF($_POST['ds_cpf'])) {
            return '<div class="alert alert-danger" role="alert">
            Não foi possivel atualizar o funcionario, Cpf inválido!
          </div>';
        }

        if (!$this->validaEmail($_POST['ds_email'])) {
            return '<div class="alert alert-danger" role="alert">
            Não foi possivel atualizar o funcionario, email inválido!
          </div>';
        }
        try {
            $this->conn
                ->getConnection()
                ->query(
                    "UPDATE {$this->table} SET
                ds_nome = '{$_POST['ds_nome']}', 
                dt_nascimento = '{$_POST['dt_nascimento']}', 
                ds_cpf = '{$_POST['ds_cpf']}', 
                ds_email = '{$_POST['ds_email']}', 
                ds_estadocivil = '{$_POST['ds_estadocivil']}'
                WHERE id = {$id}
                "
                )->fetch(PDO::FETCH_ASSOC);
            return '<div class="alert alert-success" role="alert">
            Funcionario atualizado com sucesso!
            </div>'; 
        } catch (Exception $e) {
            return  "<div class='alert alert-danger' role='alert'>
            não foi possvel atualizar o funcionario! {$e->getMessage()}
          </div>";
        }
    }

    public function delete(int $id): string
    {
        try {
            $this->conn->getConnection()->query("DELETE FROM {$this->table} WHERE id = {$id};")->fetch(PDO::FETCH_ASSOC);
            return  "<div class='alert alert-success' role='alert'>
            funcionario excluido com sucesso! 
            </div>";
        } catch (Exception $e) {
            return  "<div class='alert alert-danger' role='alert'>
            Não foi possivel excluir o funcionario, {$e->getMessage()}! 
            </div>";
        }

    }

    public function findById(int $id)
    {
        try {
            $query = $this->conn->getConnection()
                ->query(
                    "SELECT 
                ds_nome, 
                dt_nascimento, 
                ds_cpf, 
                ds_email, 
                ds_estadocivil 
                FROM {$this->table} 
                WHERE id = {$id}
                LIMIT 200;"
                );

            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $funcionario = new Funcionario();
                $funcionario->setId($id);
                $funcionario->setNome($row['ds_nome']);
                $funcionario->setCpf($row['ds_cpf']);
                $funcionario->setEmail($row['ds_email']);
                $funcionario->setDataDeNascimento(new \DateTime($row['dt_nascimento']));
                $funcionario->setEstadoCivil($row['ds_estadocivil']);
            }
            return $funcionario;
        } catch (Exception $e) {
            echo 'Não foi possível executar a ação ' . $e->getMessage();
        }
    }

    private function validaCPF($cpf)
    {
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);

        if (strlen($cpf) != 11) {
            return false;
        }

        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    }

    private function validaEmail($email) {
        $conta = "/^[a-zA-Z0-9\._-]+@";
        $domino = "[a-zA-Z0-9\._-]+.";
        $extensao = "([a-zA-Z]{2,4})$/";
        $pattern = $conta.$domino.$extensao;
        if (preg_match($pattern, $email, $check))
          return true;
        else
          return false;
      }
}
