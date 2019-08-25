<?php
/* @package Joomla
 * @copyright Copyright (C) Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * @extension Phoca Extension
 * @copyright Copyright (C) Jan Pavelka www.phoca.cz
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

defined('_JEXEC') or die;// no direct access

if (!JComponentHelper::isEnabled('com_phocacart', true)) {
	$app = JFactory::getApplication();
	$app->enqueueMessage(JText::_('Phoca Cart Error'), JText::_('Phoca Cart is not installed on your system'), 'error');
	return;
}

$document	= JFactory::getDocument();

JLoader::registerPrefix('Phocacart', JPATH_ADMINISTRATOR . '/components/com_phocacart/libraries/phocacart');

$lang = JFactory::getLanguage();
//$lang->load('com_phocacart.sys');
$lang->load('com_phocacart');

$media = new PhocacartRenderMedia();
$media->loadBase();
$media->loadBootstrap();
$media->loadSpec();
JHtml::stylesheet('media/mod_phocacart_mega_menu_content/css/style.css');
$s = PhocacartRenderStyle::getStyles();

$pCom						= PhocacartUtils::getComponentParameters();
$pc['display_webp_images']	= $pCom->get( 'display_webp_images', 0 );


$p['type']					= $params->get( 'type', 1 );
$p['ordering']				= $params->get( 'ordering', 1 );
$p['columns']				= $params->get( 'columns', 3 );
$p['items']					= $params->get( 'items', 3 );
$p['display_title']			= $params->get( 'display_title', 1 );
$p['display_link']			= $params->get( 'display_link', 1 );
$p['display_image']			= $params->get( 'display_image', 1 );
$p['display_desc']			= $params->get( 'display_desc', 1 );
$p['display_subcategories']	= $params->get( 'display_subcategories', 1 );
$moduleclass_sfx 			= htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8');


$categories		= array();
$manufacturers	= array();

$filter_language	= $params->get( 'filter_language', 0 );
	$language = '';
	if ($filter_language == 1) {
		//$lang 		= JFactory::getLanguage();
		$language	= $lang->getTag();
	}

if ($p['type'] == 1) {
	$display_categories = $params->get('display_categories', '');
	$hide_categories 	= $params->get('hide_categories', '');

	if (!empty($display_categories)) {
		$display_categories = implode(',', $display_categories);
	}
	if (!empty($hide_categories)) {
		$hide_categories = implode(',', $hide_categories);
	}

	$categories 		= PhocacartCategory::getCategoryTreeArray($p['ordering'], $display_categories, $hide_categories, array(0 ,1), $language);

} else if ($p['type'] == 2) {

	$manufacturers = PhocacartManufacturer::getAllManufacturers($p['ordering'], 0, $language);
}

require(JModuleHelper::getLayoutPath('mod_phocacart_mega_menu_content'));
?>
