<?php
/**
 * @package     VikRentCar
 * @subpackage  com_vikrentcar
 * @author      Alessio Gaggii - e4j - Extensionsforjoomla.com
 * @copyright   Copyright (C) 2018 e4j - Extensionsforjoomla.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * @link        https://vikwp.com
 */

defined('ABSPATH') or die('No script kiddies please!');

$cars=$this->cars;
// print_r($cars);
$key_values = array_column($cars, 'car_order_sorts'); 
array_multisort($key_values, SORT_ASC, $cars);
$category=$this->category;
$vrc_tn=$this->vrc_tn;
$navig=$this->navig;

$currencysymb = VikRentCar::getCurrencySymb();

$pitemid = VikRequest::getString('Itemid', '', 'request');

if (is_array($category)) {
	?>
	<h3 class="vrcclistheadt"><?php echo $category['name']; ?></h3>
	<?php
	if (strlen($category['descr']) > 0) {
		?>
		<div class="vrccatdescr">
			<?php echo $category['descr']; ?>
		</div>
		<?php
	}
} else {
	echo VikRentCar::getFullFrontTitle($vrc_tn);
}

?>

<style type="text/css">
	.vrcmodcarsgridcontainer {
	width: 100%;
	display: inline-block;
}
div.vrcinf {
	float:left;
	padding:0 0 0 8px;
}
.vrcmodcarsgridhorizontal {
	list-style-type: none;
}
ul.vrcmodcarsgridhorizontal li {
	display:inline-block;
	margin:0;
	padding: 0;
	vertical-align: top;
}
ul.vrcmodcarsgridhorizontal li:last-child {
	margin:0;
}

ul.vrcmodcarsgridhorizontal li img {
	width:100%;	
}
ul.vrcmodcarsgridvertical {
	list-style-type: none;
}
.vrcmodcarsgrid-item-desc {
	margin: 10px 0;
	padding: 0 20px;
}
.vrcmodcarsgridboxdiv {
	width: 100%;
	display: inline-block;
	border:1px solid #ddd;
	background:#fff !important;
	transition: all 400ms ease-in-out 0s;
}
.vrcmodcarsgridboxdiv:hover {
	-ms-transform: scale(1.05,1.05); /* IE 9 */
    -webkit-transform: scale(1.05,1.05); /* Safari */
    transform: scale(1.05,1.05);
    transition: all 400ms ease-in-out 0s;
    background:#fff !important;
}
.vrcmodcarsgridvertical img.vrcmodcarsgridimg {
	max-width: 99% !important;
	float:none;
	clear:both;
	margin: 0 0 5px 0;
}
span.vrcmodcarsgridname {
	font-weight: bold;
	font-size:15px;
	color:#444;
}

.vrcmodcarsgridview {
    font-size: 13px;
    font-weight: bold;
    text-align: center;
    margin: 10px 0 0;
    padding-bottom:15px;
}
.vrcmodcarsgridview a {
	display: inline-block;
	padding:8px 25px;
	border-radius: 3px;
	background:#e7e7e7;
	text-transform: uppercase;
	font-size: 0.9em;
}

.vrcmodcarsgridcont-sorting {
    text-transform: uppercase;
    font-size: 16px;
    margin-bottom: 28px;
}
.vrcmodcarsgridcont-items {
	display: flex;
	flex-wrap: wrap;
	width: 100%;
}
.vrcmodcarsgridcont-item {
	padding:10px;
}
.vrcmodcarsgrid-item_details {
	text-align: center;
	padding-top:10px;
}
.vrcmodcarsgrid-item_title {
	font-size: 1.1em;
	font-weight: 600;
}
.vrcmodcarsgrid-item-btm {
	display: inline-block;
	width: 100%;
	border-top: 1px solid #eee;
	padding: 7px 10px;
	font-size: 0.8em;
	color: #999;
}
.vrcmodcarsgrid-item-btm > div {
	display: inline-block;
}
.vrcmodcarsgrid-item_cat {
	float: right;
}
.vrcmodcarsgrid-item_carat .vrccarcarat {
	display: inline-block;
	vertical-align: top;
	margin: 0 5px;
	font-size: 14px;
}
.vrc-modcars-grid-item figure {
	margin-bottom: 0;
}
.vrcmodcarsgrid-item_carat i {
	font-size: 16px;
}
.vrcmodcarsgridcontainer .owl-nav {
	text-align: center;
}
.vrcmodcarsgridcontainer  .vrcmodcarsgridcont-items .owl-nav > button.owl-prev, .vrcmodcarsgridcontainer  .vrcmodcarsgridcont-items .owl-nav > button.owl-next {
	display: inline-block;
	background: #eee;
	border:1px solid #ddd;
	padding: 2px 10px;
	margin: 3px;
	border-radius: 4px;
}
.vrcmodcarsgridcontainer .owl-nav > button.owl-prev:hover, .vrcmodcarsgridcontainer .owl-nav > button.owl-next:hover {
	background: #ddd;
}
.vrcmodcarsgridcontainer .owl-nav > button.owl-prev:active, .vrcmodcarsgridcontainer .owl-nav > button.owl-next:active {
	background: #ccc;
}
.vrcmodcarsgridcontainer .owl-nav > button.disabled {
	background: #f6f6f6;
}
.vrcmodcarsgridcontainer .owl-nav > button.disabled:active, .vrcmodcarsgridcontainer .owl-nav > button.disabled:hover {
	background: #f6f6f6;
}
.vrcmodcarsgridcontainer .owl-carousel .owl-dots {
	text-align: center;
}
.vrcmodcarsgridcontainer .owl-carousel .owl-dots .owl-dot {
    width: 10px;
    height: 10px;
    background: #ddd;
    border-radius: 50%;
    margin: 2px 4px;
}
.vrcmodcarsgridcontainer .vrcmodcarsgridcont-items .owl-carousel .owl-dots .owl-dot.active, .vrcmodcarsgridcontainer .owl-carousel .owl-dots .owl-dot.hover {
    background: #999;
}
@media only screen and (max-width: 980px) {
	.vrc-modcars-grid-item {
		width: 33% !important;
	}
}
@media only screen and (max-width: 740px) {
	.vrc-modcars-grid-item {
		width: 50% !important;
	}
}
@media only screen and (max-width: 600px) {
	.vrcmodcarsgridhorizontal .vrc-modcars-item {
		width: 100%;
	}
}
@media only screen and (max-width: 580px) {
	.vrc-modcars-grid-item {
		width: 100% !important;
	}
}

.vrcmodcarsgrid-item_title {    
	min-height: 75px;
    max-height: 75px;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -moz-box-orient: vertical;
    -ms-box-orient: vertical;
    box-orient: vertical;
    -webkit-line-clamp: 3;
    -moz-line-clamp: 3;
    -ms-line-clamp: 3;
    line-clamp: 3;
    overflow: hidden;
}

.vrcmodcarsgridboxdiv figcaption {
   font-size: 15px;
}

</style>
<!-- pagina de FLOTA /uploads/vikrentcar/overrides/site/carslist -->
<!-- <div class="vrc-search-results-block"> -->

	<div class="vrcmodcarsgridcontainer column-container container-fluid">
	<div class="vrcmodcarsgridcont-items vrcmodcarsgridhorizontal row-fluid">

<?php
foreach ($cars as $c) {
	$carats = VikRentCar::getCarCaratOriz($c['idcarat'], array(), $vrc_tn);
	$vcategory = VikRentCar::sayCategory($c['idcat'], $vrc_tn);

    $car_cost = VikRentCar::getLowestPriceToShowId($c);
	?>
	<div class="vrc-modcars-item vrc-modcars-grid-item" style="width: 25%;">
      <figure class="vrcmodcarsgridcont-item">
         <div class="vrcmodcarsgridboxdiv">
 			<?php
			if (!empty($c['img'])) {
				$imgpath = file_exists(VRC_ADMIN_PATH.DS.'resources'.DS.'vthumb_'.$c['img']) ? VRC_ADMIN_URI.'resources/vthumb_'.$c['img'] : VRC_ADMIN_URI.'resources/'.$c['img'];
				?>
				<a class="" href="<?php echo JRoute::_('index.php?option=com_vikrentcar&view=cardetails&carid='.$c['id'].(!empty($pitemid) ? '&Itemid='.$pitemid : '')); ?>">
					<img class="vrcmodcarsgridimg" alt="<?php echo $c['name']; ?>" src="<?php echo $imgpath; ?>"/>
				</a>
				<?php
			}
			?>
            <!-- <img src="<?php echo $imgpath; ?>" alt="<?php echo $getcar['name']; ?>" class="vrcmodcarsgridimg"> -->
            <div class="vrcmodcarsgrid-item_details">
               <figcaption class="vrcmodcarsgrid-item_title"><a href="<?php echo JRoute::_('index.php?option=com_vikrentcar&view=cardetails&carid='.$c['id'].(!empty($pitemid) ? '&Itemid='.$pitemid : '')); ?>"><?php echo $c['name']; ?></a></figcaption>
               <div class="vrcmodcarsgrid-box-cost">
                  <span class="vrcmodcarsgridstartfrom"><?php pll_e('Incepand de la'); ?></span>
<!--                  <span class="vrcmodcarsgridcarcost"><span class="vrc_price">--><?php //echo strlen($c['startfrom']) > 0 ? VikRentCar::numberFormat($c['startfrom']) : VikRentCar::numberFormat($c['cost']); ?><!--</span><span class="vrc_currency"> EUR + --><?php //pll_e('TVA'); ?><!--</span></span>-->
                  <span class="vrcmodcarsgridcarcost"><span class="vrc_price"><?php echo $car_cost; ?></span><span class="vrc_currency"> EUR + <?php pll_e('TVA'); ?></span></span>
                  <span class="vrcmodcarsgridstartfrom">/ <?php pll_e('zi'); ?></span>
                  <br>				
               </div>
            </div>
            <div class="vrcmodcarsgridview">
               <a class="btn vrc-pref-color-btn" href="<?php echo JRoute::_('index.php?option=com_vikrentcar&view=cardetails&carid='.$c['id'].(!empty($pitemid) ? '&Itemid='.$pitemid : '')); ?>"><?php echo JText::_('VRCLISTPICK'); ?></a>
            </div>
            <div class="vrcmodcarsgrid-item-btm">
            	<?php 
            	if (!empty($vcategory)) {
						?>
						<div class="vrcmodcarsgrid-item_cat"><?php echo $vcategory; ?></div>
						<?php
					}
					?>
					<?php
					if (!empty($carats)) {
						?>
						<div class="vrcmodcarsgrid-item_carat">
		                  <div class="vrccaratsdiv">
									<?php echo $carats; ?>
							</div>
						</div>
						<?php
					}
					?>
            </div>
         </div>
      </figure>
   </div>

	<!-- <div class="car_result">
		<div class="vrc-car-result-left">
		<?php
		if (!empty($c['img'])) {
			$imgpath = file_exists(VRC_ADMIN_PATH.DS.'resources'.DS.'vthumb_'.$c['img']) ? VRC_ADMIN_URI.'resources/vthumb_'.$c['img'] : VRC_ADMIN_URI.'resources/'.$c['img'];
			?>
			<a class="" href="<?php echo JRoute::_('index.php?option=com_vikrentcar&view=cardetails&carid='.$c['id'].(!empty($pitemid) ? '&Itemid='.$pitemid : '')); ?>">
				<img class="imgresult" alt="<?php echo $c['name']; ?>" src="<?php echo $imgpath; ?>"/>
			</a>
			<?php
		}
		?>
		</div>
		<div class="vrc-car-result-right">
			<div class="vrc-car-result-rightinner">
				<div class="vrc-car-result-rightinner-deep">
					<div class="vrc-car-result-inner">
						<h4 class="vrc-car-name extra-car-name-ft">
							<a href="<?php echo JRoute::_('index.php?option=com_vikrentcar&view=cardetails&carid='.$c['id'].(!empty($pitemid) ? '&Itemid='.$pitemid : '')); ?>"><?php echo $c['name']; ?></a>
						</h4>
					<?php
					if (strlen($vcategory)) {
						?>
						<div class="vrc-car-category"><?php echo $vcategory; ?></div>
						<?php
					}
					?>
				
						<?php
						if (!empty($carats)) {
							?>
							<div class="vrc-car-characteristics">
								<?php echo $carats; ?>
							</div>
							<?php
						} else {
							?>
							<div class="vrc-car-characteristics" style="min-height: 33px;">
								&nbsp;
							</div>
							<?php
						}
						?>
					</div>
					<div class="vrc-car-lastblock">
						<div class="vrc-car-price">
							<div class="vrcsrowpricediv 11111">
							<?php
							if (1 > 0) {
							?>
								<span class="vrcstartfrom"><?php echo JText::_('VRCLISTSFROM'); ?> 	<span class="car_cost"><span class="vrc_price"><?php echo strlen($c['startfrom']) > 0 ? VikRentCar::numberFormat($c['startfrom']) : VikRentCar::numberFormat($c['cost']); ?></span> <span class="vrc_currency">EUR </span></span>pe zi</span>
							
							<?php
							}
							?>
							</div>
						</div>
						<div class="vrc-car-bookingbtn test22">
							<span class="vrclistgoon"><a class="btn vrc-pref-color-btn" href="<?php echo JRoute::_('index.php?option=com_vikrentcar&view=cardetails&carid='.$c['id'].(!empty($pitemid) ? '&Itemid='.$pitemid : '')); ?>"><?php echo JText::_('VRCLISTPICK'); ?></a></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="car_separator"></div> -->
	<?php
}
?>
</div>
</div>

<?php
//pagination
if (strlen($navig) > 0) {
	?>
<div class="vrc-pagination"><?php echo $navig; ?></div>
	<?php
}

?>
<script type="text/javascript">
jQuery(document).ready(function() {
	if (jQuery('.car_result').length) {
		jQuery('.car_result').each(function() {
			var car_img = jQuery(this).find('.vrc-car-result-left').find('img');
			if (car_img.length) {
				//jQuery(this).find('.vrc-car-result-right').find('.vrc-car-result-rightinner').find('.vrc-car-result-rightinner-deep').find('.vrc-car-result-inner').css('min-height', car_img.height()+'px');
			}
		});
	};
});
</script>
<?php
VikRentCar::printTrackingCode();
?>