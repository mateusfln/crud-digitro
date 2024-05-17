<?php

namespace App\Controller;

use App\Model\EstadocivilModel;
use App\Model\FuncionariosModel;

class FuncionariosController
{
    private FuncionariosModel $model;
    private EstadocivilModel $estadocivilModel;

    public function __construct()
    {
        $this->model = new FuncionariosModel();
        $this->estadocivilModel = new EstadocivilModel();
    }

    public function create()
    {
        $msgFeedback = [];
        if (isset($_POST['ds_nome']) && isset($_POST['dt_nascimento']) && isset($_POST['ds_cpf']) && isset($_POST['ds_email']) && isset($_POST['estadocivil_id'])) {
            $arrFeedback = $this->model->insert();
            if ($arrFeedback[0]) {
                header('Location: index.php');
            } else {
                $msgFeedback = $arrFeedback[1];
            }
        }
        $arrEstadocivil = $this->estadocivilModel->findAll();
        require "src/View/Funcionarios/create.php";
    }

    public function index()
    {   
        $funcionarios = $this->model->findAll();
        require "src/View/Funcionarios/index.php";
    }

    public function update()
    {
        $msgFeedback = [];
        if (isset($_POST['ds_nome']) && isset($_POST['dt_nascimento']) && isset($_POST['ds_cpf']) && isset($_POST['ds_email']) && isset($_POST['estadocivil_id'])) {
            $arrFeedback = $this->model->edit($_GET['id']);
            if ($arrFeedback[0]) {
                $msgFeedbackOk = 'success';
            } else {
                $msgFeedbackError = $arrFeedback[1];
            }
        }
        $arrEstadocivil = $this->estadocivilModel->findAll();
        $funcionario = $this->model->read($_GET['id']);
        require "src/View/Funcionarios/update.php";
    }
    
    public function delete()
    {   
        $returnDeleteFuncionario = $this->model->delete($_POST['id']);
        if(!$returnDeleteFuncionario[0]){
            $feedbackDeleteError = $returnDeleteFuncionario[1];
        }
        $funcionarios = $this->model->findAll();
        require "src/View/Funcionarios/index.php";
    }
}