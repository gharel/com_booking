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
	public function __construct($config = array()) {
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
				'b.firstname',
				'b.idRoom',
				'b.startDate',
				'b.id'
			);
		}

		parent::__construct($config);
	}

	protected function populateState($ordering = 'b.id', $direction = 'desc') {
		$app = JFactory::getApplication();

		$forcedLanguage = $app->input->get('forcedLanguage', '', 'cmd');

		// Adjust the context to support modal layouts.
		if ($layout = $app->input->get('layout')) {
			$this->context .= '.' . $layout;
		}

		// Adjust the context to support forced languages.
		if ($forcedLanguage) {
			$this->context .= '.' . $forcedLanguage;
		}

		$search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		// List state information.
		parent::populateState($ordering, $direction);
	}

	protected function getStoreId($id = '') {
		// Compile the store id.
		$id .= ':' . $this->getState('filter.search');

		return parent::getStoreId($id);
	}

	protected function getListQuery() {
		// Initialize variables.
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		// Create the base select statement.
		$query->select('b.id, b.firstname, b.lastname, b.email, b.phone, b.startDate, b.endDate, b.idRoom, br.name, br.space, br.price, br.published');
		$query->from($db->quoteName('#__booking', 'b'));
		$query->join('LEFT', $db->quoteName('#__booking_room', 'br') . ' ON (' . $db->quoteName('b.idRoom') . ' = ' . $db->quoteName('br.id') . ')');

		// Filter: like / search
		$search = $this->getState('filter.search');

		if (!empty($search)) {
			$like = $db->quote('%' . $search . '%');
			$query->where('firstname LIKE ' . $like . ' OR lastname LIKE ' . $like . ' OR email LIKE ' . $like);
		}

		// Add the list ordering clause.
		$orderCol  = $this->state->get('list.ordering', 'b.id');
		$orderDirn = $this->state->get('list.direction', 'DESC');

		$query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));

		return $query;
	}
}