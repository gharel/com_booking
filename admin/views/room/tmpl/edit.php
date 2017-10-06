<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_booking
 *
 * @copyright   Copyright (C) 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

JHtml::_('behavior.formvalidator');
?>
<div id="j-sidebar-container" class="span2">
	<?php echo $this->sidebar; ?>
</div>
<div id="j-main-container" class="span10">
	<form action="<?php echo JRoute::_('index.php?option=com_booking&layout=edit&id=' . (int) $this->item->id); ?>"
	      method="post" name="adminForm" id="adminForm" class="form-validate">
		<div class="form-horizontal">
			<fieldset class="adminform">
				<legend><?php echo JText::_('COM_BOOKING_ADMIN_LIST_DETAILS'); ?></legend>
				<div class="row-fluid">
					<div class="span6">
						<?php foreach ($this->form->getFieldset() as $field): ?>
							<div class="control-group">
								<div class="control-label"><?php echo $field->label; ?></div>
								<div class="controls"><?php echo $field->input; ?></div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</fieldset>
		</div>
		<input type="hidden" name="task" value="room.edit" />
		<?php echo JHtml::_('form.token'); ?>
	</form>
</div>