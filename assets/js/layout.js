$(function () {

    function fixSidebarLayout() {
        var hViewPort = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
        var hSideBar = $('.navbar-side').height(), hPage = $('#page-inner').outerHeight() + $('.navbar-top').outerHeight();
        if ((hSideBar < hPage) && (hSideBar > hViewPort)) {
            $(window).on('.affix');
            $('.navbar-side').affix({
                offset: {
                    top: hSideBar - hViewPort
                }
            });
        } else {
            $(window).off('.affix');
            $('.navbar-side').removeData('bs.affix').removeData('.affix').removeClass('affix affix-top affix-bottom');
            if (hSideBar > hPage) $('.navbar-side').addClass('affix-top');
        }
    }

    function windowResize(handler) {
        if (window.addEventListener) {
            window.addEventListener('resize', handler);
        } else {
            console.log("ERROR: Failed to bind to window.resize with: ", handler);
        }
        // return object with clear function to remove the single added callback.
        return {
            callback: handler,
            clear: function () {
                window.removeEventListener('resize', handler);
            }
        }
    }

    function ready() {
        fixSidebarLayout();
        windowResize(function () { fixSidebarLayout(); });
    }

    $(document).ready(ready);

    $.fixSidebarLayout = function () {
        fixSidebarLayout();
    };
})