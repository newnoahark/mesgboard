<?php
// $Id: controller_abstract.php 2010 2009-01-08 18:56:36Z dualface $


/**
 * 定义 QController_Abstract 类
 *
 * @link http://qeephp.com/
 * @copyright Copyright (c) 2006-2009 Qeeyuan Inc. {@link
 *            http://www.qeeyuan.com}
 * @license New BSD License {@link http://qeephp.com/license/}
 * @version $Id: controller_abstract.php 2010 2009-01-08 18:56:36Z dualface $
 * @package mvc
 */

/**
 * QController_Abstract 实现了一个其它控制器的基础类
 *
 * @author YuLei Liao <liaoyulei@qeeyuan.com>
 * @version $Id: controller_abstract.php 2010 2009-01-08 18:56:36Z dualface $
 * @package mvc
 */
abstract class QController_Abstract {

	/**
	 * 封装请求的对象
	 *
	 * @var QContext
	 */
	protected $_context;

	/**
	 * 构造函数
	 */
	function __construct() {

		$this->_context = QContext::instance();
	}

	/**
	 * 检查指定的动作方法是否存在
	 *
	 * @param string $action_name
	 *
	 * @return boolean
	 */
	function existsAction($action_name) {

		$action_method = "action{$action_name}";
		return method_exists($this, $action_method);
	}

	/**
	 * 转发请求到控制器的指定动作
	 *
	 * @param string $udi        
	 *
	 * @return mixed
	 */
	protected function _forward($udi) {

		$args = func_get_args();
		array_shift($args);
		return new QController_Forward($udi, $args);
	}

	/**
	 * 返回一个 QView_Redirect 对象
	 *
	 * @param string $url        
	 * @param int $delay        
	 *
	 * @return QView_Redirect
	 */
	protected function _redirect($url, $delay = 0) {

		return new QView_Redirect($url, $delay);
	}

// 	/**
// 	 * 获得快速保存字段
// 	 *
// 	 * @author sqlhost
// 	 * @version 1.0.0
// 	 *          2012-4-11
// 	 */
// 	function actionGetFastInput() {

// 		if (!is_object($this->_model) || !is_object($this->_form)) {
// 			echo "";
// 			exit();
// 		}
// 		// 获得上下文变量
// 		$id = $this->_context->id;
// 		$field = $this->_context->field; // controller_id
		

// 		// 如果列表是按主表显示，就要更换主表的模型
// 		if ($this->_list_post) {
// 			$model = new Post();
// 		}
// 		else {
// 			$model = $this->_model;
// 		}
// 		// 查询记录
// 		$row = $model->find(array(
// 				$model->idname() => $id
// 		))->query(); // $actions
		

// 		// 将记录导入表单
// 		$this->_form->import($row);
// 		/* 处理特殊控件 */
// 		// rlist
// 		if ($this->_form[$field]->_ui == 'rlist') {
// 			$this->_form[$field]->current_id = $row->$field;
// 		}
// 		// rradio
// 		elseif ($this->_form[$field]->_ui == 'rradio') {
// 			$objName = $this->_form[$field]->assoc_class;
// 			$this->_form[$field]->parent_items = Helper_Array::toHashMap($row->$objName, 'id', 'name');
// 			$this->_form[$field]->current_id = helper_Array::toHashMap($row->$field, 'id');
// 		}
// 		// rselect
// 		elseif ($this->_form[$field]->_ui == 'rselect') {
// 			$this->_form[$field]->current_id = $row->id();
// 		}
// 		elseif ($this->_form[$field]->_ui == 'swfupload') {}
// 		// _ui依赖
// 		if (!empty($this->_finder_depand) && array_key_exists($field, $this->_finder_depand)) {
// 			$depand = $this->_finder_depand;
// 			$this->_form[$field]->_ui = $row->$depand[$field]['on'];
// 			if (in_array($this->_form[$field]->_ui, array(
// 					'checkboxgroup',
// 					'radiogroup',
// 					'dropdownlist'
// 			))) {
// 				$this->_form[$field]->items = $depand[$field]['items'][$row->$depand[$field]['rel']];
// 			}
// 			else {
// 				$this->_form[$field]->items = null;
// 			}
// 		}
// 		// - 处理特殊控件
// 		$attrs = $this->_form[$field]->attrs();
// 		$attrs['name'] = 'fast_input';
// 		echo Q::control($this->_form[$field]->_ui, 'fast_input', $attrs);
// 		exit();
// 	}

// 	/**
// 	 * 快速保存字段
// 	 *
// 	 * @author sqlhost
// 	 * @version 1.0.0
// 	 *          2012-4-8
// 	 *         
// 	 * @version 1.0.1
// 	 *          2012-4-13
// 	 *          将$value用json_decode解码
// 	 */
// 	function actionFastInputSave() {

// 		if (!is_object($this->_model)) {
// 			echo "error";
// 			exit();
// 		}
// 		$id = $this->_context->id;
// 		$field = $this->_context->field;
// 		$value = json_decode($this->_context->value);
		
// 		// 如果列表是按主表显示，就要更换主表的模型
// 		if ($this->_list_post) {
// 			$model = new Post();
// 		}
// 		else {
// 			$model = $this->_model;
// 		}
		
// 		$row = $model->find(array(
// 				$model->idname() => $id
// 		))->query();
// 		/**
// 		 * 处理特殊字段
// 		 */
// 		// checkboxgroup
// 		if ($this->_form[$field]->_ui == 'checkboxgroup' || $this->_form[$field]->_ui == 'radiogroup') {
// 			if (is_object($row->$field)) {
// 				if (count($value) > 0) {
// 					$objName = $row->meta()->props[$field]['assoc_class'];
// 					$obj = new $objName();
// 					$value = $obj->find(array(
// 							$obj->idName() => $value
// 					))->getAll();
// 				}
// 			}
// 			else {
// 				$value = $value[0];
// 			}
// 		}
// 		// rradio
// 		elseif ($this->_form[$field]->_ui == 'rradio') {
// 			$objName = $row->meta()->props[$field]['assoc_class'];
// 			$obj = new $objName();
// 			$value = $obj->find(array(
// 					$obj->idName() => $value
// 			))->getAll();
// 		}
// 		// rselect
// 		elseif ($this->_form[$field]->_ui == 'rselect') {
// 			// $source_key =
// 			// $row->meta()->props[$field]['assoc_params']['source_key'];
// 			// $field = $source_key;
// 		}
// 		else {
// 			if (is_array($value)) {
// 				$value = Helper_Array::toString($value, ',');
// 			}
// 		}
// 		// -
// 		$row->$field = $value;
// 		$row->save();
// 		echo "success";
// 		exit();
// 	}
}

