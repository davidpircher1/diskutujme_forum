<?php 
$css = "index.css";
include("head.php");
include("header.php");?>
<?php
	$val = new validation;
	if($val->is_log("username")) {
		if(isset($_GET["logsuc"])) {
			echo '<div class="alert alert-success mb-0 mt-5" role="alert"><h4 class="alert-heading">Successfuly logged in!</h4>Welcome '.$_SESSION["username"].'</div>';
		} 
	}
	if (isset($_GET["logout"])) {
		$user = new user;
		$user->logout($_GET["logout"]);
	}
?>
<section id="last-posts-section" class="col-12 py-5 px-0">
	<div class="heading">
		<h2><i class="icofont-home me-2"></i>Forum</h2>			
	</div>
	<table class="mt-4 table table-striped">
	  <tr>
	  	<th></th>
	    <th>Last category</th>
	    <th class="d-none d-md-table-cell d-lg-table-cell">Threads</th>
	    <th class="d-none d-md-table-cell d-lg-table-cell">Posts</th>
	    <th>Last Post By</th>
	  </tr>
	    <?php
	    	$dat = new database;
	    	$row = $dat->select_sql_query("category", ["*"],0,[], 1, 6);
	    	for ($i=0; $i < count($row) ; $i++) { 
	    		echo "<tr>";
				if($val->is_log("username")) {
					echo "<td class='text-center'><i class='icofont-chat'></i></td>";
				} else {
					echo "<td class='text-center'><i class='icofont-lock'></i></td>";
				}
	    		echo "<td><a href='category.php?catname=".$row[$i]["name"]."&id=".$row[$i]["id"]."&page=1' class='category-name'>".$row[$i]["name"]."</a></td>";
				echo "<td class='d-none d-md-table-cell d-lg-table-cell'>".$dat->count_sql_query("thread", ["*"],["category = ".$row[$i]['id']])."</td>";
				//ziskanie id threadov, ktore maju pozadovanu kategoriu
				$row_thread = $dat->select_sql_query("thread", ["id"], ["category = ".$row[$i]['id']]);
				//pokial je thread prazdny, tak nie su ziadne posty a neexistuje ani last post => 0 vsade
				if(empty($row_thread)) {
					echo "<td class='d-none d-md-table-cell d-lg-table-cell'>0</td>";
					echo "<td>No last post</td>";
				} else {
					//prevod asociativneho pola na normalne pole
					$thread_id = array_column($row_thread, 'id');
					//podmienka do sql prikazu, kde menime pole na string a oddelime ho ","
					$condition = "thread IN (" . implode(",", $thread_id) . ")";
					//vypis samotneho poctu, kde pouzivame podmienku, aby sa nachadzala hodnota thread v nasom stringu
					echo "<td class='d-none d-md-table-cell d-lg-table-cell'>".$dat->count_sql_query("post", ["*"],[$condition])."</td>";

					$post_author = $dat->order_sql_query("post", ["author", "date"], [$condition], "id", "DESC", 1);
					$author = $dat->select_sql_query("users", ["username"], ["id =". $post_author[0]["author"]]);
					echo "<td><a class='author-name' href='profile.php?name=".$author[0]["username"]."'>".$author[0]["username"]."</a>".$post_author[0]["date"]."</td>";
				}
	    		echo "</tr>";
	    	}
	    	unset($dat);
	    ?>				  		
	</table>						
</section>		
<?php include("footer.php");?>