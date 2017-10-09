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

class BookingTableRoom extends JTable {
	function __construct(&$db) {
		parent::__construct('#__booking_room', 'id', $db);
	}

	public function bind($array, $ignore = '') {
		// Bind the rules.
		if (isset($array['rules']) && is_array($array['rules'])) {
			$rules = new JAccessRules($array['rules']);
			$this->setRules($rules);
		}

		return parent::bind($array, $ignore);
	}

	protected function _getAssetName() {
		$k = $this->_tbl_key;

		return 'com_booking.room.' . (int) $this->$k;
	}

	protected function _getAssetTitle() {
		return $this->room;
	}

	protected function _getAssetParentId(JTable $table = null, $id = null) {
		// We will retrieve the parent-asset from the Asset-table
		$assetParent = JTable::getInstance('Asset');
		// Default: if no asset-parent can be found we take the global asset
		$assetParentId = $assetParent->getRootId();

		// Find the parent-asset
		$assetParent->loadByName('com_booking');

		// Return the found asset-parent-id
		if ($assetParent->id) {
			$assetParentId = $assetParent->id;
		}

		return $assetParentId;
	}
}