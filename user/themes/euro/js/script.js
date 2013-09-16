/* Author:

*/

(function ($) {
	'use strict';

	// big picture on home page
	$('.list-2').find('img').each(function () {
		var image = $(this),
			height = image.height(),
			marginTopVal = -(Math.ceil(height / 2) - 80);
		if (height > 160) image.css({ marginTop: marginTopVal, visibility: 'visible'});
		else image.css({ height: 160, visibility: 'visible'});
	});

	$('ul.sf-menu').superfish({
		animation:		{opacity: 'show'},		// fade-in and slide-down animation 
		speed:			'fast',					// faster animation speed 
		autoArrows:		false,					// disable generation of arrow mark-up 
		dropShadows:	false,					// disable drop shadows
		delay:			0						// <- broken...
	});

	// home page slider
	$('#featured')
		.tabs({ fx: { opacity: 'toggle' }, event: 'mouseover' })
		.tabs('rotate', 7000, true);

	// lazyload of pictures
	if (navigator.platform !== 'iPad') {
		$('img').lazyload({
			effect: 'fadeIn',
			placeholder: '$placeholdergif',
			threshold : 200
		});
	}

	// search bar text
	$('#search-box')
		.on('click', function () {
			if (this.value === $(this).data('placeholder')) this.value = '';
		})
		.on('blur', function () {
			if (this.value === '') this.value = $(this).data('placeholder');
		});

	// socialshareprivacy config
	var sspDiv = $('#socialshareprivacy');
	
	if (sspDiv.length) {
		sspDiv.socialSharePrivacy({
			services: {
				facebook: {
					'app_id': '121944181248560',
					'dummy_img': 'http://beta.one1europe.eu/user/themes/euro/socialshareprivacy/images/dummy_facebook.png',
					'referrer_track': '/from/facebook',
					'language': 'en',
					'txt_fb_off': 'not connected to facebook',
					'txt_fb_on': 'connected to facebook',
					'txt_info': '2 clicks for more privacy: Once you click here, the button will be activated and information will immediately be sent to a third party. See <i>i</i> for more information.'
				},
				twitter: {
					'dummy_img': 'http://beta.one1europe.eu/user/themes/euro/socialshareprivacy/images/dummy_twitter.png',
					'referrer_track': '/from/twitter',
					'txt_twitter_off': 'not connected to twitter',
					'txt_twitter_on': 'connected to twitter',
					'txt_info': '2 clicks for more privacy: Once you click here, the button will be activated and information will immedeately be sent to a third party. See <i>i</i> for more information.'
				},
				gplus: {
					'dummy_img': 'http://beta.one1europe.eu/user/themes/euro/socialshareprivacy/images/dummy_gplus.png',
					'referrer_track': '/from/gplus',
					'language': 'en',
					'txt_gplus_off': 'not connected to G+',
					'txt_gplus_on': 'connected to G+',
					'txt_info': '2 clicks for more privacy: Once you click here, the button will be activated and information will immediately be sent to a third party. See <i>i</i> for more information.'
				}
			},
			'cookie_domain': 'one1europe.eu',
			'css_path': 'http://beta.one1europe.eu/user/themes/euro/socialshareprivacy/socialshareprivacy.css',
			'settings_perma': 'Activate permanentely and agree to submission of data:',
			'txt_help': 'These fields, once activated by a click, will submit data to Facebook, Twitter and Google, who are located in the US. This data is going to be stored permanently. For more information (in German), please click this button.'
		});
	}

})(jQuery);