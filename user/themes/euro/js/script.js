/* Author:

*/

(function ($) {
	'use strict';

	$('.list-2').find('img').each(function () {
		var image = $(this),
			height = image.height(),
			marginTopVal = -(Math.ceil(height / 2) - 51);
		image.css({ marginTop: marginTopVal, visibility: 'visible'});
	});

})(jQuery);