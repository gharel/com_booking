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

class BookingViewSubmit extends JViewLegacy {
	public $message;

	function display($tpl = null) {
		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JLog::add(implode('<br />', $errors), JLog::WARNING, 'jerror');

			return false;
		}

		// Display the view
		parent::display($tpl);
	}
}