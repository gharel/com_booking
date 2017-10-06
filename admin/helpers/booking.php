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

class BookingHelper extends JHelperContent {
	public static function addSubmenu($vName = 'booking') {
		JHtmlSidebar::addEntry('Booking', 'index.php?option=com_booking&view=booking', $vName == 'booking');
		JHtmlSidebar::addEntry('Rooms', 'index.php?option=com_booking&view=rooms', $vName == 'rooms');
	}
}