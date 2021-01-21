
<?php

importar('apps/artesanias/models/pedidos');
importar('apps/artesanias/views/pedidos');



class PedidosController extends Controller  {

    

    

    public function guardar(){
        
       $id               = $_POST['id']?? 0;
       $fecha         = $_POST['fecha']??"";
       $cliente_id      = $_POST['cliente_id']??0;
       
       $formapago           = $_POST['formapago']??"";
       $domicilioentrega      = $_POST['domicilioentrega']??"";
       

       //--- validar datos

      

       //--- asociar al modelo
        $this->model->id = $id;
        $this->model->fecha        = $fecha;
        $this->model->cliente_id      = $cliente_id;
        
        $this->model->formapago           = $formapago;
        $this->model->domicilioentrega      = $domicilioentrega;
        
        $id=$this->model->save();
        
        
        
        //--$this->model->imagenes        = $imagenes;

        //-- recuperar imagenes   y meterlos al campo de la BD
        

    }

    public function eliminar($id){
        $this->model->delete($id);
        HTTPHelper::go("/artesanias/pedidos/listar");
    }
    
}

?>
