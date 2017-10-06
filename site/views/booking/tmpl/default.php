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
<h1><?php echo JText::_( 'COM_BOOKING_SITE_FORM_TITLE' ); ?></h1>
<form action="<?php echo JRoute::_('index.php?option=com_booking&task=submit'); ?>" method="post">
	<?php foreach ($this->form->getFieldset('infos') as $field): ?>
		<div class="control-group">
			<div class="control-label"><?php echo $field->label; ?></div>
			<div class="controls"><?php echo $field->input; ?></div>
		</div>
	<?php endforeach; ?>
	<div class="control-group">
		<div class="control-label">
			<label><?php echo JText::_( 'COM_BOOKING_SITE_FORM_ROOM' ); ?></label>
		</div>
		<?php echo $this->list; ?>
	</div>
	<?php foreach ($this->form->getFieldset('dates') as $field): ?>
		<div class="control-group">
			<div class="control-label"><?php echo $field->label; ?></div>
			<div class="controls"><?php echo $field->input; ?></div>
		</div>
	<?php endforeach; ?>
	<button type="submit" class="btn btn-primary"><?php echo JText::_( 'COM_BOOKING_SITE_FORM_BUTTON' ); ?></button>
	<?php echo JHtml::_('form.token'); ?>
</form>
