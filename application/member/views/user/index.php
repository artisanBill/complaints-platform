<div class="card">
<div class="card-bolck">
	<div class="boone-tab">
		<ul class="tab-item">
			<?php foreach ($userInfoArr as $urlSeg => $nameMenu): ?>
				<li <?php echo ($urlSeg == $active) ? 'class="active"' : '' ?>>
					<a href="/profile?change=<?php echo $urlSeg ?>"><?php echo $nameMenu ?></a>
				</li>
			<?php endforeach ?>
		</ul>
	</div>
	<div class="tab-content">
		<div class="tab-pane fade active in boone-user-info">
			<?php echo form_open(current_url() . '?change=' . $active) ?>
				<?php echo $this->load->view('user/profile/' . $templateFile) ?>

				<div class="form-group">
					<button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">
						<strong>存储</strong>
					</button>
				</div>

			<?php echo form_close() ?>
		</div>
	</div>
	<span class="card-corner card-corner-success"></span>
</div>
</div>