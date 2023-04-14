<?php

/*
* Function used to display the Cookies Policy
*/

defined('ABSPATH') or die('No script kiddies please!');

function adventures_cookies_policy() {
	global $post;

	$get_message = get_theme_mod('adventures_cookies_sett_textarea','This site uses cookies. By continuing to browse you accept their use.');
	$get_page_id = get_theme_mod('adventures_cookies_sett_post', '');
	$get_info_text = get_theme_mod('adventures_cookies_sett_info','Further Information');
	$get_btn_text = get_theme_mod('adventures_cookies_sett_agree','Ok');

	$cookies = false;

	if (array_key_exists('vcp_a', $_COOKIE)) {
		$cookies = $_COOKIE['vcp_a'];
	}

	if(!$cookies) { ?>
		
		<div class="vikcp-policy-container">
   			<div class="vikcp-policy-inner vikcp-policy-display-bottom">
				<span class="vikcp-policy-message"><?php echo $get_message; ?></span>
				<span class="vikcp-policy-link"><a href="<?php echo get_page_link($get_page_id); ?>"><?php echo $get_info_text; ?></a></span>
				<button id="vikcp-policy-btn" onclick="" type="button"><?php echo $get_btn_text; ?></button>
		    </div>
		</div>

		<script type="text/javascript">
		jQuery(document).ready(function() {
			jQuery(".vikcp-policy-container").fadeIn();
			jQuery("#vikcp-policy-btn").click(function() {
				document.cookie="vcp_a=1; expires=<?php echo date('r', (time() + (86400 * 60))); ?>; path=/";
				jQuery(".vikcp-policy-container").fadeOut(400, function() {
					jQuery(".vikcp-policy-container").remove();
				});
			});
		});
		</script>

	<?php 	
	}
}