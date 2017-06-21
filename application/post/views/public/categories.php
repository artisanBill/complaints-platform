<div class="card-bolck">
	<div class="boone-help-list">
		<ul class="clearfix">
			<?php if ( $categories ): ?>
				<?php foreach ( $categories as $item ): ?>
					<li>
						<a href="/post/<?php echo $item->id ?>"> 
							<?php echo $item->name ?>
						</a>
					</li>
				<?php endforeach ?>
			<?php endif ?>
		</ul>
	</div>
</div>