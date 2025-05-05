<?php 
$css = "index.css";
include("head.php");
include("header.php");?>
<?php
	$val = new validation;
	$dat = new database;
	if(!$val->is_log("username")) {
		header("Location: login?message=true");
	}
?>
<section id="last-posts-section" class="col-12 py-5 px-0">
	<div class="heading">
		<h2><i class="icofont-home me-2"></i><a href="index">Forum</a> / <a href="<?php echo 'category.php?catname='.$_GET["catname"].'&id='.$_GET["catid"].'&page=1'?>"><?php echo $_GET["catname"]?></a> / <?php echo $_GET["threadname"];?></h2>			
	</div>
	<?php
	if(isset($_POST["submit"])) {
		$message = trim($val->sqlInjection($val->secure_input($_POST["message"])));
		$author_id = $dat->select_sql_query("users", ["id"], ["username = '". $_SESSION["username"]."'"]);
		if(($val->required($message) && $val->min_lenght($message, 64) && $val->max_lenght($message, 1024))  == false) {
			echo '<div class="alert alert-danger mt-4" role="alert">Message, and must be 64-1024 characters long.</div>';			 		
		} else {
	 		if($dat->insert_sql_query("post",['message' => $message, 'author' => $author_id[0]["id"], 'date'=> $_POST["date"],'thread' => $_GET["id"]])) {
	 			echo '<div class="alert alert-success mt-4" role="alert">Successfuly added!</div>';
	 		} else {
	 			echo '<div class="alert alert-danger mt-4" role="alert">Something went wrong. :(</div>';
	 		}			
		}
	}
	?>
	<table class="mt-4 table table-striped">	
		<tr>
		  	<th class="ps-3"><?php echo $_GET["threadname"];?></th>
		</tr>
		<?php
		    $row = $dat->select_sql_query("post", ["*"], ["thread = ".$_GET["id"]], ["id ASC"], $_GET["page"], 5);
		    for ($i = 0; $i < count($row); $i++) {
		    	$author = $dat->select_sql_query("users", ["*"], ["id = ".$row[$i]["author"]]);
		    	echo "<tr><td><a class='author-name' href='profile.php?name=".$author[0]["username"]."'>".$author[0]["username"]."</a>Posted: ".$row[$i]["date"]."</td></tr>";
		    	echo "<tr><td>".$row[$i]["message"]."</td></tr>";
		    }
		?>		  			
	</table>			
	<div class="pages">
		<div class="row g-0 justify-content-between">
			<div class="col-3 row">
				<?php
		    		$usr = new user;
		    		$post_count = $dat->count_sql_query("post", ["*"], ["thread=".$_GET["id"]]);
		    		$usr->pages($_GET["page"], $post_count, 5); 
				?>				
			</div>
		</div>
	</div>
	<form class="row g-3 justify-content-center mt-1" action="<?php echo $usr->getUrl();?>" method="post">
	  <div class="col-lg-12 col-md-8">
			<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="message" style="resize: none;"><?php echo $val->set_value('message');?></textarea>
		<small class="form-text text-muted">Your message.<br>It must be 64-1024 characters long.</small>
	  </div>
	  <div class="col-12">
	  	<input type="text" name="date" value="<?php echo date('Y-m-d H:i:s');?>" class="d-none">
	    <button type="submit" class="btn btn-primary" name="submit">Send message</button>
	  </div>
	</form>				
</section>	
<?php include("footer.php");?>