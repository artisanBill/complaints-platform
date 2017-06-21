<div class="container">
	<div class="card">
		<div class="card-bolck">
			<?php echo $this->load->view('user/filter') ?>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<?php echo $this->load->view('public/list') ?>
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