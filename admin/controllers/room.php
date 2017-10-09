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

class BookingControllerRoom extends JControllerForm {
	protected function allowAdd($data = array()) {
		return parent::allowAdd($data);
	}

	protected function allowEdit($data = array(), $key = 'id') {
		$id = isset($data[$key]) ? $data[$key] : 0;
		if (!empty($id)) {
			return JFactory::getUser()->authorise("core.edit", "com_booking.room." . $id);
		}
	}
}