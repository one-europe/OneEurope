(function ($) {
	'use strict';

	$.ajaxSetup({ cache: true });
	$.getScript('//connect.facebook.net/en_UK/sdk.js', function () {
		FB.init({ appId: '121944181248560', xfbml: true, version: 'v2.0' });
	});

	$('.debates-list').on('click', 'div', function () {
		var parent = $(this).parent('div'), toggle = parent.hasClass('expanded');
		console.log('toggle', toggle);
		parent.toggleClass('expanded', !toggle);
	});

	$('.min-info').find('a').prop('href', 'mailto:info@one-europe.info');

	// make all links in the post open in a new window
	$('.post-content').find('a:not(.please-donate)').attr('target', '_blank');

	// home page slider
	$('.featured-tabs')
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
	if (navigator.userAgent.match(/iPad|iPhone|iemobile/i) === null) {
		$('.debates-list').find('a').tooltip({
			track: true,
			position: { my: 'left+8 bottom-8' }
		});
	}

	// donate widget
	// var donateTable = $('#table15221'),
	// 	goal = 5000,
	// 	text = donateTable.find('tr').find('td').text(),
	// 	re = /\d+$/,
	// 	value =  parseInt(text.match(re), 10),
	// 	cls = '';

	// cls = value > goal * 0.1 ? 'p10' : cls;
	// cls = value > goal * 0.2 ? 'p20' : cls;
	// cls = value > goal * 0.3 ? 'p30' : cls;
	// cls = value > goal * 0.4 ? 'p40' : cls;
	// cls = value > goal * 0.5 ? 'p50' : cls;
	// cls = value > goal * 0.6 ? 'p60' : cls;
	// cls = value > goal * 0.7 ? 'p70' : cls;
	// cls = value > goal * 0.8 ? 'p80' : cls;
	// cls = value > goal * 0.9 ? 'p90' : cls;
	
	// donateTable.addClass(cls);


	$('.img-wrap').nailthumb({
		width: 160,
		height: 100,
		replaceAnimation: null,
		onFinish: function (c) {
			c.find('img').addClass('resized');
		}
	});

	$('.img-wrap-f-large').nailthumb({
		width: 430,
		height: 200,
		replaceAnimation: null,
		onFinish: function (c) {
			c.find('img').addClass('resized');
		}
	});

	$('.img-wrap-f-small').nailthumb({
		width: 82,
		height: 50,
		replaceAnimation: null,
		onFinish: function (c) {
			c.find('img').addClass('resized');
		}
	});

	$('.img-wrap-large').nailthumb({
		width: 231,
		height: 165,
		replaceAnimation: null,
		onFinish: function (c) {
			c.find('img').addClass('resized');
		}
	});

	$('.img-wrap-result').nailthumb({
		width: 260,
		height: 138,
		replaceAnimation: null,
		onFinish: function (c) {
			c.find('img').addClass('resized');
		}
	});

	$('.img-wrap-profile').nailthumb({
		width: 100,
		height: 125,
		replaceAnimation: null,
		onFinish: function (c) {
			c.find('img').addClass('resized');
		}
	});

})(jQuery);

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

// pinterest-board
var pinterestBoard = $('.pinterest-board');
if (pinterestBoard.length) {
	var s = document.createElement('script'), t = document.getElementsByTagName('script')[0];
	s.async = true;
	s.setAttribute('data-pin-hover', true);
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
	var s = document.createElement('script'), t = document.getElementsByTagName('script')[0],
		addthis_share = { templates: { twitter: '{{title}} {{url}} via @One1Europe' } };
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