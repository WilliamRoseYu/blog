$(function(){
    $('.mouseOn').hover(function(){
        $(this).parent().find('.top-nav-out').animate({height:'12'},'fast')
    },
    function(){
         $(this).parent().find('.top-nav-out').animate({height:'0'},'fast')
    }
    );


    $('.xiang-nav ul li').hover(function(){
        // $(this).css('background','#075498')
    })
});



















