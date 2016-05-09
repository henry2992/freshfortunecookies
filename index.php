<?php
  include 'db.php';
 
 	$sql= "SELECT * FROM messages"; 

 	$sth = $pdo->prepare($sql);
	$sth->execute();
	$result = $sth->fetchAll(PDO::FETCH_COLUMN, 0);
    

  	echo var_dump($result);

  	
?>


<h1>Fortune Cookies</h1>


<h3>
	<?php 
		echo $result[array_rand($result)];
	?>
</h3>


<a href="new.php">NEW MESSAGE</a>







