<?php if ( $blogData ): ?>
<div class="container">
	<div class="card">
		<div class="card-bolck">
			<?php echo $this->load->view('public/list') ?>
		</div>
	</div>
</div>
<script type="text/javascript" src="/resources/site/script/app/blog/public.js"></script>
<?php else: ?>
	<?php echo $this->load->view('public/noblog') ?>
<?php endif ?>