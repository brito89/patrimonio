$(document).ready(function() {
    $(document).on("scroll", onScroll);
    
    $('#fullpage').fullpage({
        anchors: ['home', 'proyectos', 'blog', 'contacto'],
        menu: '#myMenu',
        //sectionsColor: ['black', 'black', 'black', 'black', 'black'],
        autoScrolling: false,
        resize: false,
        scrollOverflow:false,
        fixedElements:'.home',
        //paddingBottom:'10em',
        //paddingTop: '10em',
        //scrollBar: true
        
    });
    
        $('#myTab a').tab('show');
    
        $('#myTab2 a').tab('show');
    
        
    
});

function onScroll(event){
    
    var scrollPos = $(document).scrollTop();
    
    if(scrollPos >= 200 )
    {   
        $('#logo-menu').removeClass('logo');
        $('#logo-top').removeClass('thumbnail');
        $('#logo-top').hide();
        $('#logo-scroll').fadeIn(1000);
        
        
    }
    
    else
    {
        $('#logo-menu').addClass('logo');
        $('#logo-top').addClass('thumbnail');
        $('#logo-top').show();
        $('#logo-scroll').hide();
       
    }
            
            
}
