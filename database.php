<?php 
session_start();
$mysqli = new mysqli("localhost", "root", "root", "diskutujme");

$mysqli->set_charset('utf8');

class database {
	public function select_sql_query($table_name, $items_to_select, $conditions = null, $order_by = null, $page = null, $limit = 10) {
	    global $mysqli;
	    // Položky oddělené čárkou
	    $items = implode(", ", $items_to_select);

	    // Konstrukce WHERE části SQL příkazu na základě podmínek
	    $where_clause = "1";
	    if ($conditions != null) {
	        $where_clause = implode(" AND ", $conditions);
	    }

	    // Konstrukce ORDER BY části SQL příkazu
	    $order_clause = "";
	    if ($order_by != null) {
	        $order_clause = "ORDER BY " . implode(", ", $order_by);
	    }

	    // Konstrukce OFFSET části SQL příkazu na základě podmínek
	    $offset = "";
	    if ($page != null) {
	        $offset = "LIMIT $limit OFFSET " . ($page - 1) * $limit;
	    }

	    // Spojení částí příkazu dohromady
	    $sql_query = "SELECT $items FROM $table_name WHERE $where_clause $order_clause $offset";
	    //echo $sql_query;
	    $result = $mysqli->query($sql_query);
	    $rows = array(); // Pole pro ukládání výsledků
	    while ($row = mysqli_fetch_assoc($result)) {
	        $rows[] = $row;
	    }
	    return $rows;
	}


	public function delete_sql_query($table_name, $conditions = null) {
		global $mysqli;
		// Konštrukcia WHERE časti SQL príkazu na základe podmienok
		$where_clause = "";
	    if ($conditions != null) {
	        $where_clause = implode(" AND ", $conditions);
	    }
	   	// Spojenie častí príkazu dokopy
	    $sql_query = "DELETE FROM $table_name WHERE $where_clause";
		$mysqli->query($sql_query);
		if ($mysqli->affected_rows > 0)
			return true;
		else
			return false;
	}

	public function insert_sql_query($table_name, $values) {
		global $mysqli;
		//ziskame nazvy columns z asociativneho pola
		$columns = array_keys($values);
	    $column_names = "`".implode("`, `", $columns)."`";
	    $column_values = "'" . implode("', '", $values) . "'";

		$sql_query = "INSERT INTO $table_name ($column_names) VALUES ($column_values)";
		$mysqli->query($sql_query);
		echo mysqli_error($mysqli);
		if ($mysqli->affected_rows > 0)
			return true;
		else
			return false;
	}

	public function update_sql_query($table_name, $values, $conditions = null) {
		global $mysqli;
		// Konštrukcia WHERE časti SQL príkazu na základe podmienok
		$where_clause = "";
	    if ($conditions != null) {
	        $where_clause = implode(" AND ", $conditions);
	    }		

		$data_keys = array_keys($values); // Získame kľúče pola $data
		$data_values = array_values($values); // Získame hodnoty pola $data

		$set = ""; // Inicializujeme premennú $set

		for ($i = 0; $i < count($values); $i++) {
		    if (!empty($set)) {
		        $set .= ", ";
		    }
		    $set .= "`" . $data_keys[$i] . "` = '" . $data_values[$i] . "'";
		}	
		$sql_query = "UPDATE $table_name SET $set WHERE $where_clause";    
		$mysqli->query($sql_query);
		if ($mysqli->affected_rows > 0)
			return true;
		else
			return false;
	}

	public function count_sql_query($table_name, $items_to_select, $conditions = null) {
		global $mysqli;
	    // itmes oddelene ciarkou
	    $items = implode(", ", $items_to_select);
	    
	    // Konštrukcia WHERE časti SQL príkazu na základe podmienok
	    $where_clause = "1";
	    if ($conditions != null) {
	        $where_clause = implode(" AND ", $conditions);
	    }
	    // Spojenie častí príkazu dokopy
	    $sql_query = "SELECT COUNT($items) as total FROM $table_name WHERE $where_clause";
	    $result = $mysqli->query($sql_query);
	    if(!$result)
	    	return 0;
	    $row = mysqli_fetch_assoc($result);
	    return $row["total"];
	}

	public function order_sql_query($table_name, $items_to_select, $conditions = null, $order = null, $desc = "DESC", $limit = 10) {
		global $mysqli;
	    // itmes oddelene ciarkou
	    $items = implode(", ", $items_to_select);
	    
	    // Konštrukcia WHERE časti SQL príkazu na základe podmienok
	    $where_clause = "1";
	    if ($conditions != null) {
	        $where_clause = implode(" AND ", $conditions);
	    }
	    $order_clause = "";
	    if ($order != null) {
	        $order_clause = "ORDER by $order $desc";
	    }
	    // Spojenie častí príkazu dokopy
	    $sql_query = "SELECT $items FROM $table_name WHERE $where_clause $order_clause LIMIT $limit";
	    //echo $sql_query;
	    $result = $mysqli->query($sql_query);
	    $rows = array(); // Pole pre ukladanie výsledkov
	    while ($row = mysqli_fetch_assoc($result)) {
	        $rows[] = $row;
	    }
	    return $rows;
	}

	public function sqlInjection($var) {
		global $mysqli;
		return $mysqli->real_escape_string($var);
	}

	public function hash_pass($password) {
		return password_hash($password, PASSWORD_DEFAULT);
	}
}

class validation extends database {
	public function secure_input($input) {
		$input = mb_convert_encoding($input, 'UTF-8', 'UTF-8');
		$input = strip_tags($input);
	    return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
	} 

    public function required($var) {
        $var = trim($var);
        if (!isset($var) || empty($var)) {
            return false;
        }
        return true;
    }

    public function min_lenght($string, $lenght = 10) {
    	$string = trim($string);
    	$str_lenght = mb_strlen($string, "utf8");
    	if ($str_lenght < $lenght) {
    		return false;
    	}
    	return true;
    }

    public function max_lenght($string, $lenght = 10) {
    	$string = trim($string);
    	$str_lenght = mb_strlen($string, "utf8");
    	if ($str_lenght > $lenght) {
    		return false;
    	}
    	return true;
    }

	public function original_name($name) {
		$name = trim($name);
	    $usernames = parent::select_sql_query("users", ["username"]);
	    foreach ($usernames as $user) {
	        // Predpokladáme, že každá položka v $usernames je asociatívne pole s kľúčom 'username'
	        if ($user['username'] === $name) {
	            return false;
	        }
	    }
	    return true;
	}

    public function original_email($email) {
		$emails = parent::select_sql_query("users", ["email"]);
		foreach ($emails as $mail) {
			if ($mail["email"] == $email) {
				return false;
			}
		}
		return true;
    }

    public function email_check($email) {
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  return true;
		} else {
		  return false;
		}
    }

    public function password_check($password) {
    	$password = trim($password);
    	if (!preg_match("#[0-9]+#", $password)) {
        	//must have 1 number error
        	return false;
    	}
	    if (!preg_match("#[A-Z]+#", $password)) {
        	//must have 1 uppercase char error
        	return false;
	    }
		return true;
    }

	public function set_value($field) {
	    if (isset($_POST[$field]) && !empty($_POST[$field])) {
	        // Sanitizácia vstupu, napríklad odstránenie HTML značiek
	        return $this->secure_input($_POST[$field]);
	    }
	    return "";
	}

	public function login_check($username, $password) {
		$hash = parent::select_sql_query("users", ["password"], ["username =" . "'".$username."'"]);
		if (password_verify($password, $hash[0]["password"])) {
			return true;
		} else {
			return false;
		}

	}

	public function is_log($field) {
		if (isset($_SESSION[$field]) && !empty($_SESSION[$field])) {
			return true;
		} else {
			return false;
		}
	}
}

class user {
	public function getUrl() {
		$url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

		$escaped_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );
		return $escaped_url;
	}

 	public function logout($field) {
		if ($field == true) {
			session_unset();
			header("Location: index");
		}
	}

	public function pages($page, $count = 0, $items = 5) {
		//nasa page je stranka v strede, ak page=2, tak list vyzera 1,2,3 inak page - 1, page, page + 1
		$pages = $page + 1;
		for($i = $page - 1; $i <= $pages; $i++) {
			//0-ta stranka
			if ($i == 0) {
				$i++;
				$pages++;
			}
			//ukoncenie last page, pokial je pocet prispevkov delitelny bez zvysku
			if ($i > $count / $items && $count % $items == 0) {
				break;
			}
			//ukoncenie last page, pokial je pocet prispevkov delitelny bez zvysku 
			else if ($i > ($count / $items)+1 && $count % $items != 0) {
				break;
			}
			//vypis stranok i==page to je aktualna stranka :) 
			if ($i == $page) {
				echo "<div class='col-lg-2 col-md-3 col-4 number text-center active'>".$i."</div>";
			} else {
				$link = str_replace("page=".$page, "page=".$i, user::getUrl());
				echo "<div class='col-lg-2 col-md-3 col-4 number text-center'><a href='".$link."'>".$i."</a></div>";
			}
		}
	}
}

?>