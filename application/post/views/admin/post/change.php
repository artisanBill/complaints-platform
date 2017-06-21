<div class="modal-header">
    <button class="close" data-dismiss="modal">
        <span>&times;</span>
    </button>
    <h4 class="modal-title"> 您期望发布文章在哪里? </h4>
</div>
<div class="modal-body">
	<ul class="nav nav-pills nav-stacked">
		<?php if ( $data ): ?>
			<?php foreach ( $data as $id => $item ): ?>
				<li class="nav-item">
					<a href="/content/post/create/<?php echo $id ?>" class="nav-link">
						<strong><?php echo $item['name'] ?></strong>
					</a>
					<?php if ( $item['data'] ): ?>
					<?php foreach ( $item['data'] as $val ): ?>
						<a>
							<a href="/content/post/create/<?php echo $val['id'] ?>" 
								class="label label-sm label-success">
								<?php echo $val['name'] ?>
							</a>
						</a>
					<?php endforeach ?>
				<?php endif ?>
				</li>
			<?php endforeach ?>
		<?php endif ?>
		<li>
			<a class="btn btn-secondary-outline btn-sm btn-block ajax" href="/content/post/categories/change">
				<small>当前没有类别可选(创建类别)</small>
			</a>
		</li>
	</ul>
</div>