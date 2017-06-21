<?php echo $this->load->view('public/file/input', [
	'jsFile'		=> TRUE,
	'inputname'		=> 'images',
	'filename'		=> '图片',
	'fileDesc'		=> '选择一张图片作为文章主图',
	'inputvalue'	=> $post->image
]) ?>