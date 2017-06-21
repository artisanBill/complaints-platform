<div class="row">
	<div class="col-sm-8">
		<div class="card">
			<span class="handle card-label card-label-success">
				<i class="fa fa-diamond fa-1x"></i> 快速入口
			</span>
			<?php include __DIR__ . '/iconlink.php' ?>
			<span class="card-corner card-corner-success"></span>
		</div>

		<div class="card">
			<span class="handle card-label card-label-success">
				<i class="fa fa-exclamation-triangle fa-1x"></i> 最新信息
			</span>
			<div class="card-bolck">
				<div class="boone-bottom-border">
					<?php include __DIR__ . '/newmessage.php' ?>
				</div>
				
				<span class="card-corner card-corner-success"></span>
			</div>
		</div>

		<div class="card">
			<span class="handle card-label card-label-success">
				<i class="fa fa-question-circle "></i> 最新帮助
			</span>
			<div class="card-bolck">
				<div class="boone-bottom-border">
					<?php include __DIR__ . '/newhelper.php' ?>
				</div>
				<span class="card-corner card-corner-success"></span>
			</div>
		</div>
	</div>

	<div class="col-sm-4">
		<div class="card">
			<span class="handle card-label card-label-success">
				&raquo; 
				我的资料
			</span>
			<?php include __DIR__ . '/myprofile.php' ?>
		</div>

		<div class="card">
			<span class="handle card-label card-label-success">
				&raquo; 
				系统信息
			</span>
			<?php include __DIR__ . '/systeminfo.php' ?>
		</div>
	</div>
</div>