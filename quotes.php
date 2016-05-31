<?php
  	include 'db.php';	
	$sql= "SELECT * FROM messages where approved = '1' "; 

 	$sth = $db ->prepare($sql);
	$sth->execute();
	
	$result = $sth->fetchAll(PDO::FETCH_COLUMN, 0);	

?>

<?php
  include 'header.php';
?>



	<body>
	 	
	 	<?php
		  include 'navbar.php';
		?>

	 	
		<div class="container-fluid">
			<div class="quotes row">
			
				<ul class="fortune-cookie">
					<?php 
						foreach ($result as &$quote) {
					?>
						<div class="col-sm-1 quote-img ">
							<img class="fc" src="images/fc1.png"> </img>
						</div>
						<div class="col-sm-11 quote-div">
							<li> <?php echo $quote; ?> </li>
						</div>
						<br>
					<?php
						}
					?> 
				</ul>

			</div>
		</div>
	
	</body>
	
</html>


	


</html>

