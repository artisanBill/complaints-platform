<!DOCTYPE html>
<html lang="<?php echo CURRENT_LANGUAGE ?>">
<head>
	<?php filePartial('metadata') ?>
</head>
<body>
	<div class="wrapper">
		<?php filePartial('blog_default_nav') ?>

		<div class="container">
			<?php filePartial('message') ?>
		</div>

		<?php echo $template['body'] ?>
		<?php filePartial('footer') ?>
	</div>

<script type="text/javascript" src="/resources/site/script/jquery/bootstrap.js"></script>
<script type="text/javascript" src="/resources/site/script/jquery/booneload.js"></script>
<script type="text/javascript">
$(function() {          
    $('img.boone-news').booneload({
    	'placeholder_data_img': '/resources/images/itousu/front-cover.png'
    });
    $('img.boone-avater').booneload({
        'placeholder_data_img': '/resources/site/img/avater.png'
    });
});
</script>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?a51501ea1e1bc5c700bc3221bc57f85f";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
</body>
</html>