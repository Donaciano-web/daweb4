
<?php

importar('apps/artesanias/models/productos');
importar('apps/artesanias/views/productos');
importar('apps/artesanias/views/mensajes');
importar('core/helpers/utilerias');


class ProductosController extends Controller  {

    public function agregar(){
        $sql = "SELECT * FROM clasificacion";
        $clasificaciones = $this->model->query($sql);
        $sql = "SELECT id, CONCAT(primerapellido,' ', segundoapellido, ' ',
            nombres) as nombres FROM artesanos";
        $artesanos = $this->model->query($sql);
        $this->view->agregar($artesanos, $clasificaciones);
    }

    public function editar($id=0){
        
    }


    public function listar($formato=""){
        $sql = "SELECT * FROM productos";
        $listaProductos = $this->model->query($sql);
        
        if (strtolower($formato)=="json"){
            echo json_encode($listaProductos);
        }else if ($formato=="xml"){
            $xml = Utilerias::toXML($listaProductos,"productos","producto");
            echo $xml;
        }else {
            $this->view->listar($listaProductos);
        }
    }

    

    public function guardar(){
        
       $id               = $_POST['id']?? 0;
       $producto         = $_POST['producto']??"";
       $descripcion      = $_POST['descripcion']??"";
       $clasificacion_id = $_POST['clasificacion_id']??0;
       $artesano_id      = $_POST['artesano_id']??0;
       $precio           = $_POST['precio']??0.0;
       $existencias      = $_POST['existencias']??0;
       //---$imagenes         = $_POST['imagenes']??"";

       //--- validar datos

       if (empty($descripcion) || empty($producto)){
           Mensajes::show ("Faltan datos importantes "); 
           exit;
       }

       //--- validar imágenes
       $permitidos    = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "png" => "image/png");
       $imagenes      = $_FILES['images'];
       $totalElements = count($imagenes['name']);

       for ($i=0; $i< $totalElements; $i++){
            $filesize = $imagenes["size"][$i];
            $filename = $imagenes["name"][$i];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
       
            if(!array_key_exists($ext, $permitidos)) {
                Mensajes::show ("Formato  de imágen ($ext) no válido");
                exit;
            }
            $maxsize = 3 * 1024 * 1024;
            if($filesize > $maxsize) {
                Mensajes::show ("El tamaño del archivo es demasiado grande");
                exit;
            }
     
        }

       //--- asociar al modelo
        $this->model->id = $id;
        $this->model->producto         = $producto;
        $this->model->descripcion      = $descripcion;
        $this->model->clasificacion_id = $clasificacion_id;
        $this->model->artesano_id      = $artesano_id;
        $this->model->precio           = $precio;
        $this->model->existencias      = $existencias;
        $id=$this->model->save();
        //--$this->model->imagenes        = $imagenes;

        //-- recuperar imagenes   y meterlos al campo de la BD
        $imageNames="";
        for ($i=0; $i< $totalElements; $i++){
            $ext = pathinfo($imagenes["name"][$i],PATHINFO_EXTENSION);
            $filename = $id."_$i.$ext";
            move_uploaded_file($imagenes["tmp_name"][$i], APP_DIR."uploads/" . $filename);
            $imageNames = $imageNames. $filename.",";
        }
        $imageNames = substr($imageNames,0, strlen($imageNames)-1);
        $this->model->imagenes      = $imageNames;
        $this->model->id=$id;
        $this->model->save();
        

       //--- guardar las imagenes en la tabla productoImagen 

       Mensajes::show ( "Guardado satisfactoriamente ..."); 

    }

    public function eliminar($id){
        $this->model->delete($id);
        HTTPHelper::go("/artesanias/productos/listar");
    }
    
}

?>
