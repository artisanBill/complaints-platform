<div class="form-group form-group-lg">
	<h5>身份证号码</h5>
	<small>真实身份证号码,保证您在本站发布信息的真实性!
		<span class="text-danger">请勿占用他人身份信息! 涉及法律一律追究责任.</span>
	</small>
	<p class="help-block">
        <span class="text-warning">
            <i class="fa fa-warning "></i>
           	本信息一次填写终身禁止修改!
        </span>
    </p>
    <?php if ( $cardStatu ): ?>
	<label class="form-control disabled" disabled=disabled>
		<?php echo substr_replace($cardStatu, "●●●●-●●●●-●●-●●-●●", 2, 14) ?>
	</label>
	<small class="text-muted text-success">
		恭喜您已经成功身份证认证
	</small>
    <?php else: ?>
    	<?php echo form_input([
			'rows'			=> 5,
			'name'			=>'card', 
			'class'			=> 'form-control', 
			'placeholder'	=> '请输入您的身份证号码', 
			'value'			=> $this->currentUser->card,
		]) ?>
    <?php endif ?>
	
</div>