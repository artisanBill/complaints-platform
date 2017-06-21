<?php foreach ($permissionModules as $module): ?>
<div class="card">
	<div class="card-label card-label-info">
		<?php echo $module['name'] ?>
	</div>

	<div class="card-block">
		<div class="field-group">
			<div class="form-group checkboxes-field_type">
				<?php if ( isset($module['roles']) && $module['roles']): ?>
					<?php foreach ( $module['roles'] as $name => $method): ?>
					<label class="control-label"> <?php echo $this->lang->line($module['slug'] . '.' . $name) ?> </label>
					<div>
						<?php if ( is_array($method) ): ?>
							<?php foreach ( $method as $item ): ?>
								<div class="c-inputs-stacked">
	<label class="c-input c-checkbox">
		<input 
			type="checkbox" 
			name="permissions[<?php echo $module['slug'] ?>][<?php echo $name ?>][<?php echo $item ?>]" 
			<?php 
				echo (isset($editPermissions[$module['slug']][$name]) AND 
					array_key_exists($item, (array) $editPermissions[$module['slug']][$name]))
				? 'checked="checked"' : ''
			?>
		/>
		<span class="c-indicator"></span>
		<?php echo $this->lang->line($name . '.' . $item) ?>
	</label>
								</div>
							<?php endforeach ?>
						<?php endif ?>
					</div>
					<?php endforeach ?>
				<?php endif ?>
			</div>
		</div>
	</div>
	<div class="card-corner card-corner-info"></div>
</div>
<?php endforeach ?>