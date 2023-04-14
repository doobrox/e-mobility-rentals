/**
 * Live-update changed settings in real time in the Customizer preview.
 */

/** Change Color link **/
(function($){
	wp.customize('adventures_main_color',function(value) {
	    value.bind(function(to) {
	        $('a').css('color', to ? to : '');
	    });
	});
})(jQuery)

/** Frontpage Section - Show Header **/
wp.customize('adventures_settings_header', function(value) {
	value.bind(function(to) {
		if('no' === to) {
			$('.hp-page .entry-header .entry-title').hide()
		} else {
			$('.hp-page .entry-header .entry-title').show();
		} 
	});
});

/** Frontpage Section - Show page content **/
wp.customize('adventures_sett_show_fpage', function(value) {
	value.bind(function(to) {
		if(0 == to) {
			$('#main-inner').hide()
		} else {
			$('.#main-inner').show();
		} 
	});
});

/** Show Home meta **/
wp.customize('adventures_display_meta', function(value) {
	value.bind(function(to) {
		if('yes' === to) {
			$('.hp-page .entry-footer').hide()
		} else {
			$('.hp-page .entry-footer').show();
		} 
	});
});

wp.customize('adventures_display_postmeta', function(value) {
	value.bind(function(to) {
		if('yes' === to) {
			$('.entry-footer').hide()
		} else {
			$('.entry-footer').show();
		} 
	});
});

/** Google Font Selection **/

wp.customize('adventures_fonts_header', function(value) {
	value.bind(function(to) {
		$('.title-font, h1, h2, h3, h4').css('font-family', to);
	});
});
wp.customize('adventures_bodyfonts_header', function(value) {
	value.bind(function(to) {
		$('body').css('font-family', to);
	});
});

