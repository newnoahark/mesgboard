<?php
class Form_Task extends QForm
{   
    function __construct()
    {
        
        // 调用父类的构造函数
        parent::__construct('form_task');
        
        //也可以直接定义配置数组
        $fields = array('subject'=> array(),'description' => array(), 'is_completed' => array());
        $this->loadFromConfig($fields);
        //导入Task表的属性验证规则
        $this->addValidations(Tasks::meta());
    }
}
?>