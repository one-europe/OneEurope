/* Author:

*/

(function ($) {
	'use strict';

	$('.list-2').find('img').each(function () {
		var image = $(this),
			height = image.height(),
			marginTopVal = -(Math.ceil(height / 2) - 80);
		if (height > 160) image.css({ marginTop: marginTopVal, visibility: 'visible'});
		else image.css({ height: 160, visibility: 'visible'});
	});

})(jQuery);