<!DOCTYPE html>
<html lang="en">
<head>
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
<title><?php echo $heading; ?></title>
<link href='http://fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
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
</head>
<body>
	<div class="container">
    <div class="content">
        <div class="title">
            404
        </div>
        <p><?php echo $message; ?></p>
    </div>
</div>
</body>
</html>