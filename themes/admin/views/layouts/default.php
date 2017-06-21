<!doctype html>
<html>
<head>
	<?php filePartial('metadata') ?>
</head>
<body>
	<?php filePartial('brand') ?>
	<?php filePartial('navbar') ?>
	<?php filePartial('header') ?>
	<main id="main">

	    <?php filePartial('banner') ?>
	    <?php filePartial('breadcrumbs') ?>

	    <div class="container-fluid">
	    	<?php filePartial('messages') ?>
	    </div>

	    <?php echo $template['body']; ?>
	</main>

	<?php filePartial('footer') ?>
	<?php filePartial('modals') ?>
</body>
</html>