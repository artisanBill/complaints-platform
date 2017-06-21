<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link href='http://fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
<style type="text/css">

::selection{ background-color: #00a0e4; color: white; }
::moz-selection{ background-color: #00a0e4; color: white; }
::webkit-selection{ background-color: #00a0e4; color: white; }
body {
            margin: 12em 0 0 0;
            padding: 0;
            width: 100%;
            height: 100%;
            color: #B0BEC5;
            display: table;
            font-weight: 100;
            font-family: 'Lato';
            overflow: hidden;
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content, p {
            text-align: center;
            display: inline-block;
            font-size: 1.2em;
        }

        .title {
            font-size: 8em;
        }
</style>
<div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

<h4>A PHP Error was encountered</h4>

<p>Severity: <?php echo $severity; ?></p>
<p>Message:  <?php echo $message; ?></p>
<p>Filename: <?php echo $filepath; ?></p>
<p>Line Number: <?php echo $line; ?></p>

<?php if (defined('SHOW_DEBUG_BACKTRACE') && SHOW_DEBUG_BACKTRACE === TRUE): ?>

	<p>Backtrace:</p>
	<?php foreach (debug_backtrace() as $error): ?>

		<?php if (isset($error['file']) && strpos($error['file'], realpath(BASEPATH)) !== 0): ?>

			<p style="margin-left:10px">
			File: <?php echo $error['file'] ?><br />
			Line: <?php echo $error['line'] ?><br />
			Function: <?php echo $error['function'] ?>
			</p>

		<?php endif ?>

	<?php endforeach ?>

<?php endif ?>

</div>