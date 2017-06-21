<div class="field-group">
	<div class="form-group config.buttons-field checkboxes-field_type">
		<label class="control-label">按钮</label>
		<p class="text-muted">指定要显示的编辑按钮.</p>
		<div>
			<div class="c-inputs-stacked">
				<?php foreach ( $configurations['buttons'] as $item): ?>
				<label class="c-input c-checkbox">
					<input type="checkbox" value="<?php echo $item ?>" name="buttons[]" checked>
					<span class="c-indicator"></span>
					<?php echo ucfirst($item) ?>
				</label>
				<?php endforeach ?>
			</div>
		</div>
	</div>
</div>

<div class="field-group">
	<div class="form-group config.plugins-field checkboxes-field_type">
		<label class="control-label">插件</label>
		<p class="text-muted">指定要显示的插件.</p>
		<div>
			<div class="c-inputs-stacked">
				<?php foreach ( $configurations['plugins'] as $item): ?>
				<label class="c-input c-checkbox">
					<input type="checkbox" value="<?php echo $item ?>" name="plugins[]" checked>
					<span class="c-indicator"></span>
					<?php echo ucfirst($item) ?>
				</label>
				<?php endforeach ?>
			</div>
		</div>
	</div>
</div>

<div class="field-group">
	<div class="form-group config.height-field integer-field_type ">
		<label class="control-label">
			高度
			<span class="required">*</span>
		</label>
		<p class="text-muted">指定像素编辑器高度.</p>
		<div>
			<input
			type="text"
			class="form-control"
			value="400"
			name="height"
			data-min="<?php echo $height['config']['min'] ?>"
			data-max=""
			data-step="<?php echo $height['config']['step'] ?>"
			placeholder=""
			data-field="config.height" data-field_name="config.height" data-provides="<?php echo $height['type'] ?>"
			>
		</div>
	</div>
</div>

<div class="field-group">
	<div class="form-group config.line_breaks-field boolean-field_type">
		<label class="control-label">换行符</label>
		<p class="text-muted">使用换行符而不是段落标记?</p>
		<div>
			<label>
				<input
				type="checkbox"
				name="lineBreaks"
				data-on-text="YES"
				data-off-text="NO"
				data-disabled="false"
				data-on-color="success"
				data-off-color="danger"
				data-field="config.line_breaks" data-field_name="config.line_breaks" data-provides="boone.boolean"
				>
			</label>
		</div>
	</div>
</div>