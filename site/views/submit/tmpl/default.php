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
?>
<h1><?php echo JText::_('COM_BOOKING_SITE_FORM_TITLE'); ?></h1>
<p>
	<strong><?php echo $this->message; ?></strong><br/><br/>
	<a href="<?php echo JRoute::_('index.php?option=com_booking'); ?>" class="btn btn-primary"><?php echo JText::_('COM_BOOKING_SITE_SUBMIT_BUTTON'); ?></a>
</p>
