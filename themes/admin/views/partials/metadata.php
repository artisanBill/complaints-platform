<!-- Meta -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<meta name="csrf-token" content="65qsEaQ1zYPM8hpka97A2OxxN3DoQLAbeCvLcq6D"/>

<title><?php echo $template['title']; ?> &raquo; BOONE</title>

<!-- Favicon -->
<link rel="icon" type="image/x-icon" href="<?php echo base_url('resources/admin/images/favicon.png') ?>">
<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('resources/admin/images/favicon.png') ?>">
<link rel="apple-touch-icon" type="image/x-icon" href="<?php echo base_url('resources/admin/images/favicon.png') ?>"/>

<link media="all" type="text/css" rel="stylesheet" href="<?php echo base_url('resources/admin/theme.css') ?>">
<script src="<?php echo base_url('resources/admin/theme.js') ?>"></script>

<script type="text/javascript">
	var APP_URL = "<?php echo site_url() ?>";
	var APP_DOMAIN = "<?php echo site_url() ?>";
	var BASE_URL = "<?php echo base_url('source') ?>";

	var CSRF_TOKEN = "<?php echo $this->config->item('csrf_token_name') ?>";
	var APP_DEBUG = "";
	//var TIMEZONE = "UTC";
	//var LOCALE = "en";
</script>
<?php echo $template['metadata']; ?>