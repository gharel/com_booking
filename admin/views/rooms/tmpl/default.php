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

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');

$app            = JFactory::getApplication();
$user           = JFactory::getUser();
$userId         = $user->get('id');
$listOrder      = $this->escape($this->state->get('list.ordering'));
$listDirn       = $this->escape($this->state->get('list.direction'));
?>
<?php if (!empty($this->sidebar)) : ?>
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
	</div>
<?php endif; ?>
<div id="j-main-container" <?php if (!empty($this->sidebar)) : ?>class="span10"<?php endif; ?>>
	<form action="<?php echo JRoute::_('index.php?option=com_booking&view=rooms') ?>" method="post" id="adminForm"
	      name="adminForm">
		<?php echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this)); ?>
		<?php if (empty($this->items)) : ?>
			<div class="alert alert-no-items">
				<?php echo JText::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
			</div>
		<?php else : ?>
			<table class="table table-striped table-hover">
				<thead>
				<tr>
					<th width="1%" class="nowrap"><?php echo JText::_('COM_BOOKING_ADMIN_LIST_ROOM_NUM'); ?></th>
					<th width="2%" class="nowrap">
						<?php echo JHtml::_('grid.checkall'); ?>
					</th>
					<th width="5%" class="nowrap">
						<?php echo JHtml::_('searchtools.sort', 'COM_BOOKING_ADMIN_LIST_ROOM_STATUS', 'published', $listDirn, $listOrder); ?>
					</th>
					<th width="35%" class="nowrap">
						<?php echo JHtml::_('searchtools.sort', 'COM_BOOKING_ADMIN_LIST_ROOM_NAME', 'name', $listDirn, $listOrder); ?>
					</th>
					<th width="28%" class="nowrap">
						<?php echo JHtml::_('searchtools.sort', 'COM_BOOKING_ADMIN_LIST_ROOM_SPACE', 'space', $listDirn, $listOrder); ?>
					</th>
					<th width="28%" class="nowrap">
						<?php echo JHtml::_('searchtools.sort', 'COM_BOOKING_ADMIN_LIST_ROOM_PRICE', 'price', $listDirn, $listOrder); ?>
					</th>
					<th width="2%" class="nowrap">
						<?php echo JHtml::_('searchtools.sort', 'COM_BOOKING_ADMIN_LIST_ROOM_ID', 'id', $listDirn, $listOrder); ?>
					</th>
				</tr>
				</thead>
				<tfoot>
				<tr>
					<td colspan="7">
						<?php echo $this->pagination->getListFooter(); ?>
					</td>
				</tr>
				</tfoot>
				<tbody>
				<?php if (!empty($this->items)) : ?>
					<?php foreach ($this->items as $i => $row) :
						$link = JRoute::_('index.php?option=com_booking&task=room.edit&id=' . $row->id);
						?>
						<tr>
							<td>
								<?php echo $this->pagination->getRowOffset($i); ?>
							</td>
							<td>
								<?php echo JHtml::_('grid.id', $i, $row->id); ?>
							</td>
							<td class="center">
								<?php echo JHtml::_('jgrid.published', $row->published, $i, 'rooms.', true); ?>
							</td>
							<td>
								<a href="<?php echo $link; ?>"
								   title="<?php echo JText::_('COM_BOOKING_ADMIN_LIST_EDIT'); ?>">
									<?php echo $row->name; ?>
								</a>
							</td>
							<td>
								<?php echo $row->space; ?> seats available
							</td>
							<td>
								<?php echo $row->price; ?> €
							</td>
							<td>
								<?php echo $row->id; ?>
							</td>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>
				</tbody>
			</table>
		<?php endif; ?>
		<input type="hidden" name="task" value=""/>
		<input type="hidden" name="boxchecked" value="0"/>
		<?php echo JHtml::_('form.token'); ?>
	</form>
</div>