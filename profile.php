<?php 
$css = "index.css";
include("head.php");
include("header.php");?>
<?php
	$val = new validation;
	if(!$val->is_log("username")) {
		header("Location: login.php?message=true");
	}

	if (isset($_GET["logout"])) {
		$user = new user;
		$user->logout($_GET["logout"]);
	}

	if (!isset($_GET["name"])) {
		//svoj profil
		$name = $_SESSION["username"];
	} else {
		//cudzi profil
		$name = $_GET["name"];
	}

	$dat = new database;
	$row = $dat->select_sql_query("users",["*"], ["username='".$name."'"]);
?>
<section id="last-posts-section" class="col-12 py-5 px-0">
	<div class="heading">
		<h2><i class="icofont-home me-2"></i><a href="index">Forum</a> / Profile</h2>			
	</div>
	<div style="height: 300px; background: white;" class="mt-5 p-4 box-shadow">
		<p><strong><?php echo $name;?></strong></p>
		<p><?php echo $row[0]["status"];?></p>
		<p><?php echo $row[0]["joined"];?></p>
		<hr>
	</div>						
</section>		
<?php include("footer.php");?>