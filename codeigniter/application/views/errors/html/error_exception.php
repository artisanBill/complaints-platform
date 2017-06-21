<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<head>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
</head>
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
<link href='http://fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
<style type="text/css">

::selection{ background-color: #00a0e4; color: white; }
::moz-selection{ background-color: #00a0e4; color: white; }
::webkit-selection{ background-color: #00a0e4; color: white; }
body {
    margin: 0;
    padding: 0;
    width: 100%;
    height: auto;
    color: #888;
    display: table;
    font-weight: 300;
    font-family: 'Lato';
    overflow: hidden;
}
.container {
	margin-top: 1em;
    width: 96%;
    margin-left: 2%;
}
.error-red {
	color: red;
}
</style>

<div class="container">

<h4><strong>An uncaught Exception was encountered</strong></h4>

<p><strong>Type</strong>: <span class="error-red"><?php echo get_class($exception); ?></span></p>
<p><strong>Message</strong>: <span class="error-red"><?php echo $message; ?></span></p>
<p><strong>Filename</strong>: <span class="error-red"><?php echo $exception->getFile(); ?></span></p>
<p><strong>Line Number</strong>: <span class="error-red"><?php echo $exception->getLine(); ?></span></p>

<?php if (defined('SHOW_DEBUG_BACKTRACE') && SHOW_DEBUG_BACKTRACE === TRUE): ?>

	<p><strong>Backtrace:</strong></p>
	<?php foreach ($exception->getTrace() as $error): ?>

		<?php if (isset($error['file']) && strpos($error['file'], realpath(BASEPATH)) !== 0): ?>

			<p>
			<strong>File</strong>: <?php echo $error['file']; ?><br />
			<strong>Line</strong>: <?php echo $error['line']; ?><br />
			<strong>Function</strong>: <?php echo $error['function']; ?>
			</p>
		<?php endif ?>

	<?php endforeach ?>

<?php endif ?>

</div>