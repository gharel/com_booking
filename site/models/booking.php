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

class BookingModelBooking extends JModelForm {
	protected $list;

	public function getForm($data = array(), $loadData = true) {
		// Get the form.
		$form = $this->loadForm('com_booking.booking', 'booking', array('control' => 'jform', 'load_data' => $loadData));

		if (empty($form)) {
			return false;
		}

		return $form;
	}

	public function getRooms() {
		if (!isset($this->list)) {
			// Get a db connection.
			$db = JFactory::getDbo();

			// Create a new query object.
			$query = $db->getQuery(true);

			// Select all records from the rooms table.
			$query->select($db->quoteName(array('id', 'name', 'space', 'price', 'published')));
			$query->from($db->quoteName('#__booking_room'));
			$query->where($db->quoteName('published')." = 1");

			// Reset the query using our newly populated query object.
			$db->setQuery($query);

			// Load the results as a list of stdClass objects (see later for more options on retrieving data).
			$rooms = $db->loadObjectList();

			$options = array();

			if ($rooms) {
				foreach ($rooms as $room) {
					$options[] = (object) ['value' => $room->id, 'text' => "{$room->name} " . JText::_('COM_BOOKING_SITE_ROOM_FOR') . " {$room->space} " . JText::_('COM_BOOKING_SITE_ROOM_AT') . " {$room->price}" . JText::_('COM_BOOKING_SITE_ROOM_CURRENCY')];
				}
			}

			$this->list = JHtml::_('select.radiolist', $options, 'jform[room]');
		}

		return $this->list;
	}

	public function getRoom($id) {
		// Get a db connection.
		$db = JFactory::getDbo();

		// Create a new query object.
		$query = $db->getQuery(true);

		// Select all records from the rooms table.
		$query->select($db->quoteName(array('id', 'name', 'space', 'price', 'published')));
		$query->from($db->quoteName('#__booking_room'));
		$query->where($db->quoteName('id')." = ".$db->quote($id));
		$query->where($db->quoteName('published')." = 1");

		// Reset the query using our newly populated query object.
		$db->setQuery($query);

		// Load the result.
		$room = $db->loadAssoc();

		return $room;
	}

	public function setBooking($post) {
		try {
			// Get a db connection.
			$db = JFactory::getDbo();

			// Create a new query object.
			$query = $db->getQuery(true);

			// Insert columns.
			$columns = array('firstname', 'lastname', 'email', 'phone', 'startDate', 'EndDate', 'idRoom');

			// Insert values.
			$values = array($db->quote($post['firstname']), $db->quote($post['lastname']), $db->quote($post['email']), $db->quote($post['phone']), $db->quote($post['startdate']), $db->quote($post['enddate']), (int) $post['room']);

			// Prepare the insert query.
			$query->insert($db->quoteName('#__booking'))->columns($db->quoteName($columns))->values(implode(',', $values));

			// Set the query using our newly populated query object and execute it.
			$db->setQuery($query);
			$db->execute();

			$success = true;
		} catch (Exception $e) {
			$success = false;
		}

		return $success;
	}
}