<meta charset="utf-8" />
<title>	<?php echo $template['title']; ?> &raquo; 投诉网</title>
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
<link rel="icon" type="image/x-icon" href="/resources/site/img/favicon.png">
<link rel="shortcut icon" type="image/x-icon" href="/resources/site/img/favicon.png">
<link rel="apple-touch-icon" type="image/x-icon" href="/resources/site/img/favicon.png"/>
<link rel="stylesheet" type="text/css" href="/resources/site/stylesheet/desktop.css">
<link rel="stylesheet" type="text/css" href="/resources/site/stylesheet/animate.css">
<script type="text/javascript">
	var APP_URL = "<?php echo site_url() ?>";
	var APP_DOMAIN = "<?php echo site_url() ?>";
	var BASE_URL = "/";

	var CSRF_TOKEN = "<?php echo $this->config->item('csrf_token_name') ?>";
	var APP_DEBUG = "";
	//var TIMEZONE = "UTC";
	//var LOCALE = "en";
</script>
<meta http-equiv = "X-UA-Compatible" content = "IE=edge,chrome=1" />
<meta content="Team lics <lics@itousu.net>" name="author" />
<meta name="baidu-site-verification" content="OXkMnEgjiw" />
<meta name="csrf-token" content="<?php echo $this->config->item('csrf_token_name') ?>"/>
<?php echo $template['metadata']; ?>
<script src="/resources/site/script/jquery/jquery.js"></script>
<script src="/resources/site/script/jquery/boone.js"></script>