<?php

namespace App\Controller;

use App\Model\FuncionariosModel;

class FuncionariosController
{
    private FuncionariosModel $model;

    public function __construct()
    {
        $this->model = new FuncionariosModel();
    }

    public function create()
    {
        header('Location: '.'index.php');
        return $this->model->insert();
    }

    public function index()
    {   
        return $this->model->findAll();
    }

    public function update($id)
    {
        if ($_POST){
            $this->model->edit($id);
        }
        return $this->model->read($id);
    }
    
    public function delete()
    {     
        if ($_POST){    
            $this->model->delete($_POST['id']);
            header('Location: '.'index.php');
        }
        return $this->index();
    }
}