<?php
/**
 * Subfooter
 *
**/

defined('ABSPATH') or die('No script kiddies please!');

$fb = get_theme_mod('adventures_footer_fb_sett', '');
$tw = get_theme_mod('adventures_footer_tw_sett', '');
$inst = get_theme_mod('adventures_footer_inst_sett', '');
$yt = get_theme_mod('adventures_footer_yt_sett', '');
$lin = get_theme_mod('adventures_footer_lin_sett', '');

$copyright = get_theme_mod('adventures_copyright_setting', '');
$social_links = get_theme_mod('adventures_footer_display_links_sett', '');

?>

<div id="subfooter">
	<div class="subfooter-inner">
		<div class="container-fluid <?php echo ($copyright !== '') ? 'subfooter-twocols' : ''; ?>">
			<?php if ($copyright !== '') { ?>
				<div class="subfooter-copyright">
					<?php echo $copyright; ?>
				</div>
			<?php } ?>
			<?php if ($social_links == 1) { ?>
				<div class="d-flex flex-wrap subfooter-icons">						
					<?php if ($fb !== '') { ?>
						<div class="subfooter-item">
							<div class="subfooter-item-inner">
								<div class="subfooter-icon">
									<a href="<?php echo $fb; ?>" target="_blank"><i class="fab fa-facebook"></i></a>
								</div>
							</div>
						</div>
					<?php } ?>

					<?php if ($tw !== '') { ?>
						<div class="subfooter-item">
							<div class="subfooter-item-inner">
								<div class="subfooter-icon">
									<a href="<?php echo $tw; ?>" target="_blank"><i class="fab fa-twitter"></i></a>
								</div>
							</div>
						</div>
					<?php } ?>

					<?php if ($inst !== '') { ?>
						<div class="subfooter-item">
							<div class="subfooter-item-inner">
								<div class="subfooter-icon">
									<a href="<?php echo $inst; ?>" target="_blank"><i class="fab fa-instagram"></i></a>
								</div>
							</div>
						</div>
					<?php } ?>

					<?php if ($yt !== '') { ?>
						<div class="subfooter-item">
							<div class="subfooter-item-inner">
								<div class="subfooter-icon">
									<a href="<?php echo $yt; ?>" target="_blank"><i class="fab fa-youtube"></i></a>
								</div>
							</div>
						</div>
					<?php } ?>

					<?php if ($lin !== '') { ?>
						<div class="subfooter-item">
							<div class="subfooter-item-inner">
								<div class="subfooter-icon">
									<a href="<?php echo $lin; ?>" target="_blank"><i class="fab fa-linkedin"></i></a>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
	</div>
</div>