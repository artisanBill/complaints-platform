<?php foreach ($settings as $setting): ?>
	<div class="field-group">
	    <div class="form-group name-field text-field_type">
	        <label class="control-label"><?php echo lang('setting.' . $setting->slug . '.title') ?></label>
	        <p class="text-muted">
				<?php echo lang('setting.' . $setting->slug . '.desc') ?>
	        </p>
	        <div>
	            <?php echo $setting->formControl ?>
	            <!-- <small class="counter text-muted">
	                <span class="count">143</span>
	                characters remaining.
	            </small> -->
	        </div>
	    </div>
	</div>
<?php endforeach ?>