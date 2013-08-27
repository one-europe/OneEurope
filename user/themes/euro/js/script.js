/* Author:

*/

(function ($) {
	'use strict';

	$('.list-2').find('img').each(function () {
		var image = $(this),
			height = image.height(),
			marginTopVal = -(Math.ceil(height / 2) - 51);
		if (height > 130) image.css({ marginTop: marginTopVal, visibility: 'visible'});
		else image.css({ height: 130, visibility: 'visible'});
	});

})(jQuery);