<div class="modal-header">
    <button class="close" data-dismiss="modal">
        <span>&times;</span>
    </button>
    <h4 class="modal-title"> 您期望创建什么类别? </h4>
</div>

<div class="modal-body">
	<ul class="nav nav-pills nav-stacked">
		<li class="nav-item active">
			<a href="/content/helper/categories/create" class="nav-link">
				<strong>顶级目录</strong>
				<br>
				<small>创建顶级类目的帮助类别</small>
			</a>
		</li>
		<?php if ( $data ): ?>
			<?php foreach ( $data as $item ): ?>
				<li class="nav-item">
					<a href="/content/helper/categories/create/<?php echo $item->id ?>" class="nav-link">
						<strong><?php echo $item->title ?></strong>
					</a>
				</li>
			<?php endforeach ?>
		<?php endif ?>
	</ul>
</div>