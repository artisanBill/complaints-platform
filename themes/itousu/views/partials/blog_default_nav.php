<nav class="navbar navbar-default boone-navbar">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#boone-navbar" aria-expanded="false">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="/">
				<span>投诉网</span>
			</a>
		</div>
		<div class="collapse navbar-collapse" id="boone-navbar">
			<ul class="nav navbar-nav">
				<?php if (isset($categoriesNav)): ?>
				<?php $activeCurrent = $this->uri->segment(3) ?>
				<?php foreach ( $categoriesNav as $itemNav ): ?>
					<li <?php echo ($activeCurrent == $itemNav->id) ? 'class="active"' : '' ?>>
						<a href="<?php echo app_url('.', 'center/' . $userBlog->domain . '/' . $itemNav->id) ?>">
							<?php echo $itemNav->name ?>
						</a>
					</li>
				<?php endforeach ?>
			<?php endif ?>
			</ul>
			<?php filePartial('rightnav') ?>
		</div>
	</div>
</nav>