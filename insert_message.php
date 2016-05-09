<?php

	include 'db.php';

	try {
    	$sql="INSERT INTO messages(message) VALUES ('$_POST[message]')";
	    $sth = $pdo->query($sql);
	} catch(PDOException $e) {
	    echo $e->getMessage();
	}


	header("Location: index.php");

?>
