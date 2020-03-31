var ruta_ajax = "https://"+document.domain+"/views/curso/";
var ruta_sitio = "https://"+document.domain+"/curso-gratis/";
$( document ).ready(function() {
$('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:2,
            nav:false
        },
        1000:{
            items:3,
            nav:true,
            loop:false
        }
    }
})

$(".btn-top").on("click", function(e){
    e.preventDefault();
    $("html, body").animate({
        scrollTop: 0
    }, 1000); 
});

$("#boton_guardar").click( function() { 
if(validaForm_liderBanda()){
$.post(ruta_ajax+"assets/ajax/enviar.php",$(".form_enviar").serialize(),function(res){

     console.log(res)

        
        if(res == 1){
            location.href = ruta_sitio+'confirmacion';
        }else{
            alert("Error al enviar  el correo");
        }
     
 });
}
});

$(".btn-acceso-modal").click(function(){
    if(validaForm_liderBanda()){
        console.log("OK")
    }else{
        function explode(){
        $('#staticBackdrop').modal('hide');
        }
        setTimeout(explode, 2000);
          
        

    }
})




    function guadar_video(){ 
    $.post(ruta_ajax+"assets/ajax/enviar.php",$(".form_enviar_video").serialize(),function(res){
    
        console.log(res)
         
     });
    };

    if ( $("#code_registrocurso").length ) {
        // hacer algo aquí si el elemento existe
    var segundos = 0;
    function segundos_funcion() {
    segundos = segundos + 1;
   
    $("#contador_pregunta_toda").val(segundos);
    guadar_video();
    }
  	setInterval(segundos_funcion, 1000);   
    
    }


$("#check_terminos").click(function(){

    if( $('#check_terminos').is(':checked') ) {
        $(".mensaje").html('');
    }else{
        $(".mensaje").html('<div class="alert alert-danger">Debe aceptar los terminos y condiciones.</div>');
    }

})


$("#name_form").keyup(function(){

    if($("#name_form").val() ==""){
    $(".mensaje").html('<div class="alert alert-danger">Su nombre es requerido.</div>');
    $("#name_form").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
    return false;
    }else{
        $(".mensaje").html('');
    }
    
})

$("#correo_form").keyup(function(){

    if($("#correo_form").val() == ""){
        $(".mensaje").html('<div class="alert alert-danger">Su correo es requerido.</div>');
        $("#correo_form").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }else{
        $(".mensaje").html('');
    }
    
})

$("#area_video").click(function(){
    console.log("Por aqui");
})

})
 
$(".requerido_correo").keyup(function (){

    
    $.post(ruta_ajax+"assets/ajax/enviar.php",{ verificar_correo: $(".requerido_correo").val() },function(res){
    
      if(res == 1){
        $(".requerido_correo").val("");
         $(".mensaje").html('<div class="alert alert-danger">Existe un correo registrado igual.</div>');
       //$("#mensaje").html("slow");      // Si hemos tenido éxito, hacemos aparecer el div "exito" con un efecto fadeIn lento tras un delay de 0,5 segundos.
        }else {
        console.log(res)
        $(".mensaje").html('');
          //$("#fracaso").delay(500).fadeIn("slow");    // Si no, lo mismo, pero haremos aparecer el div "fracaso"
      }

    });

});  

function validaForm_liderBanda(){

    if($("#name_form").val() ==""){
      $(".mensaje").html('<div class="alert alert-danger">Su nombre es requerido.</div>');
      $("#name_form").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
      return false;
    }else{
        $(".mensaje").html('');
    }
  
    if($("#correo_form").val() == ""){
        $(".mensaje").html('<div class="alert alert-danger">Su correo es requerido.</div>');
        $("#correo_form").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }else{
        $(".mensaje").html('');
    }
    

    if( $('#check_terminos').is(':checked') ) {
        $(".mensaje").html('');
    }else{

        $(".mensaje").html('<div class="alert alert-danger">Debe aceptar los terminos y condiciones.</div>');
        $("#check_terminos").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;

    }
    
  
     return true; // Si todo está correcto
     
  }