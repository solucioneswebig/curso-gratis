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

})