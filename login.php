<?php 
$css = "login.css";
include("head.php");
include("header.php");?>
<?php
	if (isset($_GET["message"]) && $_GET["message"]) {
	 	echo '<div class="alert alert-danger mb-0 mt-5" role="alert">To display this content you need to login first!</div>';
	} 
?>
<section class="col-12 py-5 px-0">
	<div class="heading p-2">
		<h2><i class="icofont-login me-2"></i>Log In</h2>			
	</div>
	<section id="table" class="mt-5 p-4">
		<?php 
		if (isset($_POST["submit"])) {
			$validation = new validation;
			if (!$validation->required($_POST["username"]) || !$validation->required($_POST["password"])) {
				echo '<div class="alert alert-danger" role="alert">Name and password are required!</div>';
			} else if(!$validation->login_check($_POST["username"], $_POST["password"])) {
				echo '<div class="alert alert-danger" role="alert">Wrong name or password!</div>';
			} else {
				$_SESSION["username"] = $_POST["username"];
				header("Location: index.php?logsuc=true");
			}
		}
		?>
		<form class="row g-3 justify-content-center" action="login.php" method="post">
		  <div class="col-lg-12 col-md-6">
		    <label for="inputUsername" class="form-label">Username</label>
		    <input type="input" class="form-control p-2" id="inputUsername" name="username">
			<small class="form-text text-muted">Your username</small>
		  </div>
		  <div class="col-lg-12 col-md-6">
		    <label for="inputPassword4" class="form-label">Password</label>
		    <input type="password" class="form-control p-2" id="inputPassword4" name="password">
		    <small class="form-text text-muted">Your password</small>
		  </div>
		  <div class="col-12">
		    <button type="submit" class="btn btn-primary" name="submit">Log in</button>
		  </div>
		  <div class="col-12">
			 <a href="register.php"><p>Still dont have an account? Register here</p></a>	  	
		  </div>
		</form>				
	</section>	
</section>
<?php include("footer.php");?>