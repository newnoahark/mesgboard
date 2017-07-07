<?php
// $Id: combolist.php 2014 2013-09-12 sqlhost $


/**
 * 定义 Control_ComboList 类，构造一个固定数量的级联菜单
 *
 * 注：实际上只是定义了下拉列表框，级联效果交由前端实现，适用于不同的模型间的级联，同一模型的级联请使用combotree
 *
 * @link http://labphp.com/
 * @copyright Copyright (c) 2006-2009 LabPHP Inc.
 * @link http://www.labphp.com
 * @license New BSD License {@link http://labphp.com/license/}
 * @version $Id: combolist.php 2014 2013-09-12 sqlhost $
 * @package webcontrols
 */
class Control_ComboList extends QUI_Control_Abstract {

	function render() {

		$parentItems = $this->_extract('parent_items');
		$value = $this->_extract('value');
		$parent = $this->_extract('parent');
		$items = $this->_extract('items');
		$require = $this->_extract('require');
		
		$out = '';
		
		foreach ($parent as $key => $val) {
			$out .= '<select ';
			$out .= 'id="' . $val . '" name="' . $val . '" ';
			$out .= $this->_printDisabled();
			$out .= $this->_printAttrs();
			$out .= ">\n<option value=\"0\">－请选择－</option>\n";
			
			if (!$key) {
				foreach ((array)$parentItems as $value => $caption) {
					$out .= '<option value="' . htmlspecialchars($value) . '">';
					$out .= htmlspecialchars($caption);
					$out .= "</option>\n";
				}
			}
			
			$out .= "</select>\n";
		}
		$out .= '<select ';
		$out .= $this->_printIdAndName();
		$out .= $this->_printDisabled();
		$out .= $this->_printAttrs();
		$out .= ($require ? ' required="required"' : '');
		$out .= ">\n<option value=\"0\">－请选择－</option>\n";
		$out .= "</select>\n";
		
		return $out;
	}
}

