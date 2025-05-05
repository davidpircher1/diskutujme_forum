<?php 
$css = "index.css";
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
?>
<section id="last-posts-section" class="col-12 py-5 px-0">
	<div class="heading">
		<h2><i class="icofont-home me-2"></i><a href="index.php">Forum</a> / <?php echo $_GET["catname"];?></h2>			
	</div>
	<table class="mt-4 table table-striped">	
		<tr>
		  	<th></th>
		    <th>Title</th>
		    <th class="d-none d-md-table-cell d-lg-table-cell">Author</th>
		    <th class="d-none d-md-table-cell d-lg-table-cell">Replies</th>
		    <th class="d-none d-md-table-cell d-lg-table-cell">Views</th>
			<th>Last Post By</th>
		</tr>		  		
	    <?php
	    	$dat = new database;
	    	$row = $dat->select_sql_query("thread", ["*"], ["category = ".$_GET["id"]], ["id DESC"], $_GET["page"], 5);
	    	for ($i=0; $i < count($row) ; $i++) { 
	    		echo "<tr>";
				echo "<td class='text-center'><i class='icofont-papers'></i></td>";
	    		echo "<td><a href='thread.php?catname=".$_GET["catname"]."&catid=".$_GET["id"]."&threadname=".$row[$i]["name"]."&id=".$row[$i]["id"]."&page=1' class='category-name'>".$row[$i]["name"]."</a></td>";
				$author = $dat->select_sql_query("users", ["username"], ["id =". $row[0]["author_id"]]);
				echo "<td class='d-none d-md-table-cell d-lg-table-cell'><a class='author-name' href='profile.php?name=".$author[0]["username"]."'>".$author[0]["username"]."</a></td>";
				//ziskanie poctu postov, pre id threadu
				$post_count = $dat->count_sql_query("post", ["id"], ["thread = ".$row[$i]['id']]);
				echo "<td class='d-none d-md-table-cell d-lg-table-cell'>".$post_count."</i></td>";
				echo "<td class='d-none d-md-table-cell d-lg-table-cell'>".$row[$i]["views"]."</i></td>";
				$post_author = $dat->order_sql_query("post", ["author", "date"], ["thread = ".$row[$i]['id']], "id", "DESC", 1);
				if(!empty($post_author)) {
					$author = $dat->select_sql_query("users", ["username"], ["id =". $post_author[0]["author"]]);
					echo "<td><a class='author-name' href='profile.php?name=".$author[0]["username"]."'>".$author[0]["username"]."</a>".$post_author[0]["date"]."</td>";
				} else {
					echo "<td><p>No last post</p></td>";
				}
	    		echo "</tr>";
	    	}
	    ?>	
	</table>		
	<div class="pages">
		<div class="row g-0 justify-content-between">
			<div class="col-3 row">
				<?php
		    		$usr = new user;
		    		$threads_count = $dat->count_sql_query("thread", ["*"], ["category=".$_GET["id"]]);
		    		$usr->pages($_GET["page"], $threads_count, 5); 
		    		unset($dat);unset($usr);
				?>				
			</div>
			<div class="col-3 text-end">
				<a href="<?php echo 'create_thread.php?catname='.$_GET["catname"].'&id='.$_GET["id"]?>" class="btn btn-primary">Create Thread</a>
			</div>	
		</div>
	</div>			
</section>		
<?php include("footer.php");?>