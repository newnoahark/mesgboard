<?php

/**
 * Control_Combotree
 * 
 * @author sqlhost
 * @version v1.0.1
 *         
 */
class Control_Combotree extends QUI_Control_Abstract {

	function render() {

		$value = '';
		if (is_array($this->value)) {
			foreach ($this->value as $val) {
				$value = $value ? $val . "," : $val;
			}
		}
		elseif (is_object($this->value)) {
			$value = isset($this->value->id) ? $this->value->id : '';
		}
		else {
			$value = $this->value;
		}
		
		if($this->param){
			$size = intval($this->size) ? intval($this->size) : 220;
			$out = "<input id=\"" . $this->id . "\" name=\"" . $this->id . ($this->multiple ? "[]" : "") . "\" class=\"easyui-combotree\" data-options=\"url:'" . url($this->url, ($this->multiple ? array('noDefault' => 1,'param' => $this->param) : array())) . "',cascadeCheck:" . ($this->cascadeCheck ? "true" : "false") . ",multiple:" . ($this->multiple ? "true" : "false") . ",required:" . ($this->require ? "true" : "false") . "\" value=\"" . $value . "\" style=\"width: {$size}px;\">";
		}else{
			$size = intval($this->size) ? intval($this->size) : 220;
			$out = "<input id=\"" . $this->id . "\" name=\"" . $this->id . ($this->multiple ? "[]" : "") . "\" class=\"easyui-combotree\" data-options=\"url:'" . url($this->url, ($this->multiple ? array('noDefault' => 1) : array())) . "',cascadeCheck:" . ($this->cascadeCheck ? "true" : "false") . ",multiple:" . ($this->multiple ? "true" : "false") . ",required:" . ($this->require ? "true" : "false") . "\" value=\"" . $value . "\" style=\"width: {$size}px;\">";
		}
		
		return $out;
	}

}


