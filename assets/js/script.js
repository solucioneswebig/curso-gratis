var ruta_ajax = "https://"+document.domain+"/views/curso/";
var ruta_sitio = "https://"+document.domain+"/";
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

$("a").on("click", function(e){
    e.preventDefault();
    $("html, body").animate({
        scrollTop: 0
    }, 1000); 
});

$("#boton_guardar").click( function() { 
if(validaForm_liderBanda()){
$.post(ruta_ajax+"assets/ajax/enviar.php",$(".form_enviar").serialize(),function(res){

     console.log(res)
       /* if(res == 1){
            location.href = ruta_sitio+'confirmacion';
        } */
     
 });
}
});

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



})


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