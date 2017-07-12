<?php $this->_extends('_layouts/default_index'); ?>

<?php $this->_block('userlog');?>
<?php  
if(isset($_GET["loginmsg"])) {
	print_r('welcome '.$_GET["loginmsg"]);
}else 
  print_r("YOU LOG");
?>

<?php $this->_endblock(); ?>

<?php $this->_block('contents');?> 	
	<a href="index.php?controller=user&action=register"><font color="black">aaaa</font></a>
	

<?php $this->_endblock('contents'); ?>
