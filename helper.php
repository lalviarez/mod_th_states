<?php
/**
 * @package     thor_hospedaje
 * @subpackage  mod_th_states
 * 
 * @version		$Id: helper.php 2013-07-31
 * @copyright	Copyright (C) 2013 Leonardo Alviarez - Edén Arreaza. All Rights Reserved.
 * @license		GNU General Public License version 3, or later
 * @note		Note : All ini files need to be saved as UTF-8 - No BOM
 */

defined('_JEXEC') or die;

JModelLegacy::addIncludePath(JPATH_SITE . '/components/com_thorhospedaje/models', 'ThorHospedajeModel');

class modTHStatesHelper
{
	public static function getList($params)
	{
		$model = JModelLegacy::getInstance('States', 'ThorHospedajeModel', array('ignore_request' => true));
		
		// Set application parameters in model
		$app = JFactory::getApplication();
		$appParams = $app->getParams();
		$model->setState('params', $appParams);
		
		$model->setState('list.select', 'a.id, a.state_name, a.state_desc, a.image, a.ordering');
		
		// Filter by state of publicated
		$model->setState('filter.state', 1);

		// Filter by language
		$model->setState('filter.language', $app->getLanguageFilter());
		
		// Filter by Country
		$id_country	= $app->input->getInt('id_country');
		$model->setState('filter.id_country', $id_country);
		
		// Ordering
		$model->setState('ordering', 'ordering');
		$ordering = $params->get('ordering', 'ordering');
		$model->setState('list.ordering', $ordering == 'order' ? 'ordering' : $ordering);
		$model->setState('list.direction', $params->get('direction', 'asc'));
		
		// Set the limits for pagination
		//$model->setState('list.start', 0);
		$limitstart = $app->input->get('limitstart', 0, 'uint');
		$model->setState('list.start', $limitstart);
		$countItems = (int) ($params->get('rowcount', 2) * $params->get('itemrow', 2));
		$model->setState('list.limit', $countItems);
		
		$data['list'] = $model->getItems();
		$data['pagination'] = $model->getPagination();
		
		return $data;
	}
}
