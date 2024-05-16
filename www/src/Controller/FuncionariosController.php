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
        return $this->model->insert();
    }

    public function index()
    {   
        return $this->model->findAll();
    }

    public function read($id)
    {
        return $this->model->findById($id);
    }

    public function update($id)
    {
        if ($_POST){
            return $this->model->edit($id);
        }else{
            return $this->model->read($id);
        }
    }
    
    public function delete($id)
    {     
        if ($_POST){    
            return $this->model->delete($id);
        }else{
            return $this->index();
        }
    }
}