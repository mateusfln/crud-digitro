<?php
namespace App\Model;
use App\Model\Database;
use App\Model\Entity\Funcionario;
use Exception;
use PDO;

function dd(mixed $mixed)
{
    echo"<pre>";
    print_r($mixed);
    die;
}
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
        try{
            $query = $this->conn->getConnection()->query("SELECT id, ds_nome, dt_nascimento, ds_cpf, ds_email, ds_estadocivil FROM {$this->table} LIMIT 200;");
    
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
    
        }catch (Exception $e){
            echo 'Não foi possível executar a ação ' .$e->getMessage();
            return null;
        }
    }

    public function insert(): bool
    {
        try{
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
                )");
                return true;
        }catch (Exception $e){
            echo 'Não foi possível adicionar o registro' .$e->getMessage();
            return false;
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

    public function edit(int $id)
    {
        try{
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
                ")->fetch(PDO::FETCH_ASSOC);
                
        }catch (Exception $e){
            echo 'Não foi possível adicionar o registro' .$e->getMessage();
        }
    }

    public function delete(int $id): void
    {
        try{
            $this->conn->getConnection()->query("DELETE FROM {$this->table} WHERE id = {$id};")->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e){
            echo "Não foi possível excluir o registro" .$e->getMessage();
        }

    }

    public function findById(int $id)
    {
        try{
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
                LIMIT 200;");
  
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
        }catch (Exception $e){
            echo 'Não foi possível executar a ação ' .$e->getMessage();
        }
    }

}