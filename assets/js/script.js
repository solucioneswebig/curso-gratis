var ruta_servidor = "https://"+document.domain+"/views/curso/";
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
$.post(ruta_servidor+"assets/ajax/enviar.php",$(".form_enviar").serialize(),function(res){

     console.log(res)
 });

});

})