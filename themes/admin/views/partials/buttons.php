<?php if ( isset($moduleDetails['sections'][$activeSection]['shortcuts']) ): ?>
	<div id="buttons">
		<?php foreach ( $moduleDetails['sections'][$activeSection]['shortcuts'] as $item ): ?>
			<a 
				class="<?php echo $item['class'] ?>" 
				href="/<?php echo $item['uri'] ?>" 
				<?php echo isset($item['modal']) ? 'data-toggle="modal" data-target="#modal"' : '' ?>
			>
				<i class="fa fa-<?php echo $item['icon'] ?>"></i>
				<?php echo $item['name'] ?>
			</a>
		<?php endforeach ?>
	</div>
<?php endif ?>