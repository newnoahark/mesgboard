<?php //屏蔽错误报告，有些变量未定义使用导致错误  应急方案 
//ini_set("error_reporting","E_ALL & ~E_NOTICE") ?>
<?php $this->_extends('_layouts/default_index'); ?>
 <?php $this->_block('userlog');?>
<?php  echo empty($usename) ? "YOU LOG" : $usename;?>
<?php $this->_endblock(); ?>
<?php $this->_block('contents'); ?>

<?php if (!empty($usename)):?>
<form action="<?php echo url('tasks/create'); ?>" method="post">
 <h2>添加留言</h2>
  <fieldset>
    <p>
      <label for="subject">标题</label>
      <input type="text" name="subject" id="subject"></input>
      <span class="error"><?php 
      //echo isset($this->_vars['subject']) ? "" :  $this->_vars['subject'];
      echo $form['subject']->isValid() ? "" :  $form['subject']->errorMsg()[0];?></span>
    </p>
    
    <p>
      <label for="description">内容</label>
      <textarea name="description" id="description" style="width:300px;height:100px;;resize:none;"></textarea>
      <span class="error"><?php 
      //echo isset($this->_vars['description']) ? "" :  $this->_vars['description'];
      echo $form['description']->isValid() ? "" :  $form['description']->errorMsg()[0];?></span>
    </p>
    
    <p> 
      <label> </label>
      <input type="submit" name="Submit" value="留言" ></input>
    </p>
  </fieldset>
</form>
<?php else: echo "没登陆"; ?>
<?php endif; ?>  

<?php $this->_endblock(); ?>