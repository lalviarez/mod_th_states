<?php

/**
 * @package     thor_hospedaje
 * @subpackage  mod_th_states
 * 
 * @version		$Id: mod_th_states.php 2013-07-31
 * @copyright	Copyright (C) 2013 Leonardo Alviarez - Edén Arreaza. All Rights Reserved.
 * @license		GNU General Public License version 3, or later
 * @note		Note : All ini files need to be saved as UTF-8 - No BOM
 */
 
defined('_JEXEC') or die;

// Include the mod_th_states functions only once
require_once __DIR__ . '/helper.php';

$data = modTHStatesHelper::getList($params);

if (!count($data))
{
	return;
}

$list = $data['list'];
$pagination = $data['pagination'];
$mod_th_states_description = htmlspecialchars($params->get('mod_th_states_description'));

require JModuleHelper::getLayoutPath('mod_th_states', $params->get('layout', 'default'));
