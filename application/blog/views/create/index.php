<style type="text/css">
.blog-post-tags, .details-tags
{
	border: none;
}
.boone-post-bottom {
	border-bottom: 1px dashed #EEEEEE;
}
</style>
<div class="card">
	<div class="card-bolck">
		<div class="row">
			<div class="col-sm-4 col-md-3">
				<?php echo $this->load->view('create/categories') ?>
			</div>

			<div class="col-sm-8 col-md-9">
				<div id="contentPerview" class="">
					<?php echo $this->load->view('user/index') ?>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="/resources/site/script/app/blog/blog.js"></script>