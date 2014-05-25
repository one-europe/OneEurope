(function ($) {
	'use strict';

	$.ajaxSetup({ cache: true });
	$.getScript('//connect.facebook.net/en_UK/sdk.js', function () {
		FB.init({ appId: '121944181248560', xfbml: true, version: 'v2.0' });
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

	// search bar text
	$('#search-box')
		.on('click', function () {
			if (this.value === $(this).data('placeholder')) this.value = '';
		})
		.on('blur', function () {
			if (this.value === '') this.value = $(this).data('placeholder');
		});

	// jqueryui tooltip
	$('.debates-list').find('a').tooltip({ track: true, position: { my: 'left+8 bottom-8' } });

	// donate widget
	var donateTable = $('#table15221'),
		goal = 5000,
		text = donateTable.find('tr').find('td').text(),
		re = /\d+$/,
		value =  parseInt(text.match(re), 10),
		cls = '';

	cls = value > goal * 0.1 ? 'p10' : cls;
	cls = value > goal * 0.2 ? 'p20' : cls;
	cls = value > goal * 0.3 ? 'p30' : cls;
	cls = value > goal * 0.4 ? 'p40' : cls;
	cls = value > goal * 0.5 ? 'p50' : cls;
	cls = value > goal * 0.6 ? 'p60' : cls;
	cls = value > goal * 0.7 ? 'p70' : cls;
	cls = value > goal * 0.8 ? 'p80' : cls;
	cls = value > goal * 0.9 ? 'p90' : cls;
	
	donateTable.addClass(cls);

	// do something with this
	$('.img-wrap').nailthumb({
		width: 160,
		height: 100,
		replaceAnimation: null,
		onFinish: function (el) { el.find('img').addClass('v'); }
	});

	$('.img-wrap-large').nailthumb({
		width: 224,
		height: 160,
		replaceAnimation: null,
		onFinish: function (el) { el.find('img').addClass('v'); }
	});

	$('.img-wrap-f-large').nailthumb({
		width: 430,
		height: 200,
		replaceAnimation: null,
		onFinish: function (el) { el.find('img').addClass('v'); }
	});

	$('.img-wrap-f-small').nailthumb({
		width: 82,
		height: 50,
		replaceAnimation: null,
		onFinish: function (el) { el.find('img').addClass('v'); }
	});

	$('.img-wrap-profile').nailthumb({
		width: 100,
		height: 125,
		replaceAnimation: null,
		onFinish: function (el) { el.find('img').addClass('v'); }
	});

})(jQuery);



/** Say Hello Ajax Form **/

(function ($) {
	'use strict';

	var
	_body = $('body'),
	_contactForm = $('#contactForm'),
	_senderName = $('#senderName'),
	_senderEmail = $('#senderEmail'),
	_senderMessage = $('#senderMessage'),
	_incompleteMsg = null,
	_sendingMsg = null,
	_successMsg = null,
	_failureMsg = null,
	_incompleteTxt = 'Please complete all the fields before sending',
	_sendingTxt = 'Sending your message...',
	_successTxt = 'Thanks for sending your message! We will get back to you shortly',
	_failureTxt = 'There was a problem sending your message. Please remove all contained "http://"s and try again',
	_delay = 5000,

	init = function () {
		_contactForm.submit(submitForm);
	},

	removeMessage = function () { this.remove(); },

	submitForm = function () {
		var name = _senderName.val().length,
			email = _senderEmail.val().length,
			message = _senderMessage.val().length;

		if (!name || !email || !message) {
			_incompleteMsg = $('<div>').addClass('incompleteMsg statusMsg').text(_incompleteTxt);
			_body.append(_incompleteMsg.slideDown().delay(_delay).slideUp('slow', removeMessage));
		} else {
			_sendingMsg = $('<div>').addClass('sendingMsg statusMsg').text(_sendingTxt);
			_body.append(_sendingMsg.slideDown());

			$.ajax({
				url: _contactForm.attr('action') + '?ajax=true',
				type: _contactForm.attr('method'),
				data: _contactForm.serialize(),
				success: submitFinished
			});
		}

		return false;
	},

	// Handle the Ajax response
	submitFinished = function (status) {
		_sendingMsg.slideUp('slow', removeMessage);

		status = $.trim(status);
		if (status === 'success') {
			_successMsg = $('<div>').addClass('successMsg statusMsg').text(_successTxt);
			_body.append(_successMsg.slideDown().delay(_delay).slideUp('slow', removeMessage));
			_senderName.val('');
			_senderEmail.val('');
			_senderMessage.val('');
		} else {
			_failureMsg = $('<div>').addClass('failureMsg statusMsg').text(_failureTxt);
			_body.append(_failureMsg.slideDown().delay(_delay).slideUp('slow', removeMessage));
		}
	};

	init();

})(jQuery);
		
// ===== end ajaxform ==== //


// ===== google maps /contact script ===== //

// (function (window) {
// 	'use strict';

// 	window.initmap = function () {
// 		var myLatlng = new google.maps.LatLng(50.83870, 4.37284),
// 			myOptions = {
// 				zoom: 17,
// 				center: myLatlng,
// 				scrollwheel: false,
// 				zoomControl: true,
// 				mapTypeControl: true,
// 				scaleControl: true,
// 				streetViewControl: true,
// 				overviewMapControl: true,
// 				mapTypeId: google.maps.MapTypeId.HYBRID
// 			},
// 			map = new google.maps.Map(mapCanvas, myOptions),
// 			marker = new google.maps.Marker({
// 				title: 'OneEurope, Place du Luxembourg 6, 1050 Bruxelles, Belgium',
// 				position: myLatlng,
// 				map: map
// 			});
// 	};

// 	var mapCanvas = document.getElementById('map_canvas'),
// 		loadScript = function () {
// 			var script = document.createElement('script');
// 			script.type = 'text/javascript';
// 			script.src = 'http://maps.google.com/maps/api/js?sensor=false&callback=initmap';
// 			document.body.appendChild(script);
// 		};

// 	if (mapCanvas) loadScript();

// })(this);

// ===== end google maps /contact script ===== //



// flattr code, not in use atm
var flattrButton = $('.FlattrButton');
if (flattrButton.length) {
	var s = document.createElement('script'), t = document.getElementsByTagName('script')[0];
	s.async = true;
	s.src = 'http://api.flattr.com/js/0.6/load.js?mode=auto';
	t.parentNode.insertBefore(s, t);
}

// g-plus-box: google plus badge
var gPlusBox = $('.g-plus-box');
if (gPlusBox.length) {
	var s = document.createElement('script'), t = document.getElementsByTagName('script')[0];
	s.type = 'text/javascript';
	s.async = true;
	s.src = 'https://apis.google.com/js/plusone.js';
	t.parentNode.insertBefore(s, t);
}

// scoopit-button
var scoopitButton = $('.scoopit-button');
if (scoopitButton.length) {
	var s = document.createElement('script'), t = document.getElementsByTagName('script')[0];
	s.async = true;
	s.src = 'http://www.scoop.it/button/scit.js';
	t.parentNode.insertBefore(s, t);
}

// pinterest-board
var pinterestBoard = $('.pinterest-board');
if (pinterestBoard.length) {
	var s = document.createElement('script'), t = document.getElementsByTagName('script')[0];
	s.async = true;
	s.src = '//assets.pinterest.com/js/pinit.js';
	t.parentNode.insertBefore(s, t);
}

// twitter-timeline
var twitterTimeline = $('.twitter-timeline'), twitterFollowButton = $('.twitter-follow-button');
if (twitterTimeline.length || twitterFollowButton) {
	var s, t = document.getElementsByTagName('script')[0],
		path = /^http:/.test(document.location) ? 'http' : 'https';
	if (!document.getElementById('twitter-wjs')) {
		s = document.createElement('script');
		s.id = 'twitter-wjs';
		s.src = path + '://platform.twitter.com/widgets.js';
		t.parentNode.insertBefore(s, t);
	}
}

// addthis_toolbox
var addthisToolbox = $('.addthis_toolbox'), trending = $('#addthis_trendingcontent');
if ((addthisToolbox.length) || (trending.length)) {
	var s = document.createElement('script'), t = document.getElementsByTagName('script')[0];
	s.src = 'http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4fe91cf356685c8e';
	t.parentNode.insertBefore(s, t);

	if (trending.length) {
		setTimeout(function () {
			addthis.box('#addthis_trendingcontent', {
				feed_title: '',
				feed_type: 'shared',
				feed_period: 'week',
				num_links: 8,
				height: 'auto',
				width: 'auto',
				domain: 'one-europe.info',
				remove: '- OneEurope'
			});
		}, 2000);
	}
}

// This service is an opportunity to inform your visitors unobtrusively to switch to a newer browse
// var $buoop = {vs: {i: 8, f: 15, o: 12.1, s: 5.1}};
// $buoop.ol = window.onload;
// window.onload = function () {
// 	try { if ($buoop.ol) $buoop.ol(); } catch (e) {}
// 	var e = document.createElement('script');
// 	e.setAttribute('type', 'text/javascript');
// 	e.setAttribute('src', '//browser-update.org/update.js');
// 	document.body.appendChild(e);
// };