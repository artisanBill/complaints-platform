<div class="field-group">
	<div class="form-group status-field  boolean-field_type ">
		<label class="control-label">启用该文章?</label>
		<p class="text-muted">
			如果禁用，您仍可以访问控制面板中的一个安全的预览链接.
		</p>
		<p class="help-block">
			<span class="text-warning"> <i class="fa fa-warning "></i>
				这个文章必须启用可以被看作<strong>前公开</strong> .
			</span>
		</p>
		<div>
			<label>
				<input
					type="checkbox"
					name="status"
					value="<?php echo $post->status ?>"
					data-on-text="YES"
					data-off-text="NO"
					data-disabled="false"
					data-on-color="success"
					data-off-color="danger"
					data-field="status" 
					data-field_name="status" 
					data-provides="boone.boolean"
				>
			</label>
		</div>
	</div>
</div>

<div class="field-group">
	<div class="form-group featured-field  boolean-field_type ">
		<label class="control-label">这是一个有特色的帖子?</label>
		<p class="text-muted">
			精选文章可以用来让人们关注.
		</p>
		<p class="help-block">
			<span class="text-warning"> <i class="fa fa-warning "></i>
				这取决于你的网站是如何构建的，这可能会或可能不会有效果.
			</span>
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

<div class="field-group">
	<div class="form-group enableComment-field  boolean-field_type ">
		<label class="control-label">启用评论?</label>
		<p class="text-muted">
			让用户对该文章发表建议或观点.
		</p>
		<div>
			<label>
			<input
				type="checkbox"
				value="<?php echo $post->enableComment ?>"
				name="enableComment"
				data-on-text="YES"
				data-off-text="NO"
				data-disabled="false"
				data-on-color="success"
				data-off-color="danger"
				data-field="enableComment" 
				data-field_name="enableComment" 
				data-provides="boone.boolean"
			>
			</label>
		</div>
	</div>
</div>

<div class="field-group">
	<div class="form-group postPublishAt-field datetime-field_type ">
		<label class="control-label">
			发布日期/时间
			<span class="required">*</span>
		</label>

		<p class="text-muted">指定发布日期/时间为这个文章.</p>
		<p class="help-block">
			<span class="text-warning"> <i class="fa fa-warning "></i>
				如果设置为将来, 这个文章将不可见在那之前.
			</span>
		</p>
		<div>
			<div class="input-group">
				<span class="input-group-addon icon" style="cursor: pointer;">
				<i class="fa fa-calendar"></i>
				</span>
				<input
					type="text"
					class="form-control datepicker"
					data-min=""
					data-max=""
					name="postPublishAt[date]"
					value=""
					placeholder="<?php echo date(Setting::get('dateFormat'), time()) ?>"
					data-date-format="<?php echo Setting::get('dateFormat') ?>"
					data-field="publish_at" data-field_name="postPublishAt" data-provides="boone.datetime"
					required
					>
				<span class="input-group-addon icon" style="cursor: pointer;">
					<i class="fa fa-clock-o"></i>
				</span>
				<input
					type="text"
					class="form-control timepicker"
					name="postPublishAt[time]"
					value="8:57 AM"
					placeholder="8:57 AM"
					data-time-format="g:i A"
					data-step="15"
					data-field="publish_at" data-field_name="postPublishAt" data-provides="boone.datetime"
					>
				<span class="input-group-addon">UTC</span>
			</div>
		</div>
	</div>
</div>