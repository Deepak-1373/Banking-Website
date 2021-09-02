 <?php
session_start();
 include("../reg/dbconfig.php");
 if (isset($_POST['submit'])) {
 	$email=$_POST['email'];
 	$password=$_POST['password'];

 	$lq="SELECT * FROM xie_bank WHERE email='$email' AND password='$password' ";
 	$elq=mysql_query($lq,$conn);
 	$count=mysql_num_rows($elq);
 	if ($count==1) {
 		$_SESSION['loginstatus']=1;
 		$_SESSION['email']=$email;
 		header('Location:userlogin.php');
 	}
 	else
 	{
 		?>
 		<script type="text/javascript">
 			alert("Login Failed");
 		</script>
 		<?php
 	}
 }
 ?>

 <!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<!-- Meta encoding -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial scale=1">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<!-- BOOTSTRAP CDN -->
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- BOOTSTRAP CDN END -->
<!-- icon code -->
<link rel="icon" type="image/jpeg" href="">
<style type="text/css">
	.btn2{
		color: white;
		background: #purple;
		text-transform: uppercase;
		border: 2px solid white;
		padding: 5px;
		border-radius: 100%;
	}
</style>
</head>
<body>
	<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mytarget">
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</button>
	<a class="navbar-brand" style="color: white" href="#">Banking</a>
		</div>
		<div>
			<div class="collapse navbar-collapse" id="mytarget">
				<ul class="nav navbar-nav navbar-right" style="color: white">
					
					<li><a href="../" >Home</a></li>
					
				</ul>
			</div>
		</div>
	</div>
</nav>

<!-- Registration form -->
<div class="container-fluid" style="padding-top: 3%">
	<h2 style="text-align: center;">Login 
	</h2>
	<form method="POST">
		
		<!-- row start -->
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3 form-group">
				<input type="email" class="form-control" name="email" required="required" placeholder="Email ID Here">
			</div>
		</div>
		<!-- row end -->

		<!-- row start -->
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3 form-group">
				<input type="password" class="form-control" name="password" required="required" placeholder="Enter Password">
			</div>
		</div>
		<!-- row end -->

				<!-- row start -->
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3 form-group">
				<input type="Submit" class="btn btn-primary form-control" name="submit">
			</div>
		</div>
		<!-- row end -->
	</form>
</div>



</body>
</html>