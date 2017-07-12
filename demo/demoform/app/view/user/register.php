// 指示该视图从 _layouts/default_layout 继承
<?php $this->_extends('_layouts/default_index'); ?>
<?php $this->_block('contents'); ?>
<!-- <?php //$this->_element('formview', array('form' => $form));?> -->
<?php $this->_element('formview');
if(isset($this->_vars["loginmsg"]))
print_r($this->_vars["loginmsg"]);

?>
<?php $this->_endblock(); ?>
