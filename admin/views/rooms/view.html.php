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

class BookingViewRooms extends JViewLegacy {
	public function display($tpl = null) {
		$this->items         = $this->get('Items');
		$this->pagination    = $this->get('Pagination');
		$this->state         = $this->get('State');
		$this->filterForm    = $this->get('FilterForm');
		$this->activeFilters = $this->get('ActiveFilters');

		// What Access Permissions does this user have? What can (s)he do?
		$this->canDo = BookingHelper::getActions();

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode('<br />', $errors));

			return false;
		}

		// Set the toolbar and number of found items
		$this->addToolBar();

		// Display the template
		parent::display($tpl);

		// Set the document
		$this->setDocument();
	}

	protected function addToolBar() {
		require_once JPATH_COMPONENT . '/helpers/booking.php';

		BookingHelper::addSubmenu('rooms');

		// Set the sidebar
		$this->sidebar = JHtmlSidebar::render();

		$title = JText::_('COM_BOOKING_ADMIN_LIST_ROOM_TITLE');

		if ($this->pagination->total) {
			$title .= " <span style='font-size: 0.5em; vertical-align: middle;'>(" . $this->pagination->total . ")</span>";
		}

		JToolBarHelper::title($title);

		if ($this->canDo->get('core.create')) {
			JToolBarHelper::addNew('room.add', 'JTOOLBAR_NEW');
		}
		if ($this->canDo->get('core.edit')) {
			JToolBarHelper::editList('room.edit', 'JTOOLBAR_EDIT');
		}
		if ($this->canDo->get('core.delete')) {
			JToolbarHelper::publish('rooms.publish', 'JTOOLBAR_PUBLISH', true);
			JToolbarHelper::unpublish('rooms.unpublish', 'JTOOLBAR_UNPUBLISH', true);
			JToolBarHelper::deleteList('', 'rooms.delete', 'JTOOLBAR_DELETE');
		}
		if ($this->canDo->get('core.admin')) {
			JToolBarHelper::divider();
			JToolBarHelper::preferences('com_booking');
		}
	}

	protected function getSortFields() {
		return array(
			'published' => JText::_('COM_BOOKING_ADMIN_LIST_ROOM_PUBLISHED'),
			'name'      => JText::_('COM_BOOKING_ADMIN_LIST_ROOM_NAME'),
			'space'     => JText::_('COM_BOOKING_ADMIN_LIST_ROOM_SPACE'),
			'price'     => JText::_('COM_BOOKING_ADMIN_LIST_ROOM_PRICE'),
			'id'        => JText::_('COM_BOOKING_ADMIN_LIST_ROOM_ID')
		);
	}

	protected function setDocument() {
		$document = JFactory::getDocument();
		$document->setTitle(JText::_('COM_BOOKING_ADMIN'));
	}
}