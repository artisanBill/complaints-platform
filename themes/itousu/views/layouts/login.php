<!DOCTYPE html>
<html lang="<?php echo CURRENT_LANGUAGE ?>">
<head>
	<?php filePartial('metadata') ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('resources/site/stylesheet/login.css') ?>">

</head>
<body>
<div class="col-md-4 col-md-offset-4 boone-login">
	<div class="boone-content">
		<div class="login-logo">
			<a href="<?php echo app_url('.') ?>">
				<img class="logo-image" src="<?php echo base_url('resources/site/img/logo.svg') ?>">
			</a>
		</div>
		<?php echo $template['body'] ?>
	</div>
</div>

<script type="text/javascript" src="<?php echo base_url('resources/site/script/jquery/modal.js') ?>"></script>
</body>
</html>