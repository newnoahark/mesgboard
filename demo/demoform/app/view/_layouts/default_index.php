<!DOCTYPE html>
<html>
<head>
	<title>blog</title>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<!-- <link rel="stylesheet" type="text/css" href="index.css"> -->
<link rel="stylesheet" type="text/css" href="<?php echo $_BASE_DIR; ?>css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo $_BASE_DIR; ?>css/index.css">
	<meta charset="utf-8">
</head>
<body>
<div class="wrap">
	<div class="header">
	<div class="headinside">
		<div class="navbarleft">
			<a class="log" href="index.php">
			<?php $this->_block('userlog');?>YOU LOG<?php $this->_endblock(); ?></a>
		</div>
		<div class="navbarright">
			<ul class="navbarlist">
					<li><a href="index.php?controller=user&action=Logout">退出</a></li>
					<li><a href="index.php?controller=user&action=Login">登录</a></li>
					<li><a href="index.php?controller=user&action=register">注册</a></li>
					<li><a href="index.php?controller=tasks&action=Create">留言</a></li>
					<li><a href="index.php?controller=tasks&action=index">留言板</a></li>
				</ul>	
		</div>
	</div>
</div>
	<div class="container">
		<div class="panel-heading">
		</div>
		<div class="listmsg" id="msgGrop">
			<?php $this->_block('contents'); ?>
			<?php $this->_endblock(); ?>
		</div>		
	</div>	
</div>
</body>
</html>
