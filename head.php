<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Diskutujme spolu</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="myCss/basic.css">
    <link rel="stylesheet" href="myCss/footer.css">
    <link rel="stylesheet" href="myCss/header.css">
    <link rel="stylesheet" href="icofont/icofont.min.css">
    <?php 
    if (isset($css)) {
    	echo "<link rel='stylesheet' href='myCss/".$css."'>";
    }
    include("database.php")?>
</head>
<body>