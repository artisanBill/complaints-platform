<div class="container">
	<div class="row">
		<div class="col-sm-4" id="boone-categories">
			<div class="card">
				<span class="handle card-label card-label-success">
					<i class="fa fa-reorder fa-1x"></i> 资讯类别
				</span>
				<?php echo $this->load->view('public/categories') ?>

				<div class="hidden-xs">
					<span class="handle card-label card-label-success">
						<i class="fa fa-bullhorn fa-1x"></i> 推荐资讯
					</span>
					<div class="card-bolck">
						<?php echo $this->load->view('public/list', ['postData' => $newPost, 'titleNumber' => 14 ]) ?>
					</div>
				</div>
					
			</div>
		</div>

		<div class="col-sm-8">
			<div class="card">
				<?php echo $this->load->view('public/filter') ?>
			</div>

			<div class="card">
				<div class="card-bolck boone-bottom-border">
					<?php echo $this->load->view('public/list', ['postData' => $postData]) ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php if ($pagination): ?>
	<div class="container">
		<div class="col-md-12 text-center">
			<nav>
				<?php echo $this->load->view('pagination') ?>
			</nav>
		</div>
	</div>
<?php endif ?>