<?php
/**
 * @package     thor_hospedaje
 * @subpackage  mod_th_countries
 * 
 * @version		$Id: default.php 2013-07-27
 * @copyright	Copyright (C) 2013 Leonardo Alviarez - Edén Arreaza. All Rights Reserved.
 * @license		GNU General Public License version 3, or later
 * @note		Note : All ini files need to be saved as UTF-8 - No BOM
 */

defined('_JEXEC') or die;
JHtml::_('behavior.framework');
JHtml::_('bootstrap.framework');
$document = JFactory::getDocument();
$document->addStyleSheet('media/mod_th_states/css/mod_th_states.css');
$document->addScript('media/mod_th_states/js/jquery.ThreeDots.min.js');
$document->addScriptDeclaration('
jQuery(document).ready(function(){
    jQuery(window).on("resize", function () {

    var w = jQuery("[id^=th-state-image]").outerWidth(true);
    var h = jQuery("[id^=th-state-image]").outerHeight(true);
    
    jQuery("[id^=th-state-text]").height(h);

	}).resize();
    
	jQuery(".ellipsis").ThreeDots();
}); 
');

$rowCount = (int) $params->get('rowcount', 2);
$itemRow = (int) $params->get('itemrow', 2);
$itemWidth = (int) $params->get('itemwidth', 47);
$listArticles = explode(",",$params->get('idArticle', 0));
$idArticle = 0;
?>
<?php /* Falta agregar y probar el uso de la clase que el usuario pasa por parametro */ ?>
<div class="mod_th_states">
	<div class="row-fluid">
		<p><?php echo nl2br($mod_th_states_description); ?></p>
	</div>
	<?php
	$count = 0;
	for ($i = $count;  $i < count($list); $i++):
		if (isset($list[$count])): 
	?>		<div class="row-fluid">
			<?php
			for ($j = 0; $j < $itemRow; $j++):
				if (isset($list[$count])):
					$item = $list[$count];
			?>
			<?php 
					if (isset($listArticles[$count + $offset ]) && $listArticles[$count + $offset] != " "): 
			?>
			<a href="index.php?option=com_content&view=article&id=<?php echo $listArticles[$count + $offset]; ?>&id_country=<?php echo $item->id; ?>">
			<?php 
					else: 
			?>
			<a href="#">
			<?php 
					endif; 
			?>
			<div class="country-item" style="width: <?php echo $itemWidth; ?>%;">
				<div id="th-country-image-<?php echo $count;?>" class="country-image">
					<img src="<?php echo $item->image?>">
				</div>
				<div id="th-state-text-<?php echo $count;?>" class="state-text">
					<h1><?php echo $item->state_name; ?></h1>
					<div class="ellipsis"><span class="ellipsis_text"><?php echo $item->state_desc; ?></span></div>
				</div>
			</div>
			<?php
					$count++;
				endif;
			endfor;
			?>
			</div>
		<?php
		endif;
		?>
	<?php 
	endfor; 
	?>
</div>
<?php echo $pagination->getListFooter(); ?>
