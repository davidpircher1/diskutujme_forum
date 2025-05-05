<?php 
$css = "login.css";
include("head.php");
include("header.php");?>
<?php
	$val = new validation;
	if(!$val->is_log("username")) {
		header("Location: login?message=true");
	}

	if (isset($_GET["logout"])) {
		$user = new user;
		$user->logout($_GET["logout"]);
	}
	$valid_obj = new validation;
	$usr = new user;
?>
<section class="col-12 py-5 px-0">
	<div class="heading">
		<h2><i class="icofont-home me-2"></i><a href="index">Forum</a> / <a href="<?php echo 'category.php?catname='.$_GET["catname"].'&id='.$_GET["id"].'&page=1'?>"><?php echo $_GET["catname"]?></a> / Create thread</h2>			
	</div>		
	<section id="table" class="mt-5 p-4">
		<?php
			if (isset($_POST["submit"])) {
				//Threadname validation
			 	if (($valid_obj->required($_POST["threadname"]) && $valid_obj->min_lenght($_POST["threadname"], 6) && $valid_obj->max_lenght($_POST["threadname"], 20))  == false) {
			 		echo '<div class="alert alert-danger" role="alert">Thread name is required, and must be 6-20 characters long.</div>';
			 	}
			 	//Message validation
			 	else if(($valid_obj->required($_POST["message"]) && $valid_obj->min_lenght($_POST["message"], 64) && $valid_obj->max_lenght($_POST["message"], 1024))  == false) {
			 		echo '<div class="alert alert-danger" role="alert">Message, and must be 64-1024 characters long.</div>';			 		
			 	} else {
			 		//zapis do databazy ;)
			 		$database = new database;
			 		$threadname = $valid_obj->sqlInjection($valid_obj->secure_input($_POST["threadname"]));
			 		$message = $valid_obj->sqlInjection($valid_obj->secure_input($_POST["message"]));
			 		$author_id = $database->select_sql_query("users", ["id"], ["username = '". $_SESSION["username"]."'"]);
			 		$thread_id = $database->select_sql_query("thread", ["id"], 0, ["id DESC"], 0, 1);
			 		$thread_id[0]["id"]++;
			 		if($database->insert_sql_query("thread",['name' => $threadname, 'author_id' => $author_id[0]["id"], 'category' => $_GET["id"], 'views' => "1"]) && $database->insert_sql_query("post",['message' => $message, 'author' => $author_id[0]["id"], 'date'=>$_POST["date"],'thread' => $thread_id[0]["id"]])) {
			 			echo '<div class="alert alert-success" role="alert">Successfuly added!</div>';
			 		} else {
			 			echo '<div class="alert alert-danger" role="alert">Something went wrong. :(</div>';
			 		}

			 	}
			}
		?>
		<form class="row g-3 justify-content-center" action="<?php echo $usr->getUrl();?>" method="post">
		  <div class="col-lg-12 col-md-8">
		    <label for="inputThreadName" class="form-label">Thread name</label>
		    <input type="text" class="form-control p-2" id="inputThreadName" name="threadname" value="<?php echo $valid_obj->set_value('threadname');?>">
		    <small class="form-text text-muted">A characterising name for the thread.<br>It must be 6-20 characters long.</small>
		  </div>
		  <div class="col-lg-12 col-md-8">
  			<label for="exampleFormControlTextarea1" class="form-label">Message</label>
  			<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="message"><?php echo $valid_obj->set_value('message');?></textarea>
			<small class="form-text text-muted">Your message in thread.<br>It must be  64-1024 characters long.</small>
		  </div>
		  <div class="col-12">
		  	<input type="text" name="date" value="<?php echo date('Y-m-d H:i:s');?>" class="d-none">
		    <button type="submit" class="btn btn-primary" name="submit">Create thread</button>
		  </div>
		</form>			
	</section>
</section>		
<?php include("footer.php");?>