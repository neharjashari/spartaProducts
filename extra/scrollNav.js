window.onscroll = manipuloNav();

function manipuloNav()
{
    var lastPosition = 0;
    $(document).ready(function()
    {
        $(window).scroll(function()
        {
            var pos = $(this).scrollTop();
            var nav = $("nav");
            if(pos > lastPosition)
            {
                nav.slideUp(300);
            }
            else
            {
                nav.slideDown(300);
            }                   
            lastPosition = pos; 
        });
    });
}