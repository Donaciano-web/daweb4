<?php

importar('apps/artesanias/models/clientes');
importar('apps/artesanias/views/clientes');

class ClientesController extends Controller  {

    public function agregar(){
    	 $sql = "SELECT * FROM clientes";
        $data = $this->model->query($sql);

        $this->view->agregar($data);
    }

    public function listar(){
        $sql = "SELECT * FROM clientes";
        $data = $this->model->query($sql);
        $this->view->listar($data);
    }

    public function guardar(){
       $id                        = $_POST['id']?? 0;
       $nombreorazonsocial        = $_POST['nombreorazonsocial'];
       $domicilio      = $_POST['domicilio'];
       $telefono       = $_POST['telefono'];
       $correo         = $_POST['correo'];
       $contacto         = $_POST['contacto'];
       //--- validar datos

       //--- asociar al modelo
       $this->model->id             = $id;
       $this->model->nombreorazonsocial        = $nombreorazonsocial;
       $this->model->domicilio      = $domicilio;
       $this->model->telefono       = $telefono;
       $this->model->correo         = $correo;
       $this->model->contacto       = $contacto;
       $this->model->save();
       //--- 
       HTTPHelper::go("/artesanias/clientes/listar");
    }

    public function eliminar($id){
        $this->model->delete($id);
        HTTPHelper::go("/artesanias/clientes/listar");
    }

    public function editar($id=0){

    	$sql = "SELECT * FROM clientes WHERE id=$id";
        
        $clientesListado = $this->model->query($sql);
        
        $clientes = $this->model->getById($id);

        $this->view->editar($clientesListado, $clientes);
    }


     }



?>