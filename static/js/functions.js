$(document).ready(function(){
    $(".e-nombre").hide();
    $(".e-ap_paterno").hide();
    $(".e-ap_materno").hide();
    $(".e-domicilio").hide();
    $(".e-telefono").hide();
    $(".e-correo").hide();
    
  $("#enviar").click(function(){
      
      $(".e-nombre").show().slideDown("slow");
      $(".e-ap_paterno").show().slideDown("slow");
      $(".e-ap_materno").show();
      $(".e-domicilio").show();
      $(".e-telefono").show();
      $(".e-correo").show();
    
  });
});