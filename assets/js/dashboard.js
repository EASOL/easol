$(function () {

    function addElementToIntro($el, $intro, method, offsetTop) {
        $el.offset({ top: $intro.offset().top + offsetTop });
        $intro[method]($el);
    }

    function updateIntro() {
        $('#chardin_template .chardinjs-ext-el').each(function () {
            var $el = $(this).clone();
            $el.addClass('chardinjs-helper-layer');
            if ($el.data('chardin-ext') == 'above-intro') {
                addElementToIntro($el, $('.chardinjs-helper-layer').first(), "before", -80);
            } else {
                addElementToIntro($el, $('.chardinjs-helper-layer').last(), "after", 80);
            }
        });
        $('.chardin-form').submit(function () {
            if ($('[type="checkbox"]', this).is(':checked')) {
                Cookies.set('show-intro', 'false', { expires: 365 * 10 });
            }
            $('body').chardinJs('stop');
            return false;
        });
    }

    function ready() {
        $('body').on('chardinJs:start', function () {
            updateIntro();
            $('.chardinjs-overlay').unbind().attr('onclick', '').click(function (e) { e.preventDefault(); return false;});
        })
        if (!Cookies.get('show-intro')) $('body').chardinJs('start');
    }

    $(document).ready(ready);

})