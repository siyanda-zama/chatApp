<?php

	session_start();
	require_once 'scripts/chat.php';
	$chat = new Chat;

	if(isset($_POST['btnSubmit']))
	{

		$number = clean($_POST['txtMobile']);
		$password = clean($_POST['txtPassword']);
		$logged = $chat->userLogin($number,$password);
		if($logged === 'valid')
		{
			$_SESSION['number'] = $number;
			exit(header('Location: dash.php'));
		}
		else
		{
			$msg = 'Please ensure mobile number and password are correct!';
		}

	}

	#sanisize inputs
	function clean($data)
	{
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		$data = trim($data);
		return $data;
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>
        Messaging Portal
    </title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="login/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/css/util.css">
	<link rel="stylesheet" type="text/css" href="login/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">

				<form class="login100-form validate-form" method="POST">
                    <img style="height:80px;display:block;margin-left:auto;margin-right:auto;" src="login/images/chat.png" alt=""><br><br>
					<span class="login100-form-title">
						Messaging Portal Login
					</span>

					<?php if(isset($msg) && $msg != ""): ?>

						<div class="alert alert-warning alert-dismissible fade show" role="alert">
							<strong>
								<b><?php echo $msg; ?></b>
							</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>

					<?php endif; ?>

					<div class="wrap-input100 validate-input" data-validate = "Please provide a valid Mobile Number">
						<input name="txtMobile" class="input100" type="text" name="number" placeholder="Mobile Number" autocomplete="off">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-phone" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input name="txtPassword" class="input100" type="password" name="pass" placeholder="Password" autocomplete="off">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name="btnSubmit">
							Login
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/bootstrap/js/popper.js"></script>
	<script src="login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="login/js/main.js"></script>

</body>
</html>