
$(function() {
	colorpicker();
});

function colorpicker() {
	$('.colorpicker:not(.colorpicker-done)').each(function() {
	
		$(this).colorpickerplus();

		if ($(this).val()) {
			$(this).css({'color': 'inherit', 'background-color': $(this).val()});
			if (isDark($(this).val())) {
				$(this).css('color', '#fff');
			}
		}

		$(this).on('changeColor', function(e, color){
			
			if(color==null)
				$(this).val('').css('background-color', '#fff');//tranparent
			else {
				$(this).val(color).css({'color': 'inherit', 'background-color': color});
				if (isDark(color)) {
					$(this).css('color', "#fff");
				}
			}
				
		});

	});
}

function isDark( color ) {

	color = hexToRgb(color);

    return parseFloat(color.r)
         + parseFloat(color.g)
         + parseFloat(color.b)
           < 3 * 256 / 2; // r+g+b should be less than half of max (3 * 256)
}

function hexToRgb(hex) {
    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    return result ? {
        r: parseInt(result[1], 16),
        g: parseInt(result[2], 16),
        b: parseInt(result[3], 16)
    } : null;
}