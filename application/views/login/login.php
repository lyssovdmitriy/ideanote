<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
	<link rel="stylesheet" href="/static/css/main.css">
	<title>IDEANOTE</title>
</head>
<body>
<div class="message-wrap">
	<?php $msg = H::getMsg(); ?>
	<?php if (is_array($msg)): ?>
			<?php foreach ($msg as $ar_msg): ?>
				<div class="alert alert-<?=$ar_msg['type']?>" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
					<?=$ar_msg['msg']?>
				</div>
			<?php endforeach ?>
	<?php endif ?>
</div>
	<div class="wrap-login">
		<div class="container-login">
			<form action="/login/auth" class="form-horizontal" method="POST">
				<div class="form-group">
					<input type="text" name="login" class="form-control" placeholder="login">		
				</div>
				<div class="form-group">
					<input type="password" name="password" class="form-control" placeholder="password">
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-default float-right">
				</div>
			</form>
		</div>
	</div>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
