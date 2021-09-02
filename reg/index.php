<?php
include("dbconfig.php");
$flag=0;
if (isset($_POST['submit'])) {
	$firstname=$_POST['firstname'];
	$lastname=$_POST['lastname'];
	$email=$_POST['email'];
	$contact=$_POST['contact'];
	$password=$_POST['password'];
	$cpassword=$_POST['cpassword'];
	$balance=5000;

	//check for password matching
	if ($password!=$cpassword) {
		$flag=1;
		?>
		<script type="text/javascript">
			alert("Passwords Do Not match");
			window.location="../reg/";
		</script>
		<?php
	}

	//email validation in database
	$ev="SELECT * FROM xie_bank WHERE email='$email'";
	$eq=mysql_query($ev,$conn);
	$e_count=mysql_num_rows($eq);
	if($e_count>0)
	{
		$flag=1;
		?>
		<script type="text/javascript">
			alert("Email Already Exists");
			window.location="../reg/"
		</script>
		<?php
	}

	//contact validation in database
	$cv="SELECT * FROM xie_bank WHERE contact='$contact'";
	$cq=mysql_query($cv,$conn);
	$c_count=mysql_num_rows($cq);
	if($c_count>0)
	{
		$flag=1;
		?>
		<script type="text/javascript">
			alert("Contact Already Exists");
			window.location="../reg/"
		</script>
		<?php

	}

	$q="INSERT INTO xie_bank(firstname,lastname,email,contact,password,balance) VALUES('$firstname','$lastname','$email','$contact','$password',$balance)";

	if ($flag==0) {
		$iq=mysql_query($q,$conn);
	}

	if ($iq) {
		?>
		<script type="text/javascript">
			alert("Registered!");
			window.location="../";
		</script>
		<?php
	}
	else
	{

		?>
		<script type="text/javascript">
			alert("Failed!");
			window.location="../reg/";
		</script>
		<?php
	}
	}
?>




 <!DOCTYPE html>
<html>
<head>
	<title>Register</title>
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
	<nav class="navbar navbar-inverse navbar-fixed-top">
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
	<h2 style="text-align: center;">Register For XIE Bank
	</h2>
	<form method="POST">
		<!-- row start -->
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3 form-group">
				<input type="text" class="form-control" name="firstname" required="required" placeholder="First Name Here">
			</div>
		</div>
		<!-- row end -->

		<!-- row start -->
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3 form-group">
				<input type="text" class="form-control" name="lastname" required="required" placeholder="Last Name Here">
			</div>
		</div>
		<!-- row end -->

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
				<input type="numbers" class="form-control" name="contact" required="required" placeholder="Phone No Here">
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
				<input type="password" class="form-control" name="cpassword" required="required" placeholder="Confirm Password">
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