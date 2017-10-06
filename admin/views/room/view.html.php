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

class BookingViewRoom extends JViewLegacy {
	protected $form = null;

	public function display($tpl = null) {
		// Get the Data
		$this->form   = $this->get('Form');
		$this->item   = $this->get('Item');
		$this->script = $this->get('Script');

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

		BookingHelper::addSubmenu('rooms');

		// Set the sidebar
		$this->sidebar = JHtmlSidebar::render();

		$input = JFactory::getApplication()->input;

		// Hide Joomla Administrator Main menu
		$input->set('hidemainmenu', true);

		$isNew = ($this->item->id == 0);

		if ($isNew) {
			$title = JText::_('COM_BOOKING_ADMIN_LIST_NEW');
		} else {
			$title = JText::_('COM_BOOKING_ADMIN_LIST_EDIT');
		}

		JToolbarHelper::title($title);
		JToolbarHelper::apply('room.apply');
		JToolbarHelper::save('room.save');
		JToolbarHelper::save2new('room.save2new');
		JToolbarHelper::cancel('room.cancel', $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE');
	}

	protected function setDocument() {
		$isNew    = ($this->item->id < 1);
		$document = JFactory::getDocument();
		$document->setTitle($isNew ? JText::_('COM_BOOKING_ADMIN_LIST_NEW') : JText::_('COM_BOOKING_ADMIN_LIST_EDIT'));
		$document->addScript(JURI::root() . $this->script);
		$document->addScript(JURI::root() . "/administrator/components/com_booking" . "/views/booking/submitbutton.js");
		JText::script('COM_BOOKING_ERROR_FORM_INVALID');
	}
}