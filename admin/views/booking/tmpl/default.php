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
?>
<div id="j-sidebar-container" class="span2">
	<?php echo $this->sidebar; ?>
</div>
<div id="j-main-container" class="span10">
	<form action="index.php?option=com_booking&view=booking" method="post" id="adminForm" name="adminForm">
		<?php if (empty($this->items)) : ?>
			<div class="alert alert-no-items">
				<?php echo JText::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
			</div>
		<?php else : ?>
		<table class="table table-striped table-hover">
			<thead>
			<tr>
				<th width="1%"><?php echo JText::_('COM_BOOKING_ADMIN_LIST_BOOKING_NUM'); ?></th>
				<th width="40%">
					<?php echo JText::_('COM_BOOKING_ADMIN_LIST_BOOKING_PEOPLE'); ?>
				</th>
				<th width="28%" style="text-align: right;">
					<?php echo JText::_('COM_BOOKING_ADMIN_LIST_BOOKING_ROOM'); ?>
				</th>
				<th width="30%" style="text-align: right;">
					<?php echo JText::_('COM_BOOKING_ADMIN_LIST_BOOKING_DATES'); ?>
				</th>
				<th width="2%" style="text-align: center;">
					<?php echo JText::_('COM_BOOKING_ADMIN_LIST_BOOKING_ID'); ?>
				</th>
			</tr>
			</thead>
			<tfoot>
			<tr>
				<td colspan="5">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
			</tfoot>
			<tbody>
			<?php if (!empty($this->items)) : ?>
				<?php foreach ($this->items as $i => $row) : ?>
					<tr>
						<td>
							<?php echo $this->pagination->getRowOffset($i); ?>
						</td>
						<td>
							<strong><?php echo ucwords($row->firstname, '-') . ' ' . strtoupper($row->lastname); ?></strong><br/>
							<a href="mailto:<?php echo $row->email; ?>"><?php echo $row->email; ?></a><br/>
							<a href="tel:<?php echo $row->phone; ?>"><?php echo $row->phone; ?></a>
						</td>
						<td style="text-align: right;">
							<strong><?php echo $row->name; ?></strong><br/>
							<?php echo $row->space; ?> seats available<br/>
							<?php echo $row->price; ?> €
						</td>
						<td style="text-align: right;">
							From <strong><?php echo $row->startDate; ?></strong><br/>
							To <strong><?php echo $row->endDate; ?></strong>
						</td>
						<td style="text-align: center;">
							<?php echo $row->id; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
			</tbody>
		</table>
		<?php endif; ?>
	</form>
</div>