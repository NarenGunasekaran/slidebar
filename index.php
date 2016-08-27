<?php
session_start();
?>
<html>
<head>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="bootstrap/css/style.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
</head>
<body>
	<div class="clear">
	<div class="container">
		<div class="jumbotron">
		<form method="POST" action="connect.php">
			<div class="row">
				<div class="col-lg-6">
					<input type="text" name="name"/>
				</div>
			</div>
			<div class="clear1">
			<div class="row">
				<div class="col-lg-6">
					<input type="password" name="password"/>
				</div>
			</div>
			<div class="clear1">
			<div class="row">
				<div class="col-lg-6">
					<button name="submit" class="btn btn-primary">Submit</button>
				</div>
			</div>
		</form>	
		</div>
	</div>

<script src="bootstrap/js/bootstrap.min.js"></script>
</script>
</body>
</html>