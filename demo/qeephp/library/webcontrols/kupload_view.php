<input size="<?php echo $size;?>" type="text" id="<?php echo $id;?>" name="<?php echo $name;?>" value="<?php echo $value;?>" />
<a id="kupload_<?php echo $id;?>" href="#" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-add'">上传</a>
<img src="<?php echo $value; ?>" width="<?php echo ($width)?$width:'100';?>" height="<?php echo ($height)?$height:'100';?>" id="kupload_image_<?php echo $id;?>">
<script type="text/javascript">
KindEditor.ready(function(K) {
	<?php if ($style == 'button'):?>
	var uploadbutton = K.uploadbutton({
		button : K('#kupload_<?php echo $id;?>')[0],
		fieldName : 'imgFile',
		url : '<?php echo url("plugin::keditor/upload");?>',
		extraParams : {"post_key" : "<?php echo $post_key; ?>",
			"photo_target":"<?php echo $photo_target;?>",
			"attach_target":"<?php echo $attach_target;?>", 
			"model":"<?php echo $model;?>", 
			"field":"<?php echo $field;?>", 
			"replace":"<?php echo $replace;?>"},
		afterUpload : function(data) {
			if (data.error === 0) {
				var url = K.formatUrl(data.url, 'absolute');
				K('#<?php echo $id;?>').val(url);
				K('#kupload_image_<?php echo $id;?>').attr('src',url);
			} else {
				alert(data.message);
			}
		},
		afterError : function(str) {
			alert('自定义错误信息: ' + str);
		}
	});
	uploadbutton.fileBox.change(function(e) {
		uploadbutton.submit();
	});
	<?php else:?>
	var editor_<?php echo $id;?> = K.editor({
		allowFileManager : <?php echo $manager ? 'true' : 'false';?>
		,uploadJson : '<?php echo url("plugin::keditor/upload");?>'
		,fileManagerJson : '<?php echo url("plugin::keditor/manager");?>'
		,extraFileUploadParams : {"post_key" : "<?php echo $post_key; ?>", 
			"photo_target":"<?php echo $photo_target;?>",
			"attach_target":"<?php echo $attach_target;?>",
			"model":"<?php echo $model;?>", 
			"field":"<?php echo $field;?>", 
			"replace":"<?php echo $replace;?>"}
		<?php if ($multi):?>
		,imageSizeLimit:"<?php echo $sizeLimit;?>"
		,imageFileTypes: '<?php echo $fileTypes;?>'
		<?php endif;?>
	});
	K('#kupload_<?php echo $id;?>').click(function() {
		editor_<?php echo $id;?>.loadPlugin('<?php echo $plugin;?>', function() {
			editor_<?php echo $id;?>.plugin.<?php echo $dialog;?>({
				clickFn : function(<?php if (! $multi):?>url, title<?php else:?>urlList<?php endif;?><?php if ($type == 'image' && ! $multi):?>, width, height, border, align<?php endif;?>) {
					<?php if (! $multi):?>
					K('#<?php echo $id;?>').val(url);
					K('#kupload_image_<?php echo $id;?>').attr('src',url);
					<?php else:?>
					alert(urlList && ! $multi);
					<?php endif;?>
					editor_<?php echo $id;?>.hideDialog();
				}
				// 将原地址设置到上传文件窗口的文本框中
				<?php if (! $multi):?>
				,<?php echo $type;?>Url : K('#<?php echo $id;?>').val()
				<?php endif; ?>
				<?php if ($manager && ! $multi):?>
				// 文件管理空间排列方式
				,viewType : 'VIEW'
				// 保存路径
				,dirName : '<?php echo $type;?>'
				<?php endif;?>
				// 远程文件
				<?php if ($style == 'remote' && ! $multi):?>
				,showRemote : true
				,showLocal : false
				<?php endif;?>
				// 本地上传
				<?php if ($style == 'local' && ! $multi):?>
				,showRemote : false
				,showLocal : true
				<?php endif;?>
				// 远程+本地
				<?php if ($style == 'double' && ! $multi):?>
				,showRemote : true
				,showLocal : true
				<?php endif;?>
			});
		});
	});
	<?php endif;?>
});
</script>