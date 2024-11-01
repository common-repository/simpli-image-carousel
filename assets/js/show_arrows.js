jQuery(document).ready(function () { 
        jQuery('.owl-carousel').owlCarousel('destroy');   
               jQuery('.owl-carousel').owlCarousel({
                   loop:true,
                   margin:30,
                   nav:true,
                  // autoplay:true,
                  // autoplayTimeout:5000,
                  //dots:true,
                  //rtl:true,
                   responsive:{
                   0:{
                       items:1,
                       nav:true,
                       loop:true,
                       dots:true,
                   },
                   300:{
                       items:1,
                       nav:true,
                       loop:true,
                       dots:true,
                   },
                   600:{
                       items:3,
                       nav:true,
                       loop:true,
                       dots:true,
                   }
               }
           });
           
       });