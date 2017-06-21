<section class="home-intro" id="home-intro">
	<div class="jumbotron jumbotron-fluid">
		<div class="container text-center">
			<h2 class="boone fadeInDown">暂时还没有文章哦 ！</h2>
			<div class="btn">
				<a href="<?php echo app_url('.', 'login') ?>" class="btn btn-lg boone pulse" data-boone-iteration="infinite" data-boone-duration="1400ms">
					写一篇文章 !
				</a>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript" src="/resources/site/script/jquery/animate.js"></script>
<script type="text/javascript">
	booneAnimated = new BOONE_ANIMATE(
	{
		animateClass: 'animated',
		offset: 100,
		offset: 0,
		mobile: true,
		live: true,
	});
	booneAnimated.init();
</script>