<?php

class ClientesView  {

    public function agregar($list=[]){
        $str = file_get_contents(
            STATIC_DIR . "html/artesanias/clientes_agregar.html"); 
        $html = Template($str)->render_regex('LISTADO_CLIENTES', $list);
        print Template('Agregar Cliente')->show($html);
    } 

    public function listar($list=array()) {
        $str = file_get_contents(
            STATIC_DIR . "html/artesanias/clientes_listar.html"); 
        $html = Template($str)->render_regex('LISTADO_CLIENTES', $list);
        print Template('Listado de clientes')->show($html);
    }
    public function editar ($list=[], $clientes){
        $str = file_get_contents(
            STATIC_DIR . "html/artesanias/clientes_editar.html"); 
        $html = Template($str)->render_regex('LISTADO_CLIENTES', $list);
        $html = Template($html)->render($clientes);
        print Template('editar cliente')->show($html);
    } 
}

?>