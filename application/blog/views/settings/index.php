<div class="card">
	<div class="card-bolck">
		<?php echo form_open() ?>
		<div class="form-group form-group-lg">
			<h5>博客名称</h5>
				<?php echo form_input([
				'name'			=> 'blogName',
				'class'			=> 'form-control',
				'placeholder'	=> '请输入您的博客名字',
				'value'			=> $setting->blogName,
			]) ?>
		</div>
		<br>
		<div class="form-group form-group-lg">
			<h5>域名设置</h5>
			<small>博客开放个性域名，例如: http://www.boone.itousu.net</small>
			<p class="help-block">
				<span class="text-warning">
					<i class="fa fa-warning "></i>
					博客属于您自己的，请输入您的域名，包含数字字母。5-15位
				</span>
			</p>
			<div class="input-group  input-group-lg">
				<span class="input-group-btn">
					<button class="btn btn-primary" type="button">http://www<?php echo BOONE_COOKIE_DOMAIN ?>/center/</button>
				</span>
				<?php echo form_input([
					'name'			=> 'domain',
					'class'			=> 'form-control',
					'placeholder'	=> '请输入您的域名',
					'value'			=>  $setting->domain,
				]) ?>
			</div>
		</div>
		<br>
		<div class="form-group form-group-lg">
			<h5>选择博客主题风格 <small class="text-danger">*</small></h5>
			<div class="select-group">
				<?php echo form_dropdown('theme', [
						'default' => $setting->theme
					], 'default', ['class' => 'btn btn-default btn-lg btn-block']) ?>
				<b class="caret-line"></b>
			</div>
		</div>
		<br><!--  -->
		<div class="form-group form-group-lg">
			<h5>是否允许打赏</h5>
			<div class="input-row form-switch">
				<?php echo form_checkbox([
					'name' => 'reward',
					'id'   => 'defaultLocation',
				], $setting->reward, 1) ?>
				<label for="defaultLocation" class="radius pull-left"></label>
			</div>
		</div><Br>

		<div class="form-group form-group-lg">
			<h5>打赏金额</h5>
			<div class="input-group  input-group-lg">
				<?php echo form_input([
					'name'			=> 'price',
					'class'			=> 'form-control',
					'placeholder'	=> '请输入您期望打赏金额',
					'value'			=> $setting->price
				]) ?>
				<span class="input-group-btn">
					<button class="btn btn-primary" type="button">元 人民币</button>
				</span>
			</div>
		</div>
		<br>

		<div class="form-group form-group-lg">
			<h5>提现 <small class="text-danger">*</small></h5>
			<small>选择体现银行</small>
			<div class="select-group">
				<?php echo form_dropdown('bank', bankAll(), $setting->bank, ['class' => 'btn btn-default btn-lg btn-block']) ?>
				<b class="caret-line"></b>
			</div>
		</div>
		<br>

		<div class="form-group form-group-lg">
			<h5>银行卡号</h5>
				<?php echo form_input([
				'name'			=> 'bankCard',
				'class'			=> 'form-control',
				'placeholder'	=> '请输入您的银行卡号',
				'value'			=> $setting->bankCard,
			]) ?>
		</div>
		
		<br>
		<div class="form-group form-group-lg">
			<h5>简介</h5>
			<small>介绍您的博客</small>
			<?php echo form_textarea([
				'rows'			=> 5,
				'name'			=> 'bio',
				'row'			=> 6,
				'class'			=> 'form-control', 
				'value'			=> $setting->bio
				]) ?>
		</div>

		<div class="form-group">
		<button type="submit" name="submit" value="exit-save" class="btn btn-primary btn-lg" id="create-execute">
			<i class="fa fa-save"></i>
			存储 &amp; 离开
			</button>
		</div>
		<?php echo form_close() ?>
		<span class="card-corner card-corner-success"></span>
	</div>
</div>