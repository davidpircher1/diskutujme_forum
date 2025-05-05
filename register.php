<?php 
$css = "login.css";
include("head.php");
include("header.php");?>
<section class="col-12 py-5 px-0">
	<div class="heading p-2">
		<h2><i class="icofont-login me-2"></i>Register</h2>			
	</div>
	<section id="table" class="mt-5 p-4">
		<?php
			$valid_obj = new validation;
			if (isset($_POST["submit"])) {
				//Username validation
			 	if (($valid_obj->required($_POST["username"]) && $valid_obj->min_lenght($_POST["username"], 3) && $valid_obj->max_lenght($_POST["username"], 16))  == false) {
			 		echo '<div class="alert alert-danger" role="alert">Username is required, and must be 3-16 characters long.</div>';
			 	} else if (!$valid_obj->original_name($_POST["username"])) {
			 		echo '<div class="alert alert-danger" role="alert">Username is already in use.</div>';			 		
			 	}
			 	//Email validation
			 	else if(($valid_obj->required($_POST["email"]) && $valid_obj->email_check($_POST["email"])) == false) {
			 		echo '<div class="alert alert-danger" role="alert">Email is required, should be like name@mail.com.</div>';
			 	} else if (!$valid_obj->original_email($_POST["email"])) {
			 		echo '<div class="alert alert-danger" role="alert">Email is already in use.</div>';	
			 	}
			 	//Password validation
			 	else if (($valid_obj->required($_POST["password"]) && $valid_obj->min_lenght($_POST["password"],12) && $valid_obj->password_check($_POST["password"])) == false) {
			 		echo '<div class="alert alert-danger" role="alert">Password is required, should contain number, uppercase letter and must be at least 12 characters long.</div>';			 		
			 	} else {
			 		//zapis do databazy ;)
			 		$database = new database;
			 		$username = $valid_obj->sqlInjection($valid_obj->secure_input($_POST["username"]));
			 		$email = $valid_obj->sqlInjection($valid_obj->secure_input($_POST["email"]));
			 		$password = $valid_obj->sqlInjection($valid_obj->secure_input($_POST["password"]));
			 		$password = $valid_obj->hash_pass($password);
			 		if($database->insert_sql_query("users",['username' => $username, 'email' => $email, 'password' => $password, 'joined' => $_POST["joined"]])) {
			 			echo '<div class="alert alert-success" role="alert">Successfuly registered!</div>';
			 		} else {
			 			echo '<div class="alert alert-danger" role="alert">Something went wrong. :(</div>';
			 		}

			 	}
			}
		?>
		<form class="row g-3 justify-content-center" action="register.php" method="post">
			<div class="col-lg-12 col-md-8">
			    <label for="inputUsername" class="form-label">Username</label>
			    <input type="text" class="form-control p-2" id="inputUsername" name="username" value="<?php echo $valid_obj->set_value('username');?>">
			    <small class="form-text text-muted">A unique name that you will use to log-in.<br>It must be 3-16 characters long.</small>
			</div>
		  <div class="col-lg-12 col-md-8">
		    <label for="inputEmail4" class="form-label">Email</label>
		    <input type="email" class="form-control p-2" id="inputEmail4" name="email" value="<?php echo $valid_obj->set_value('email');?>">
			<small class="form-text text-muted">We'll never share your email with anyone else.</small>
		  </div>
		  <div class="col-lg-12 col-md-8">
		    <label for="inputPassword4" class="form-label">Password</label>
		    <input type="password" class="form-control p-2" id="inputPassword4" name="password">
			<small class="form-text text-muted">
			Set a complex password with minimum 12 characters.<br/>
			It must contain a capital letter [A-Z]<br/>
			It must contain a number [0-9]<br/>
			</small>
		  </div>
		  <div class="col-12">
		  	<input type="text" name="joined" value="<?php echo date('Y-m-d H:i:s');?>" class="d-none">
		    <button type="submit" class="btn btn-primary" name="submit">Sign in</button>
		  </div>
		  <div class="col-12">
			 <a href="login.php"><p>Already have an account? Log in here</p></a>	  	
		  </div>
		</form>				
	</section>	
</section>
<?php include("footer.php");?>