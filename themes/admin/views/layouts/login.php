<!doctype html>
<html>

<head>
	<?php filePartial('metadata') ?>
</head>

<body id="login" style="background-image: url(<?php echo base_url('resources/admin/images/backgrounds/' . $loginBackImg . '.jpg') ?>)">

	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-lg-offset-9 col-md-10 col-md-offset-7 col-sm-10 col-sm-offset-7">
				<div class="logo">
					<img src="<?php echo base_url('resources/admin/images/logo-white.svg') ?>" height="55">
				</div>
				<?php filePartial('messages') ?>
				<?php echo $template['body'] ?>
			</div>
		</div>
	</div>

	<script src="<?php echo base_url('resources/admin/js/form/translations.js') ?>"></script>
	<script src="<?php echo base_url('resources/admin/js/text-field_type/resources/js/jquery.charactercounter.js') ?>"></script>
	<script src="<?php echo base_url('resources/admin/js/text-field_type/resources/js/input.js') ?>"></script>

</body>
</html>
