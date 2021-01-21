<?php

class PedidosView  {

    
    public function listar($list = []){
        $str = file_get_contents(
            STATIC_DIR . "html/artesanias/pedidos_listar.html"); 
        $html = Template($str)->render_regex('LISTADO_PEDIDOS', $list);
        print Template('Pedidos')->show($html);
    } 
}

?>
