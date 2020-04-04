<?php
session_start();
if ($_SESSION['loginstatus']==1) 
{
	
}
else{
	header("Location:logout.php");
}
$flag=0;
include("../reg/dbconfig.php");
$s_email=$_SESSION['email'];
$loginstatus=$_SESSION['loginstatus'];
//to fetch data from table
$balance_query="SELECT * FROM xie_bank WHERE email='$s_email'";
$balance_run=mysql_query($balance_query,$conn);
$xie_bank=mysql_fetch_assoc($balance_run);

//for updating details

if (isset($_POST['updatebtn'])) {
$u_firstname=$_POST['firstname'];
$u_lastname=$_POST['lastname'];
$u_password=$_POST['password'];
$u_query="UPDATE xie_bank SET firstname='$u_firstname',lastname='$u_lastname',password='$u_password' WHERE email='$s_email'";
$eu=mysql_query($u_query,$conn);
if($eu)
{
	?>
	<script type="text/javascript">
		alert("Updated Successfully");
		window.location="userlogin.php";
	</script>
	<?php
}
else
{
	?>
	<script type="text/javascript">
		alert("Update Failed");
		window.location="userlogin.php";
	</script>
<?php
}
}

//end of update details

//payment code
if (isset($_POST['paybtn'])) {
	$to=$_POST['to'];
	$payment_amount=$_POST['amount'];
	$mybalance=$xie_bank['balance'];
	//fetching samne wale ka balance
	$fq="SELECT * FROM xie_bank WHERE contact='$to'";
	$efq=mysql_query($fq,$conn);
	$samnewala=mysql_fetch_assoc($efq);
	$uskabalance=$samnewala['balance'];
	//adding amount to samnewala
	$uskabalance=$uskabalance+$payment_amount;
	//updating samnewale ka balance in table
	$balance_query="UPDATE xie_bank SET balance='$uskabalance' WHERE contact='$to'";
	$check=mysql_query($balance_query,$conn);
	
	echo "$mybalance";
	echo "$uskabalance";
	if ($check)
	 {
	?>
	<script type="text/javascript">
		alert("Amount Added");
	</script>
	<?php

	 }
	 else
	 {
	 	?>
	 	<script type="text/javascript">
	 		alert("Amount Not Added");
	 	</script>
	 	<?php
	 } 
	 //deducting own balance
	 $mybalance=$mybalance-$payment_amount;
	 //update my balance in table
	 	$balance_query1="UPDATE xie_bank SET balance='$mybalance' WHERE email='$s_email'";
	$check1=mysql_query($balance_query1,$conn);
	if ($check1)
	 {
	?>
	<script type="text/javascript">
		alert("Amount Deducted");
		window.location="userlogin.php";
	</script>
	<?php

	 }
	 else
	 {
	 	?>
	 	<script type="text/javascript">
	 		alert("Amount Not Deducted");
	 		window.location="userlogin.php";
	 	</script>
	 	<?php
	 } 
}




?>

<!DOCTYPE html>
<html>
<head>
	<title>User Account</title>
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
	<a class="navbar-brand" style="color: white" href="#">Hi <?Php echo $xie_bank['firstname']; ?></a>
		</div>
		<div>
			<div class="collapse navbar-collapse" id="mytarget">
				<ul class="nav navbar-nav navbar-right" style="color: white">
					
					<li><a href="logout.php" >Logout</a></li>


					
				</ul>
			</div>
		</div>
	</div>
</nav>
				<!-- Tabs start -->
				<div class="container">
  <h2 style="text-align: center; padding-top: 5%;">Your Account</h2>

  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Your Balance</a></li>
    <li><a data-toggle="tab" href="#menu1">New Payment</a></li>
    <li><a data-toggle="tab" href="#menu2">Update Details</a></li>
    <li><a data-toggle="tab" href="#menu3">Feedback</a></li>
  </ul>

  <div class="tab-content">
  	<!-- Balance Section -->
    <div id="home" class="tab-pane fade in active">
      <h3>Your Balance:  Rs <?php echo $xie_bank['balance']; ?>/-</h3>
    </div>
    <!-- Balance Section Ends -->

    <!-- Payment Section -->
    
    <div id="menu1" class="tab-pane fade">
    	<form method="POST">
      <div class="row">
      	<div class="col-sm-8 col-sm-offset-2 form-group">
      		<h3>New Payment</h3>
      		<input type="number" required="required" class="form-control" name="to" placeholder="CONTACT NUMBER OF USER TO PAY">
      		
      	</div>
      	
      </div>

      <div class="row">
      	<div class="col-sm-8 col-sm-offset-2 form-group">
      		<input type="number" required="required" class="form-control" name="amount" placeholder="AMOUNT TO PAY">
      		
      	</div>
      	
      </div>

      <div class="row">
      	<div class="col-sm-8 col-sm-offset-2 form-group">
      		<input type="submit" class="form-control btn btn-success" name="paybtn" value="PAY">
      		
      	</div>
      	
      </div>
</form>
          </div>
          <!-- Payment Section Ends -->

          <!-- Update section -->
    <div id="menu2" class="tab-pane fade">
    	<form method="POST">
      
      <div class="row">
      	<div class="col-sm-8 col-sm-offset-2 form-group">
      		<h3>Update Details</h3>
      		<input type="text" class="form-control" name="firstname" value="<?php echo $xie_bank['firstname'];  ?>" required="required" placeholder="First Name">
      		
      	</div>
      	
      </div>

        <div class="row">
      	<div class="col-sm-8 col-sm-offset-2 form-group">
      		<input type="text" class="form-control" name="lastname" value="<?php echo $xie_bank['lastname']; ?>" required="required" placeholder="Last Name">
      		
      	</div>
      	
      </div>
       <div class="row">
      	<div class="col-sm-8 col-sm-offset-2 form-group">
      		<input type="password" class="form-control" name="password" required="required" placeholder="Enter Password">
      	</div>	
      	</div>

      	 <div class="row">
      	<div class="col-sm-8 col-sm-offset-2 form-group">
      		<input type="password" class="form-control" name="cpassword" required="required" placeholder="Confirm Password">
      		
      	</div>
      	
      </div>

            <div class="row">
      	<div class="col-sm-8 col-sm-offset-2 form-group">
      		<input type="submit" class="form-control btn btn-success" name="updatebtn" value="Update">
      		
      	</div>
      	
      </div>
</form>
    </div>
    <!-- Update Section Ends -->

    <!-- Feedback Section -->
    <div id="menu3" class="tab-pane fade">
      <div class="row">
      	<div class="col-sm-8 col-sm-offset-2 form-group">
      		<h3>Your Feedback/Queries</h3>
      		<textarea class="form-control" required="required" class="form-control" name="feedback" rows="5" style="resize: vertical;"></textarea>
      		
      	</div>
      </div>
      <div class="row">
      	<div class="col-sm-8 col-sm-offset-2 form-group">
      		<input type="submit" name="feedbackbtn" class="form-control btn btn-primary" value="SUBMIT FEEDBACK">
      	</div>
      </div>
    </div>
    <!-- Feedback Section Ends -->
</div>
</div>
<!-- Tabs end -->


</body>
</html>