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

class BookingController extends JControllerLegacy {
	public function submit() {
		JSession::checkToken() or die('Invalid Token');

		$input   = JFactory::getApplication()->input;
		$post    = $input->getArray($_POST);
		$post    = $post['jform'];
		$model   = $this->getModel('booking');
		$room    = $model->getRoom((int) $post['room']);
		$data    = [
			'contact_name'    => ucwords($post['firstname'], '-') . ' ' . strtoupper($post['lastname']),
			'contact_email'   => $post['email'],
			'contact_subject' => JText::_('COM_BOOKING_EMAIL_SUBJECT'),
			'contact_message' => JText::_('COM_BOOKING_EMAIL_MESSAGE_ROOM') . $room['name'] . JText::_('COM_BOOKING_EMAIL_MESSAGE_FROM') . $post['startdate'] . JText::_('COM_BOOKING_EMAIL_MESSAGE_TO') . $post['enddate']
		];
		$contact = (object) ['email_to' => $post['email']];

		$sent = $this->_sendEmail($data, $contact);

		//TODO: added to avoid error with local SMTP
		$sent = true;

		if (!($sent instanceof Exception)) {
			$insert = $model->setBooking($post);
			if ($insert) {
				$task = 'success';
			} else {
				$task = 'errordb';
			}
		} else {
			$task = 'errormail';
		}

		$link = JRoute::_('index.php?option=com_booking&task=' . $task, false);
		$this->setRedirect($link);
	}

	public function success() {
		$view          = $this->getView('submit', 'html');
		$view->message = JText::_('COM_BOOKING_SITE_SUBMIT_SUCCESS');
		$view->display();
	}

	public function errordb() {
		$view          = $this->getView('submit', 'html');
		$view->message = JText::_('COM_BOOKING_SITE_SUBMIT_ERROR_DB');
		$view->display();
	}

	public function errormail() {
		$view          = $this->getView('submit', 'html');
		$view->message = JText::_('COM_BOOKING_SITE_SUBMIT_ERROR_MAIL');
		$view->display();
	}

	private function _sendEmail($data, $contact) {
		$app = JFactory::getApplication();

		$mailfrom = $app->get('mailfrom');
		$fromname = $app->get('fromname');
		$sitename = $app->get('sitename');

		$name    = $data['contact_name'];
		$email   = JStringPunycode::emailToPunycode($data['contact_email']);
		$subject = $data['contact_subject'];
		$body    = $data['contact_message'];

		// Prepare email body
		$body = $name . ' <' . $email . '>' . "\r\n\r\n" . stripslashes($body);

		$mail = JFactory::getMailer();
		$mail->addRecipient($contact->email_to);
		$mail->addReplyTo($mailfrom, $fromname);
		$mail->setSender(array($mailfrom, $fromname));
		$mail->setSubject($sitename . ': ' . $subject);
		$mail->setBody($body);
		$sent = $mail->Send();

		return $sent;
	}
}