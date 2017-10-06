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
		$this->items      = $this->get('Items');
		$this->pagination = $this->get('Pagination');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode('<br />', $errors));

			return false;
		}

		// Set the toolbar
		$this->addToolBar();

		// Display the template
		parent::display($tpl);
	}

	protected function addToolBar() {
		require_once JPATH_COMPONENT . '/helpers/booking.php';

		BookingHelper::addSubmenu();

		// Set the sidebar
		$this->sidebar = JHtmlSidebar::render();

		JToolbarHelper::title(JText::_('COM_BOOKING_ADMIN_LIST_BOOKING_TITLE'));
	}
}