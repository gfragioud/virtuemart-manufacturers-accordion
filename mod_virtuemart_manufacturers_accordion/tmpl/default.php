<?php // no direct access
defined('_JEXEC') or die('Restricted access');
$col= 1 ;
$mod_url = JURI::root().'modules/mod_virtuemart_manufacturers_accordion/';
?>

<script type="text/javascript">//<![CDATA[
		document.write('<link href="<?php echo $mod_url;?>css/styles.css" rel="stylesheet" type="text/css" media="screen" />');
	//]]></script>

<div class="vmmanufacturers<?php echo $params->get( 'moduleclass_sfx' ) ?>">

<?php if ($headerText) : ?>
	<script>
	function expand_manufacturers(){
		const elem = document.getElementsByClassName("vmmanufacturers")[0],
			  icon = document.getElementsByClassName("icon-double-angle-right")[0];
		const arr = elem.className.split(" ");
		if (arr.indexOf("vmmanufacturers-expanded") == -1) {
			elem.className += " " + "vmmanufacturers-expanded";
			icon.className += " " + "icon-rotate-90";
		} else {
			elem.className = elem.className.replace("vmmanufacturers-expanded", "");
			icon.className = icon.className.replace("icon-rotate-90", "");
		}
	}
	</script>
	<div class="vmmanufacturer_header" onclick="expand_manufacturers()"><?php echo $headerText ?><i class="icon-double-angle-right"></i></div>
<?php endif;
if ($display_style =="div") { ?>
	<div class="vmmanufacturer<?php echo $params->get('moduleclass_sfx'); ?>">
	<?php foreach ($manufacturers as $manufacturer) {
		$link = JROUTE::_('index.php?option=com_virtuemart&view=category&virtuemart_manufacturer_id=' . $manufacturer->virtuemart_manufacturer_id);
		$link_segments = explode('/', $link);
		$link = '/search/no-category/' . $link_segments[sizeof($link_segments)-1];
		?>
		<div>
			<a href="<?php echo $link; ?>">
		<?php
		if ($manufacturer->images && ($show == 'image' or $show == 'all' )) { ?>
			<?php echo $manufacturer->images[0]->displayMediaThumb('',false);?>
		<?php
		}
		if ($show == 'text' or $show == 'all' ) { ?>
		 <div><?php echo $manufacturer->mf_name; ?></div>
		<?php
		} ?>
			</a>
		</div>
		<?php
		if ($col == $manufacturers_per_row) {
			echo "</div><div class=\"vmmanufacturer" . $params->get('moduleclass_sfx') . "\">";
			$col= 1 ;
		} else {
			$col++;
		}
	} ?>
	</div>
	<br />

<?php
} else {
	$last = count($manufacturers)-1;
?>

<ul class="vmmanufacturer<?php echo $params->get('moduleclass_sfx'); ?>">
<?php
foreach ($manufacturers as $manufacturer) {
	$link = JROUTE::_('index.php?option=com_virtuemart&view=manufacturer&virtuemart_manufacturer_id=' . $manufacturer->virtuemart_manufacturer_id);
	?>
	<li><a href="<?php echo $link; ?>">
		<?php
		if ($manufacturer->images && ($show == 'image' or $show == 'all' )) { ?>
			<?php echo $manufacturer->images[0]->displayMediaThumb('',false);?>
		<?php
		}
		if ($show == 'text' or $show == 'all' ) { ?>
		 <div><?php echo $manufacturer->mf_name; ?></div>
		<?php
		}
		?>
		</a>
	</li>
	<?php
	if ($col == $manufacturers_per_row && $manufacturers_per_row && $last) {
		echo '</ul><ul class="vmmanufacturer'.$params->get('moduleclass_sfx').'">';
		$col= 1 ;
	} else {
		$col++;
	}
	$last--;
} ?>
</ul>

<?php }
	if ($footerText) : ?>
	<div class="vmfooter<?php echo $params->get( 'moduleclass_sfx' ) ?>">
		 <?php echo $footerText ?>
	</div>
<?php endif; ?>
</div>
