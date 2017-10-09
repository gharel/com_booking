<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_booking
 *
 * @copyright   Copyright (C) 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// Get an instance of the controller
$controller = JControllerLegacy::getInstance('Booking');

// Perform the request task
$controller->execute(JFactory::getApplication()->input->get('task'));

// Access check: is this user allowed to access the backend of this component?
if (!JFactory::getUser()->authorise('core.manage', 'com_booking')) {
	throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'));
}

// Redirect if set by the controller
$controller->redirect();