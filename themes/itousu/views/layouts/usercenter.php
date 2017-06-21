<!DOCTYPE html>
<html lang="<?php echo CURRENT_LANGUAGE ?>">
<head>
	<?php filePartial('metadata') ?>
</head>
<body>
	<div class="wrapper">
		<?php filePartial('usernav') ?>
		<div class="boone-project-publish">
			<div class="container">
				<?php filePartial('message') ?>
				<?php echo $template['body'] ?>
			</div>
		</div>
		<?php filePartial('footer') ?>
	</div>
<script type="text/javascript" src="<?php echo base_url('resources/site/script/jquery/bootstrap.js') ?>"></script>
<script type="text/javascript">
$(function () {
	$('[data-toggle="tooltip"]').tooltip()
})
</script>
</body>
</html>