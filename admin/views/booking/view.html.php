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

class BookingViewBooking extends JViewLegacy {
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

		// Set the toolbar
		$this->addToolBar();

		// Display the template
		parent::display($tpl);

		// Set the document
		$this->setDocument();
	}

	protected function addToolBar() {
		require_once JPATH_COMPONENT . '/helpers/booking.php';

		BookingHelper::addSubmenu();

		// Set the sidebar
		$this->sidebar = JHtmlSidebar::render();

		$title = JText::_('COM_BOOKING_ADMIN_LIST_BOOKING_TITLE');

		if ($this->pagination->total) {
			$title .= " <span style='font-size: 0.5em; vertical-align: middle;'>(" . $this->pagination->total . ")</span>";
		}

		JToolBarHelper::title($title);

		if ($this->canDo->get('core.admin')) {
			JToolBarHelper::divider();
			JToolBarHelper::preferences('com_booking');
		}
	}

	protected function getSortFields() {
		return array(
			'b.firstname' => JText::_('COM_BOOKING_ADMIN_LIST_BOOKING_FIRSTNAME'),
			'b.idRoom'    => JText::_('COM_BOOKING_ADMIN_LIST_BOOKING_ROOM'),
			'b.startDate' => JText::_('COM_BOOKING_ADMIN_LIST_BOOKING_STARTDATE'),
			'b.id'        => JText::_('COM_BOOKING_ADMIN_LIST_ROOM_ID')
		);
	}

	protected function setDocument() {
		$document = JFactory::getDocument();
		$document->setTitle(JText::_('COM_BOOKING_ADMIN'));
	}
}