<div class="card">
	<div class="card-bolck">
		<?php echo $this->load->view('user/filter') ?>
	</div>
</div>

<div class="card">
	<div class="card-bolck">
		<?php echo $this->load->view('user/list') ?>
	</div>
</div>

<?php if ($pagination): ?>
	<div class="col-md-12 text-center">
		<nav>
			<?php echo $this->load->view('pagination') ?>
		</nav>
	</div>
<?php endif ?>