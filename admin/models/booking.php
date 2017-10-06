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

class BookingModelBooking extends JModelList {
	protected function getListQuery() {
		// Initialize variables.
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		// Create the base select statement.
		$query->select('b.id, b.firstname, b.lastname, b.email, b.phone, b.startDate, b.endDate, br.name, br.space, br.price, br.published');
		$query->from($db->quoteName('#__booking', 'b'));
		$query->join('LEFT', $db->quoteName('#__booking_room', 'br') . ' ON (' . $db->quoteName('b.idRoom') . ' = ' . $db->quoteName('br.id') . ')');
		$query->order($db->quoteName('b.id') . ' ASC');

		return $query;
	}
}