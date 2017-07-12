<?php $this->_extends('_layouts/default_index'); ?>
 <?php $this->_block('userlog');?>
<?php  
echo empty($usename) ? "YOU LOG" : $usename;
?>
<?php $this->_endblock(); ?>
<?php $this->_block('contents'); ?>
<?php if(empty($msgflag)): ?>
  <?php foreach ($tasks as $task): ?>
    <div class="task">
      <p class="title">
        <span>标题 ：<?php echo h($task->subject); ?></span>
        <span style="float:right ;">
          <a href="<?php echo url('tasks/Delete', array('task_id' => $task->id())); ?>" style="background-color:white;color: black; text-decoration:none"}>删除</a>
        </span>
        <span style="float:right;">
          <a href="<?php echo url('tasks/Edit', array('task_id' => $task->id())); ?>" style="background-color:white;color: black; text-decoration:none"}>修改</a>
        </span>
      </p> 
      <p class="meta">
      <?php if ($task->is_completed): ?>
      <em>已经在 <?php echo date('m-d H:i', $task->completed_at); ?> 完成该任务</em>
      <?php else: ?>
      日期：<?php echo date('m-d H:i', $task->created); ?>
      <?php endif; ?>
      </p>
      <?php if ($task->description): ?>
      <p class="description">
        <?php echo nl2br(h($task->description)); ?>
      </p>
      <?php endif; ?>
    </div>
  <?php endforeach; ?>
<?php else:?>
    <p>用户未登陆</p>
<?php endif; ?>

  
 
<?php $this->_endblock(); ?>