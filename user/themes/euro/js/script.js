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
	$('img').lazyload({
		effect: 'fadeIn',
		placeholder: '$placeholdergif',
		threshold : 200
	});

	// search bar text
	$('#search-box')
		.on('click', function () {
			if (this.value === $(this).data('placeholder')) this.value = '';
		})
		.on('blur', function () {
			if (this.value === '') this.value = $(this).data('placeholder');
		});

	$('.debates-list').find('a').aToolTip();

})(jQuery);

// ===== ajaxform ===== //

(function ($) {
	'use strict';

	var messageDelay = 5000,  // How long to display status messages (in milliseconds)


	// Initialize the form
	init = function () {

		// Hide the form initially.
		// Make submitForm() the formâ€™s submit handler.
		// Position the form so it sits in the centre of the browser window.
		$('#contactForm').submit(submitForm).addClass('positioned');

		// When the "Send us an email" link is clicked:
		// 1. Fade the content out
		// 2. Display the form
		// 3. Move focus to the first field
		// 4. Prevent the link being followed

		$('a[href="#contactForm"]').click(function () {
			$('#content').fadeTo('slow', 0.2);
			$('#contactForm').fadeIn('slow', function () {
				$('#senderName').focus();
			});
			return false;
		});

		// When the "Cancel" button is clicked, close the form
		/*$('#cancel').click(function () {
			$('#contactForm').fadeOut();
			$('#content').fadeTo('slow', 1);
		});*/

		// When the "Escape" key is pressed, close the form
		/*$('#contactForm').keydown(function (event) {
			if (event.which === 27) {
				$('#contactForm').fadeOut();
				$('#content').fadeTo('slow', 1);
			}
		});*/

	},


	// Submit the form via Ajax
	submitForm = function () {
		var contactForm = $(this);

		// Are all the fields filled in?
		if (!$('#senderName').val() || !$('#senderEmail').val() || !$('#message').val()) {
			// No; display a warning message and return to the form
			$('#incompleteMessage').slideDown().delay(messageDelay).slideUp();
		} else {
			// Yes; submit the form to the PHP script via Ajax
			$('#sendingMessage').slideDown();
			$.ajax({
				url: contactForm.attr('action') + '?ajax=true',
				type: contactForm.attr('method'),
				data: contactForm.serialize(),
				success: submitFinished
			});
		}

		// Prevent the default form submission occurring
		return false;
	},

	// Handle the Ajax response
	submitFinished = function (response) {
		response = $.trim(response);
		$('#sendingMessage').slideUp();

		if (response === 'success') {

			// Form submitted successfully:
			// 1. Display the success message
			// 2. Clear the form fields
			// 3. Fade the content back in

			$('#successMessage').slideDown().delay(messageDelay).slideUp();
			$('#senderName').val('');
			$('#senderEmail').val('');
			$('#message').val('');
			$('#content').delay(messageDelay + 500).fadeTo('slow', 1);

		} else {
			// Form submission failed: Display the failure message,
			// then redisplay the form
			$('#failureMessage').slideDown().delay(messageDelay).slideUp();
			$('#contactForm').delay(messageDelay + 500).fadeIn();
		}
	};

	init();	// Init the form once the document is ready

})(jQuery);
		
// ===== end ajaxform ==== //


// ===== google maps /contact script ===== //

(function (window) {
	'use strict';

	window.initmap = function () {
		var myLatlng = new google.maps.LatLng(50.83870, 4.37284),
			myOptions = {
				zoom: 17,
				center: myLatlng,
				scrollwheel: false,
				zoomControl: true,
				mapTypeControl: true,
				scaleControl: true,
				streetViewControl: true,
				overviewMapControl: true,
				mapTypeId: google.maps.MapTypeId.HYBRID
			},
			map = new google.maps.Map(mapCanvas, myOptions),
			marker = new google.maps.Marker({
				title: 'OneEurope, Place du Luxembourg 6, 1050 Bruxelles, Belgium',
				position: myLatlng,
				map: map
			});
	};

	var mapCanvas = document.getElementById('map_canvas'),
		loadScript = function () {
			var script = document.createElement('script');
			script.type = 'text/javascript';
			script.src = 'http://maps.google.com/maps/api/js?sensor=false&callback=initmap';
			document.body.appendChild(script);
		};

	if (mapCanvas) loadScript();

})(this);

// ===== end google maps /contact script ===== //



// ===== flattr code, not in use atm
(function ($) {
	var FlattrButton = $('.FlattrButton'),
		flloadFlattrScript = function () {
			var s = document.createElement('script'), t = document.getElementsByTagName('script')[0];
			s.type = 'text/javascript';
			s.async = true;
			s.src = 'http://api.flattr.com/js/0.6/load.js?mode=auto';
			t.parentNode.insertBefore(s, t);
		};
	if (FlattrButton) flloadFlattrScript();
})(jQuery);