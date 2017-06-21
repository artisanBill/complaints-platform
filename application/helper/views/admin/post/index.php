<link media="all" type="text/css" rel="stylesheet" href="/resources/app/tags/less/tagsinput.css">
<link rel="stylesheet" type="text/css" href="/resources/app/boolean/less/bootstrap-switch.css">
<div class="container-fluid">
	<?php echo form_open('content/helper/create/' . $categories->id, ['class' => 'form']) ?>
		<div class="card">
			<div class="card-block">
				<?php echo $this->load->view('admin/post/input') ?>
			</div>
		</div>

		<div class="card">
			<div class="card-block">
				<?php echo $this->load->view('public/editer/input', 
					[
						'editer' => $editerWysiwyg, 
						'contentBody' => $post->helper_content
					])
				?>

				<div class="field-group">
					<div class="form-group featured-field  boolean-field_type ">
						<label class="control-label">是否优先显示?</label>
						<p class="text-muted">
							如果该帮助非常重要，请启用优先显示.
						</p>
						<div>
							<label>
							<input
								type="checkbox"
								value="<?php echo $post->featured ?>"
								name="featured"
								data-on-text="YES"
								data-off-text="NO"
								data-disabled="false"
								data-on-color="success"
								data-off-color="danger"
								data-field="featured" 
								data-field_name="featured" 
								data-provides="boone.boolean"
							>
							</label>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php echo $this->load->view('submit') ?>
	<?php echo form_close() ?>
</div>
<script src="/resources/app/boolean/js/bootstrap-switch.js"></script>
<script src="/resources/app/boolean/js/input.js"></script>
<script src="/resources/app/form/translations.js"></script>
<script src="/resources/app/text/jquery.charactercounter.js"></script>
<script src="/resources/app/text/input.js"></script>
<script src="/resources/app/slug/jquery.slugify.js"></script>
<script src="/resources/app/slug/input.js"></script>
<script src="/resources/app/tags/js/bootstrap-tagsinput.min.js"></script>
<script src="/resources/app/tags/js/bootstrap3-typeahead.min.js"></script>
<script src="/resources/app/tags/js/input.js"></script>