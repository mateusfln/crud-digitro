<?php

namespace App\Model\Entity;
use DateTime;
class Funcionario
{

    private int $id;
    private string $ds_nome;

    private \DateTime $dt_nascimento;
    
    private string $ds_cpf;
    
    private string $ds_email;
    
    private string $ds_estadocivil;


    public function __construct(int $id = 1, string $ds_nome = "", \DateTime $dt_nascimento = new \DateTime(""), string $ds_cpf = "", string $ds_email = "", string $ds_estadocivil = "")
    {
        $this->id = $id;
        $this->ds_nome = $ds_nome;
        $this->dt_nascimento = $dt_nascimento;
        $this->ds_cpf = $ds_cpf;
        $this->ds_email = $ds_email;
        $this->ds_estado_civil = $ds_estadocivil;
    }

    
    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function setNome($nome): void
    {
        $this->ds_nome = $nome;
    }
    public function getNome(): string
    {
        return $this->ds_nome;
    }

    public function setDataDeNascimento($dataDeNascimento): void
    {
        $this->dt_nascimento = $dataDeNascimento;
    }

    public function getDataDeNascimento(): \DateTime
    {
        return $this->dt_nascimento;
    }

    public function setCpf($cpf): void
    {
        $this->ds_cpf = $cpf;
    }

    public function getCpf(): string
    {
        return $this->ds_cpf;
    }

    public function setEmail($email): void
    {
        $this->ds_email = $email;
    }

    public function getEmail(): string
    {
        return $this->ds_email;
    }

    public function setEstadoCivil($estadoCivil): void
    {
        $this->ds_estadocivil = $estadoCivil;
    }

    public function getEstadoCivil(): string
    {
        return $this->ds_estadocivil;
    }

    public function hydrate(array $dados): Funcionario 
    {
        $funcionarios = new Funcionario();
        $funcionarios->setNome($dados['ds_nome'] ?? '');
        $funcionarios->setDataDeNascimento(new DateTime($dados['dt_nascimento']) ?? '');
        $funcionarios->setCpf($dados['ds_cpf'] ?? '');
        $funcionarios->setEmail($dados['ds_email'] ?? '');
        $funcionarios->setEstadoCivil($dados['ds_estadocivil'] ?? '');

        return $funcionarios;
    }
}