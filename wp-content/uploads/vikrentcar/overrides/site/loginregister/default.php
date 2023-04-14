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

$priceid = $this->priceid;
$place = $this->place;
$returnplace = $this->returnplace;
$carid = $this->carid;
$days = $this->days;
$pickup = $this->pickup;
$release = $this->release;
$copts = $this->copts;

$action = 'index.php?option=com_user&amp;task=login';
$vrc_app = VikRentCar::getVrcApplication();
$pitemid = VikRequest::getString('Itemid', '', 'request');

if (!empty($carid) && !empty($pickup) && !empty($release)) {
	$chosenopts = "";
	if (is_array($copts) && @count($copts) > 0) {
		foreach($copts as $idopt => $quanopt) {
			$chosenopts .= "&optid".$idopt."=".$quanopt;
		}
	}
	$goto = "index.php?option=com_vikrentcar&task=oconfirm&priceid=".$priceid."&place=".$place."&returnplace=".$returnplace."&carid=".$carid."&days=".$days."&pickup=".$pickup."&release=".$release.(!empty($chosenopts) ? $chosenopts : "").(!empty($pitemid) ? "&Itemid=".$pitemid : "");
	/**
	 * @wponly 	no need to use VikRentCar::getLoginReturnUrl() or we would get a double protocol.
	 */
	$goto = JRoute::_($goto, false);
} else {
	//User Reservations page
	$goto = "index.php?option=com_vikrentcar&view=userorders".(!empty($pitemid) ? "&Itemid=".$pitemid : "");
	$goto = JRoute::_($goto, false);
}

$return_url = base64_encode($goto);

?>

<script language="JavaScript" type="text/javascript">
function checkVrcReg() {
	var vrvar = document.vrcreg;
	if (!vrvar.name.value.match(/\S/)) {
		document.getElementById('vrcfname').style.color='#ff0000';
		return false;
	} else {
		document.getElementById('vrcfname').style.color='';
	}
	if (!vrvar.lname.value.match(/\S/)) {
		document.getElementById('vrcflname').style.color='#ff0000';
		return false;
	} else {
		document.getElementById('vrcflname').style.color='';
	}
	if (!vrvar.email.value.match(/\S/)) {
		document.getElementById('vrcfemail').style.color='#ff0000';
		return false;
	} else {
		document.getElementById('vrcfemail').style.color='';
	}
	if (!vrvar.username.value.match(/\S/)) {
		document.getElementById('vrcfusername').style.color='#ff0000';
		return false;
	} else {
		document.getElementById('vrcfusername').style.color='';
	}
	if (!vrvar.password.value.match(/\S/)) {
		document.getElementById('vrcfpassword').style.color='#ff0000';
		return false;
	} else {
		document.getElementById('vrcfpassword').style.color='';
	}
	if (!vrvar.confpassword.value.match(/\S/)) {
		document.getElementById('vrcfconfpassword').style.color='#ff0000';
		return false;
	} else {
		document.getElementById('vrcfconfpassword').style.color='';
	}
	return true;
}
</script>

<div class="loginregistercont">
		
	<div class="vrc-logreg-cnt vrc-reg-box">
	<form action="<?php echo JRoute::_('index.php?option=com_vikrentcar'.(!empty($pitemid) ? '&Itemid='.$pitemid : '')); ?>" method="post" name="vrcreg" onsubmit="return checkVrcReg();">
	<h3><?php echo JText::_('VRREGSIGNUP'); ?></h3>
	<div class="vrc-logreg-cnt-inner">
		<div>
			<div class="vrc-logreg-lbl"><span id="vrcfname"><?php echo JText::_('VRREGNAME'); ?></span></div>
			<div class="intcnt-bar"><input type="text" name="name" value="" size="20" class="vrcinput"/></div>
		</div>
		<div>
			<div class="vrc-logreg-lbl"><span id="vrcflname"><?php echo JText::_('VRREGLNAME'); ?></span></div>
			<div class="intcnt-bar"><input type="text" name="lname" value="" size="20" class="vrcinput"/></div>
		</div>
		<div>
			<div class="vrc-logreg-lbl"><span id="vrcfemail"><?php echo JText::_('VRREGEMAIL'); ?></span></div>
			<div class="intcnt-bar"><input type="text" name="email" value="" size="20" class="vrcinput"/></div>
		</div>
		<div>
			<div class="vrc-logreg-lbl"><span id="vrcfusername"><?php echo JText::_('VRREGUNAME'); ?></span></div>
			<div class="intcnt-bar"><input type="text" name="username" value="" size="20" class="vrcinput"/></div>
		</div>
		<div>
			<div class="vrc-logreg-lbl"><span id="vrcfpassword"><?php echo JText::_('VRREGPWD'); ?></span></div>
			<div class="intcnt-bar"><input type="password" name="password" value="" size="20" class="vrcinput"/></div>
		</div>
		<div>
			<div class="vrc-logreg-lbl"><span id="vrcfconfpassword"><?php echo JText::_('VRREGCONFIRMPWD'); ?></span></div>
			<div class="intcnt-bar"><input type="password" name="confpassword" value="" size="20" class="vrcinput"/></div>
		</div>
	<?php
	if ($vrc_app->isCaptcha()) {
		?>
		<div><div class="vrc-logreg-captcha"><?php echo $vrc_app->reCaptcha(); ?></div></div>
		<?php
	}
	?>
		<div><input type="submit" value="<?php echo JText::_('VRREGSIGNUPBTN'); ?>" class="btn" name="submit" /></div>
	</div>
	<input type="hidden" name="priceid" value="<?php echo $priceid; ?>" />
	<input type="hidden" name="place" value="<?php echo $place; ?>" />
	<input type="hidden" name="returnplace" value="<?php echo $returnplace; ?>" />
	<input type="hidden" name="carid" value="<?php echo $carid; ?>" />
	<input type="hidden" name="days" value="<?php echo $days; ?>" />
	<input type="hidden" name="pickup" value="<?php echo $pickup; ?>" />
	<input type="hidden" name="release" value="<?php echo $release; ?>" />
	<?php
	if (is_array($copts) && @count($copts) > 0) {
		foreach($copts as $idopt => $quanopt) {
			?>
	<input type="hidden" name="optid<?php echo $idopt; ?>" value="<?php echo $quanopt; ?>" />
			<?php
		}
	}
	?>
	<input type="hidden" name="Itemid" value="<?php echo $pitemid; ?>" />
	<input type="hidden" name="option" value="com_vikrentcar" />
	<input type="hidden" name="task" value="register" />
	</form>
	</div>

<?php

/**
 * @wponly 	use WP login form (change login and password names: "log" and "pwd")
 */
$url = wp_login_url(base64_decode($return_url));
$url .= (strpos($url, '?') !== false ? '&' : '?') . 'action=login';

?>

	<div class="vrc-logreg-cnt vrc-login-box">
	<form action="<?php echo $url; ?>" method="post">
	<h3><?php echo JText::_('VRREGSIGNIN'); ?></h3>
	<div class="vrc-logreg-cnt-inner">
		<div>
			<div class="vrc-logreg-lbl"><?php echo JText::_('VRREGUNAME'); ?></div>
			<div class="intcnt-bar"><input type="text" name="log" value="" size="20" class="vrcinput"/></div>
		</div>
		<div>
			<div class="vrc-logreg-lbl"><?php echo JText::_('VRREGPWD'); ?></div>
			<div class="intcnt-bar"><input type="password" name="pwd" value="" size="20" class="vrcinput"/></div>
		</div>
		<div>
			<input type="submit" value="<?php echo JText::_('VRREGSIGNINBTN'); ?>" class="btn" name="Login" />
		</div>
	</div>
	<input type="hidden" name="remember" id="remember" value="yes" />
	<?php echo JHtml::_('form.token'); ?>
	</form>
	</div>
</div>
<?php
VikRentCar::printTrackingCode();
