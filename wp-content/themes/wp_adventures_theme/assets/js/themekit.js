jQuery.noConflict();

/** Responsive Menu - part 1 **/
var resp_menu_on = false;

//In windows and in Opera this can cause an issue
var scroll_bounce = (window.chrome !== null && typeof window.chrome !== "undefined") || typeof window.opr !== "undefined";

function vikShowResponsiveMenu() {
	jQuery(".nav-menu-active").toggle();
	jQuery(".vikwp-body").toggleClass("e4j-body-fixed e4j-body-shifted");
	if(jQuery(".vikwp-body").hasClass("e4j-body-shifted")) {
		resp_menu_on = true;
	}else {
		resp_menu_on = false;
	}
}

/*
 * @since v1.0.4
 * Changed the class application based on the number of widget inside the sidebar, removed from the functions.php. 
 * We build the class by using jQuery instead of PHP to avoid compatibility problems with multi-language plugins that needs 
 * to have every widget for each language displayed. 
 */
function add_class_numb_widgets(element) {

	var build_element = element + ' .widget';
	var destination_class = element + ' .cnt-flex';
	var number_widgt = jQuery(build_element).length;
	var class_module = '';

	if (number_widgt == 1) {
		class_module = 'nwidg-one';
	} else if (number_widgt == 2) {
		class_module = 'nwidg-two';
	} else if (number_widgt == 3) {
		class_module = 'nwidg-three';
	} else if (number_widgt == 4) {
		class_module = 'nwidg-four';
	}
	jQuery(destination_class).addClass(class_module);

}

jQuery(document).ready(function() {

	
	
	jQuery(".vrcdialog-overlay-close-inside").on( "click", function(e) {
	  jQuery("#vrcdialog-overlay").css('display', 'none');
		e.preventEvent();
	});

	/** Dismiss System Messages on double click ***/
	jQuery(".notice.is-dismissible").dblclick(function() {
		jQuery(this).fadeOut(400, function() {
			jQuery(this).remove();
		});
	});

	//Manage submenu panel
	var login_blocked = false;
	jQuery(".mainmenu li.menu-item-has-children, .upmenu-content li.menu-item-has-children").hover(function() {
		jQuery(this).addClass("parent-open");
	}, function() {
		jQuery(this).removeClass("parent-open");
	});

	var menu_selector = jQuery(".headfixed");
	var container_sticky = jQuery('.fixedmenu');
	var change_to_sticky = true;
	var lim_pos = 90;
	if(menu_selector.length) {
		lim_pos = menu_selector.height();
	}
	jQuery(window).scroll(function() {
		var scrollpos = jQuery(window).scrollTop();
		if (scrollpos > lim_pos) {
			if (change_to_sticky === true) {

				container_sticky.toggleClass("fx-menu-slide");
				change_to_sticky = false;
              	
              	//In windows and in Opera this can cause an issue
				/*if(scroll_bounce) {
					jQuery(window).scrollTop(jQuery(window).scrollTop() + (lim_pos + 1));
				}*/
				
			}
		} else {
			if ((change_to_sticky === false) && (scrollpos == 0) ) {
				container_sticky.toggleClass("fx-menu-slide");
				change_to_sticky = true;
               
               	//In windows and in Opera this can cause an issue
				/*if(scroll_bounce) {
					jQuery(window).scrollTop(jQuery(window).scrollTop() - (lim_pos + 1));
				}*/
			}
		}
	});


	/** Responsive Menu - part 2 **/
	var screen = jQuery(window).width();
	if (screen <= 1280) {
		jQuery("#nav-menu-devices").addClass("nav-menu-active");
	}
	jQuery(window).resize(function() {
		var width = jQuery(window).width();
		if (width <= 1280) {
			jQuery("#nav-menu-devices").addClass("nav-menu-active");
		} else {
			jQuery("#nav-menu-devices").removeClass("nav-menu-active").removeAttr("style");
		}
	});

	jQuery(document).mouseup(function (e) {
		var resp_menu_cont = jQuery("#nav-menu-devices");
		var resp_menu_button = jQuery("#menumob-btn-ico");
		if(resp_menu_on && !resp_menu_cont.is(e.target) && resp_menu_cont.has(e.target).length === 0  && !resp_menu_button.is(e.target) && resp_menu_button.has(e.target).length === 0) {
			resp_menu_on = false;
			jQuery(".nav-menu-active").hide();
			jQuery(".vikwp-body").removeClass("e4j-body-fixed e4j-body-shifted");
			jQuery("#menumob-btn-ico").removeClass("open");
		}
	});

	jQuery('#menumob-btn-ico').click(function(){
		jQuery(this).toggleClass('open');
	});


	/* Blog List - set the abstract text height to the featured background image */
	var addStyleBlog = function() {
		var blogTextHeight = jQuery('.blog-cnt-text').outerHeight(true);
		jQuery('.bloglist-featured-img').css('height', blogTextHeight);
	}

	if(screen > 768) {
		setTimeout(addStyleBlog, 300);
	} else {
		jQuery('.bloglist-featured-img').css('height', '');
	}

	jQuery(window).resize(function() {
		var widthResize = jQuery(window).width();
		if(widthResize > 768) {
			setTimeout(addStyleBlog, 300);
		} else {
			jQuery('.bloglist-featured-img').css('height', '');
		}
	});

	/* Responsive Menu - on click open the submenu */

	/* @wp add the responsive arrow to every parent elements */

	var parent_el = jQuery('.nav-devices-list .menu > .menu-item-has-children > div').append('<i class="fas submenu-arrow fa-caret-down"></i>');

	var first_submenu_arrow = jQuery('.nav-devices-list .menu > .menu-item-has-children > div > .submenu-arrow');
	var internal_submenu_arrow = jQuery('.nav-devices-list .nav-child > div > .menu-item-has-children > div > .submenu-arrow');
	var submenu_main_li = jQuery('.nav-devices-list .menu > .menu-item-has-children');

	first_submenu_arrow.on('click', function() {
		if(jQuery(this).closest(submenu_main_li).hasClass('submenu-open')) {
			jQuery(this).closest(submenu_main_li).removeClass('submenu-open');
			submenu_main_li.find('li').removeClass('submenu-open');
			internal_submenu_arrow.addClass('fa-caret-up');
			internal_submenu_arrow.removeClass('fa-caret-down');
		} else {
			jQuery(this).parents('li').addClass('submenu-open');
		}

		if(jQuery(this).hasClass('fa-caret-down')) {
			jQuery(this).removeClass('fa-caret-down');
			jQuery(this).addClass('fa-caret-up');
		} else {
			jQuery(this).addClass('fa-caret-down');
			jQuery(this).removeClass('fa-caret-up');
		}		
	});

	internal_submenu_arrow.click(function() {
		jQuery(this).parents('.nav-child li').toggleClass('submenu-open');

		if(jQuery(this).hasClass('fa-caret-down')) {
			jQuery(this).removeClass('fa-caret-down');
			jQuery(this).addClass('fa-caret-up');
		} else {
			jQuery(this).addClass('fa-caret-down');
			jQuery(this).removeClass('fa-caret-up');
		}		
	});

	/*
	 * @since v1.0.4
	 * Select all the containers that will have the custom classes based on the number of the widgets on the sidebar. 
	 */
	add_class_numb_widgets('#modulebox-contact');
	add_class_numb_widgets('#module-box-01');
	add_class_numb_widgets('#module-box-02');
	add_class_numb_widgets('#sidebar-footer');

});